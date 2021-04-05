<?php

namespace App\Models;

use App\Models\Traits\Commentable;
use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory, Sluggable, Likeable, Commentable,Searchable;

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
        'biblio' => 'array',
//	'viewed' => 'bigint'
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
        return $this->morphMany(Image::class, 'imageable')->orderBy('order');
    }

    /**
     * Get article's tags
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function taggable(){
        return $this->morphMany(Taggable::class,'taggable');
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    /**
     * Get authors of the article.
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_article', 'article_id', 'author_id');
    }

    public function timeline()
    {
        return $this->morphOne(Timeline::class, 'timelinable');
    }

    public function hasBookmark(User $user){
        if(is_null($user->bookmarkGroup)){
            return false;
        }
        return !is_null($user->bookmarkGroup->bookmarks->firstWhere('bookmarkable_id', $this->id));
    }

    public function oldCategories(){
        return $this->belongsToMany(\App\Models\Old\ArticleCategory::class,'content_artworks_category_book','category_book_id');
    }

    public function category(){
        return $this->belongsTo(ArticleCategory::class,'category_id');
    }

}
