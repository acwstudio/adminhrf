<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QCategory extends Model
{
    use HasFactory;

    public $fillable = [
        'text',
        'position',
    ];

    public function tests(){
        return $this->belongsToMany(Test::class, 'tests_categories');
    }


}
