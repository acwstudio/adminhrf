<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestMessage extends Model
{
    use HasFactory;

    protected $table = 'test_message';

    protected $fillable = [
        'text',
        'title',
        'lowest_value',
        'highest_value',
        'test_id'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
