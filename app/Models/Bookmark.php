<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Bookmark extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'group_id',
        'bookmarkable_id',
        'bookmarkable_type'
    ];

    public function bookmarkable()
    {
        return $this->morphTo('bookmarkable', 'bookmarkable_type', 'bookmarkable_id');
    }


    public function getNews(Request $request)
    {
        return $this::where('user_id', '=', $request->get('user_id', 0))->news();
    }

    public function bookmarkGroup()
    {
        return $this->belongsTo(BookmarkGroup::class, 'group_id', 'id');
    }


}
