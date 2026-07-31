<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'dob',
        'gender',
        'phone',
        'role',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'dob' => 'date',
        ];
    }

    /**
     * @return HasMany<Cart, $this>
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * @return HasMany<Service, $this>
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * @return HasManyThrough<Review, Service, $this>
     */
    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Service::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function reviewCount(): int
    {
        return (int) $this->reviews()->count();
    }

    public function reviewRating(): float
    {
        return (float) round((float) $this->reviews()->avg('rating') ?? 0, 2);
    }

    /**
     * @return array{id: int, name: string, picture: string|null} An array summary
     *                                                            of the user suitable for card layouts. Avoids N+1 by relying on eager
     *                                                            loading by the caller when needed.
     */
    public function toCard(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'picture' => $this->picture ? Storage::url($this->picture) : null,
        ];
    }

    /**
     * Resolved profile picture URL (storage-aware). Falls back to a default
     * avatar generated from the user's initials when no picture is set.
     */
    public function profilePictureUrl(): string
    {
        if ($this->picture && $this->picture !== 'profile-pictures/profile.png') {
            return Storage::url($this->picture);
        }

        $initials = strtoupper(substr($this->name, 0, 1));
        $hue = crc32($this->name) % 360;

        return 'data:image/svg+xml,'.rawurlencode(
            '<svg xmlns="http://www.w3.org/2000/svg" width="96" height="96">'
            .'<rect width="96" height="96" rx="48" fill="hsl('.$hue.',45%,45%)"/>'
            .'<text x="50%" y="54%" text-anchor="middle" fill="#fff" font-size="40" font-family="system-ui">'.$initials.'</text>'
            .'</svg>'
        );
    }
}
