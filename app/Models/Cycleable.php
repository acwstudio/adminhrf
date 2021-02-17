<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycleable extends Model
{
    use HasFactory;

    public $fillable = [
        'cycle_id',
        'cycleable_id',
        'cycleable_type'
    ];



}
