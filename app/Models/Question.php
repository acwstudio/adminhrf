<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $fillable = [
        'text',
        'type',
        'position',
    ];

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'tests_question');
    }

    public function answers()
    {
        return $this->hasMany(TAnswer::class);
    }
}
