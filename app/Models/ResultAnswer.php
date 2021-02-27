<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultAnswer extends Model
{
    use HasFactory;

    protected $table = 'result_answers';

    public $fillable = [
        'result_id',
        'question_id',
        'is_right'
    ];

    public $casts = [
        'created_at',
        'updated_at',
    ];

    //Creating one-to-many RA-R relation
    public function result(){
        return $this->belongsTo(TResult::class, 'result_id', 'id');
    }

    //Creating one to many Q-RA relation
    public function question(){
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

}
