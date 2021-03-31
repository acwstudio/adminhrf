<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_artwork_category_book';

    public function article(){
        return $this->belongsToMany(\App\Models\Article::class,'content_artworks_category_book','artwork_id',);
    }
}
