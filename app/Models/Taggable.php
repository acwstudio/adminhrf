<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    use HasFactory;

    protected $table = 'taggables';

    protected $fillable = [
        'tag_id'
    ];

    protected $casts = [
        'created_at',
        'updated_at'
    ];

    public function taggable()
    {
        return $this->morphTo('taggable');
    }
}
