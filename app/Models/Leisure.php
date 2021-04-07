<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leisure extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'leisures';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function events(){
        return $this->hasOne(Event::class, 'leisure_id','id');
    }
}
