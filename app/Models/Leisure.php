<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leisure extends Model
{
    use HasFactory;

    protected $table = 'leisures';


    public function events(){
        return $this->hasOne(Event::class, 'leisure_id','id');
    }
}
