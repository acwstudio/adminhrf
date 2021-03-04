<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_event';

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
