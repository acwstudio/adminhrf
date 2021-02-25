<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TResult extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'test_id',
        'is_closed',
        'time_passed',
    ];

    public $casts = [
        'created_at',
        'updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function test(){
        return $this->belongsTo(Test::class, 'test_id','id');
    }


}
