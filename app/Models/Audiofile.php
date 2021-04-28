<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Audiofile
 * @package App\Models
 */
class Audiofile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'size', 'path', 'ext', 'audiomaterial_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function audiomaterial()
    {
        return $this->belongsTo(Audiomaterial::class);
    }
}
