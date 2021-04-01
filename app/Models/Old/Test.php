<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Old\Question as Question;

class Test extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_quiz';


    public function questions(){
        return $this->hasMany(\App\Models\Old\Question::class,'quiz_id','id');
    }
}
