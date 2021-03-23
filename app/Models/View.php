<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    public $fillable = [
        'total'
    ];
//    protected $hidden = [
//        'total'
//    ];

    public $casts = [
        'created_at',
        'updated_at'
    ];


    public function updateView()
    {
        $this->increment('value');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'viewable');
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'viewable');
    }
}
