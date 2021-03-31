<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagazineRelease extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_magazine_release';

    public function articles()
    {
        return $this->hasMany(MagazineReleaseArticle::class, 'release_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(MagazineReleaseCategory::class, 'release_id', 'id');
    }

}
