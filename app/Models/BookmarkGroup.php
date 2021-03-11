<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookmarkGroup extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'title',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookmarks(){
        return $this->hasMany(Bookmark::class,'group_id','id' );
    }

}
