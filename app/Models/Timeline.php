<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    public $fillable = [
        'date',
        'timelinable_id',
        'timelinable_type',
    ];
    private $timelinable_type;

    public function timelinable()
    {
        return $this->morphTo();
    }

    /**
     * @param Builder $query
     * @param $dateStart
     * @param $dateEnd
     * @return Builder
     */
    public function scopeBetweenDate(Builder $query, $dateStart, $dateEnd): Builder
    {
        return $query->whereBetween('date', [$dateStart, $dateEnd]);
    }
}
