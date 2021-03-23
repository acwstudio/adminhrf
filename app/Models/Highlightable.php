<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlightable extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'highlight_id',

    ];

    public function highlightable()
    {
        return $this->morphTo('highlightable', 'highlightable_type', 'highlightable_id');
    }

    public function highlight()
    {
        return $this->belongsTo(Highlight::class, 'highlight_id', 'id');
    }
}
