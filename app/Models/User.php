<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'enabled',
        'firstname',
        'lastname',
        'date_of_birth',
        'gender',
        'phone',
        'place_of_birth',
        'work',
        'biography'
    ];

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
        'last_login',

    ];

    /* Define comments and user relation */
    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id','id');
    }

    /* Define group and users relation through group members list */
    public function groups()
    {
        return $this->hasManyThrough('groups', 'GroupMembers', 'group_id', 'id');
    }

    /*     */
    public function articles()
    {
        return $this->hasMany(Article::class,'user_id','id');
    }
}
