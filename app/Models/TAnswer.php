<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TAnswer extends Model
{
    use HasFactory;

    public $fillable = [
        'question_id',
        'title',
        'is_right',
        'description',
	'title'
    ];
    public $casts = [
        'created_at',
        'updated_at'
    ];
    protected $table = 'tanswers';

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
