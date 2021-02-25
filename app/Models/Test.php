<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'description',
        'is_active',
        'time',
    ];

    public $casts = [
        'created_at'=>'datetime',
        'updated_at'=>'datetime',
    ];


    public function categories(){
        return $this->belongsToMany(QCategory::class,'tests_categories');
    }

    public function questions(){
        return $this->belongsToMany(Question::class, 'tests_questions');
    }

    public function result(){
        return $this->belongsTo(Test::class, 'test_id','id');
    }





}
