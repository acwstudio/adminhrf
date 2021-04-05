<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Define polymorphic relation from rates to all other Entities
     */
    public function rateable()
    {
        return $this->morphTo();
    }

    /**
     * Get related user
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
