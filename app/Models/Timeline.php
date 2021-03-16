<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    public $fillable = [
        'date',
        'timelinable_id',
        'timelinable_type',
    ];

    public function timelinable(){
        return $this->morphTo();
    }



}
