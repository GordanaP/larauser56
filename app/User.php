<?php

namespace App;

use App\Observers\UserObserver;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified'
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
    public static function boot()
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
        return 'name';
    }

    /**
     * Indicate if the user has verified their email address.
     *
     * @return bool
     */
    public function isVerified()
    {
        return $this->verified;
    }


    /**
     * Generate the unique name slug.
     *
     * @param  string $name
     * @return string
     */
    public static function uniqueNameSlug($name)
    {
        $slug = str_slug($name);

        if (static::nameSlugExists($slug))
        {

            $pieces = explode('-', static::nameSlugLatest($slug));

            $number = intval(end($pieces));

            $slug .= '-' .($number + 1);
        }

        return $slug;
    }

    /**
     * Determine if the name slug exists.
     *
     * @param  string $slug
     * @return boolean
     */
    protected static function nameSlugExists($slug)
    {
        return (bool) static::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();
    }

    /**
     * Fetch the latest user.
     * @param  string $slug
     * @return App\Slug
     */
    protected static function nameSlugLatest($slug)
    {
        return static::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")
                ->latest('slug', 'desc')
                ->pluck('slug')
                ->first();
    }

    /**
     * Create slug under certain conditions.
     *
     * @param  string $name
     * @param  string $slug
     * @param  array $data
     * @return string
     */
    protected function slug($name, $slug, $data)
    {
        return strtolower($name) === strtolower($data['name']) ?  $slug : static::uniqueNameSlug($data['name']);
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

}
