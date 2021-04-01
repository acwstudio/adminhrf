<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagazineReleaseArticle extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_magazine_release_acticle';

    public function release()
    {
        return $this->belongsTo(MagazineRelease::class, 'release_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(MagazineReleaseCategory::class, 'category_id', 'id');
    }

}
