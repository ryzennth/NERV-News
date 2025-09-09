<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'profile_completed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'profile_completed' => 'boolean',
        ];
    }

    /**
     * Get articles written by user
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get writer application
     */
    public function writerApplication()
    {
        return $this->hasOne(WriterApplication::class);
    }

    /**
     * Check if user is a writer
     */
    public function isWriter(): bool
    {
        return $this->hasRole(['writer', 'moderator', 'admin', 'super-admin']);
    }

    public function canWriteArticles(): bool
    {
        return $this->hasRole(['writer', 'moderator', 'admin', 'super-admin']);
    }

    public function canModerateContent(): bool
    {
        return $this->hasRole(['moderator', 'admin', 'super-admin']);
    }

    /**
     * Check if user profile is complete
     */
    public function hasCompleteProfile(): bool
    {
        return $this->profile_completed === true;
    }
}