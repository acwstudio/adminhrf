<?php

namespace App\Search;

use Algolia\ScoutExtended\Searchable\Aggregator;
use App\Models\Article;
use App\Models\Biography;
use App\Models\News;
use App\Models\Test;
use App\Models\Videomaterial;

class AllContent extends Aggregator
{
    /**
     * The names of the models that should be aggregated.
     *
     * @var string[]
     */
    protected $models = [
        Article::class,
        Test::class,
        News::class,
        Biography::class,
        Videomaterial::class
    ];
}
