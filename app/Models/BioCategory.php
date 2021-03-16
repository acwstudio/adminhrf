<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioCategory extends Model
{
    use HasFactory, Sluggable;

    public $guarded = [];

    protected $table = 'biocategories';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function biographies()
    {
        return $this->belongsToMany(Biography::class, 'biography_categories', 'category_id', 'biography_id');
    }

}
