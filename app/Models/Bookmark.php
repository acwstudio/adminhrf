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
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'bookmarkable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'bookmarkable');
    }

    public function biographies()
    {
        return $this->morphedByMany( Biography::class, 'bookmarkable');
    }

    public function documents()
    {
        return $this->morphedByMany(Document::class, 'bookmarkable');
    }

    public function getNews(Request $request){
        return $this::where('user_id','=',$request->get('user_id',0))->news();
    }


}
