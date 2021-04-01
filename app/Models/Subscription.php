<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;


    public $fillable = [
        'user_id',
        'tag_id'
    ];

    protected $casts = [
        'updated_at',
        'created_at'
    ];

    public function tag()
    {
        return $this->hasOne(Tag::class,'tag_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
