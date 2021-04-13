<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayInHistory extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'days_in_history';
    protected $fillable = [
        'id',
        'day',
        'month',
        'title',
        'url'
    ];

    public function sluggable(): array
    {
        return [
            'slug' =>
                [
                    'source' => 'title'
                ]
        ];
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
