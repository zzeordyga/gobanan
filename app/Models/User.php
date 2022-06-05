<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'dob',
        'gender',
        'phone',
        'picture'
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
        'profile_photo_url',
    ];

    protected $attributes = [
        'gender' => '-',
        'phone' => '-',
        'picture' => 'profile-pictures/profile.png',
        'role' => 'member',
    ];

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function reviews(){
        return $this->hasManyThrough(Review::class, Service::class);
    }

    public function reviewCount(){
        return $this->reviews()->count();
    }

    public function reviewRating(){
        return $this->reviews()->avg('rating');
    }
}
