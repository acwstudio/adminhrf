<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Old\Question as Question;

class Answer extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_quiz_answer';

    public function question(){
        return $this->belongsTo(\App\Models\Old\Question::class,'question_id','id');
    }

}
