<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagazineReleaseCategory extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_magazine_release_category';

    public function article()
    {
        return $this->hasOne(MagazineReleaseArticle::class, 'category_id', 'id');
    }

    public function release()
    {
        return $this->belongsTo(MagazineRelease::class, 'release_id', 'id');
    }

}
