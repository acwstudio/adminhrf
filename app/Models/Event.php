<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'start_date',
        'end_date',
        'title',
        'slug',
        'description',
        'graph_announce',
        'card_announce',
        'is_date_bc',
        'show_in_timeline',
        'close_commentation',
        'date_year',
        'date_month',
        'date_day',
    ];

    protected $casts = [
      'created_at',
      'updated_at',
    ];




}
