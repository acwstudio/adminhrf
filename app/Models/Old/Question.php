<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Old\Test as Test;
use App\Models\Old\Answer as Answer;

class Question extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_quiz_question';

    public function quiz(){
        return $this->belongsTo(Test::class,'quiz_id','id');
    }

    public function answers(){
        return $this->hasMany(Answer::class,'question_id','id');
    }


}
