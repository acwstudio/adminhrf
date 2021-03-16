<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

class Article extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
        'biblio' => 'array'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Accessor for event_date
     *
     * @return Carbon
     */
    public function getEventDateAttribute($value)
    {
        return is_null($value) ? null : $this->convertFromBCDate($value);
    }

    /**
     * Accessor for event_start_date
     *
     * @return Carbon
     */
    public function getEventStartDateAttribute($value)
    {
        return is_null($value) ? null : $this->convertFromBCDate($value);
    }

    /**
     * Accessor for event_end_date
     *
     * @return Carbon
     */
    public function getEventEndDateAttribute($value)
    {
        return is_null($value) ? null : $this->convertFromBCDate($value);
    }

    /**
     * Mutator for event_date
     *
     * @return string
     */
    public function setEventDateAttribute($value)
    {
        $this->attributes['event_date'] = is_null($value) ? null : $this->convertToBCDate($value);
    }

    /**
     * Mutator for event_start_date
     *
     * @return string
     */
    public function setEventStartDateAttribute($value)
    {
        $this->attributes['event_start_date'] = is_null($value) ? $value : $this->convertToBCDate($value);
    }

    /**
     * Mutator for event_end_date
     *
     * @return string
     */
    public function setEventEndDateAttribute($value)
    {
        $this->attributes['event_end_date'] = is_null($value) ? $value : $this->convertToBCDate($value);
    }

    /**
     * Get article's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get article's tags
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Get article's comments
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get article's likes
     */
    public function likes(){
        return $this->morphMany(Like::class,'likeable');
    }

    /**
     * Get count of likes for article
     */
    public function countLikes(){
        return $this->likes()->count();
    }

    public function countComments(){
        return $this->comments()->count();
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    /**
     * Check if specific article is liked
     */
    public function checkLiked($userId){
        $val = $this->likes()->first(['user_id']);
        return $val?$val->user_id==$userId:false;
    }

    /**
     * Get authors of the article.
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_article', 'article_id', 'author_id');
    }

    /**
     * Convert DB date to Carbon instance
     *
     * @param mixed $date
     * @return Carbon
     */
    protected function convertFromBCDate($date): Carbon
    {
        return strpos($date, ' BC') ? Carbon::make('-' . rtrim($date, ' BC')) : Carbon::make($date);
    }

    /**
     * Convert date to 'Y-m-d BC' format if year is negative
     *
     * @param mixed $date
     * @return string
     */
    protected function convertToBCDate($date): string
    {

        $result = $date->format('Y-m-d');

        return $date->year < 0 ? ltrim($result, '-') . ' BC' : $result;
    }
}
