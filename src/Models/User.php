<?php

namespace Saidjon\InertiaCrudGenerator\Models;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Saidjon\InertiaCrudGenerator\Traits\AuthTokenTrait;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use AuthTokenTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
       public static $rules = [
        'name' => 'required',
        'role'=>' nullable|integer',
        'email' => 'required|email',
        'password' => 'required',
        'profile_photo_path' => 'nullable|string'
    ];


    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path',
    ];

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'token'
    ];

    public function getTokenAttribute()
    {
        
        return $this->getFromCacheOrNewToken(auth()->user()->id);
    }
}
