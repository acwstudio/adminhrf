<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QCategory extends Model
{
    use HasFactory, Sluggable;

    public $fillable = [
        'text',
        'position',
    ];
    protected $table = 'qcategories';
    public $timestamps = false;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'text'
            ]
        ];
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'tests_categories', 'category_id', 'test_id');
    }


}
