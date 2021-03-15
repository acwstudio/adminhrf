<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioCategory extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'slug'
    ];

    protected $table = 'biocategories';

    public function biographies()
    {
        return $this->belongsToMany(Biography::class, 'biography_categories', 'category_id', 'biography_id');
    }

}
