<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayInHistory extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_day_in_history';

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

}
