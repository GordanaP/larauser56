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

}
