<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayInHistory extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'days_in_history';
    public function sluggable(): array
    {
        return [
            'slug' =>
            [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'day',
        'month',
        'title',
        'url'
    ];

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
