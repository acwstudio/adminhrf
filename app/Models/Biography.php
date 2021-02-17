<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    use HasFactory;
    
    public $fillable = [
        'surname',
        'firstname',
        'patronymic',
        'announce',
        'birthname',
        'description',
        'death_date',
        'government_start',
        'government_end',
        'url',
        'slug',        
        'show_in_rss',
        'close_commentation',
        'period_id',
        'image_id',
        'stream_id',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];





    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
