<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get social user accounts.
     */
    public function socials(): HasMany
    {
        return $this->hasMany(SocialUser::class);
    }

    /**
     * Get user role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Finds out if user has role 'admin'
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role && $this->role->role == 'admin';
    }

    /**
     * Finds out if user has role 'admin' or 'redactor'
     *
     * @return bool
     */
    public function isAdminOrRedactor(): bool
    {
        return $this->role && ($this->role->role == 'admin' || $this->role->role == 'redactor');
    }


    /* Define comments and user relation */
    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id','id');
    }

    public function bookmarkGroup(){
        return $this->hasOne(BookmarkGroup::class);
    }

}
