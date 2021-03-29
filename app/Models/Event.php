<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $fillable = [
        ''
    ];


    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
}
