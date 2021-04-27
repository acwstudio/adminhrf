<?php

namespace App\Models;

use App\Events\CommentAdded;
use App\Events\CommentDeleted;
use App\Models\Traits\Rateable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, Rateable;

    const TYPE_COMMENT = 'comment';
    const TYPE_REVIEW = 'review';
    const ESTIMATE_NEGATIVE = 'negative';
    const ESTIMATE_POSITIVE = 'positive';
    const STATUS_PENDING =  'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_SPAM =   'spam';

    public static array $statuses = [
        self::STATUS_PENDING,
        self::STATUS_APPROVED,
        self::STATUS_SPAM
    ];

    public $guarded = [];

    protected $casts = [
        'answer_to' => 'array'
    ];

    protected $dispatchesEvents = [
        'saved' => CommentAdded::class,
        'deleted' => CommentDeleted::class,
    ];


    /**
     * Define polymorphic relation from comments to all other Entities
     */
    public function commentable()
    {
        return $this->morphTo();
    }


    /**
     * Define relation of comment being owned by user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

    public function scopeAproved($query)
    {
        $query->where('status', Comment::STATUS_APPROVED);
    }

    public function scopeStatus($query, $status)
    {
        $query->where('status', $status);
    }

    public function scopeUserStatus($query, $status)
    {
        return $query->whereHas('user', function (Builder $query) use ($status) {
            $query->where('status', $status);
        });
    }

    /**
     * Changes comment status
     *
     * @param $status
     * @return bool
     */
    public function changeStatus($status)
    {
        if (in_array($status, self::$statuses)) {

            $this->status = $status;
            $this->save();

            return true;

        }

        return false;
    }

}
