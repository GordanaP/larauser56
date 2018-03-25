<?php

namespace App;

use App\Observers\UserObserver;
use App\Role;
use App\Traits\User\HasSlug;
use App\Traits\User\VerifiesEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasSlug, VerifiesEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'verified' => 'boolean',
    ];

    /**
     * Bootstrap the application User service.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::observe(UserObserver::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Format the account creation date.
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->toFormattedDateString();
    }

    /**
     * Get the token that belongs to the user.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activationToken()
    {
        return $this->hasOne(ActivationToken::class);
    }

    /**
     * Get the verified user.
     *
     * @return mixed
     */
    public function scopeByResetPasswordCredentials($query, $email)
    {
        return $query->whereEmail($email)->where('verified', true);
    }


    /**
     * Find the user by the attribute.
     *
     * @param string $value
     * @param  string $field
     * @return App\Usser
     */
    public static function findBy($value, $field='email')
    {
        return static::where($field, $value)->first();
    }

    /**
     * Create a new account.
     *
     * @param array $data
     * @return \App\User
     */
    public static function createAccount($data)
    {
        $user = new static;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        $user->save();

        $user->assignRole($data['role_id']);

        return $user;
    }

    /**
     * Update the account.
     *
     * @param  array $data
     * @return void
     */
    public function updateAccount($data)
    {
        $slug = $this->getSlug($data['name']);

        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->slug = $slug;

        if($data['password'])
        {
            $this->password = bcrypt($data['password']);
        }

        if($data['role_id'])
        {
            $this->assignRole($data['role_id']);
        }

        $this->save();
    }

    /**
     * Get the roles that belong to the user.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * A user has a specified role.
     *
     * @param  App\Role  $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role))
        {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    /**
     * Assigne a role to a user.
     *
     * @param  \App\Role $role
     * @return mixed
     */
    public function assignRole($role)
    {
        return $this->roles()->sync($role);
    }

    /**
     * Revoke a user's role.
     *
     * @param  numeric $role
     * @return void
     */
    public function revokeRole($role)
    {
        $roles = Role::whereIn('id', $role)->get();

        $this->roles()->detach($roles);
    }

    /**
     * Determine if the user is an administrator
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Determine if the user is a super-administrator
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return $this->hasRole('superadmin');
    }

    public static function withRelationship($relationship, $columns)
    {
        return static::with(array($relationship => function($query) use($columns) {

            $query->select($columns);

        }))->get();
    }
}