<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorable extends Model
{
    use HasFactory;


    public $fillable = [
        'used_id',
        'authorable_id',
        'authorable_type'
    ];

    
}
