<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = DB::table('users')->get(['id']);

        return [
//            'title' => $this->faker->sentence(),
//            'slug' =>$this->faker->slug(),
//            'body' =>$this->faker->text(),

            'user_id' => $users->random()->id,
            'title' => $this->faker->words(3, true),
            'announce' => $this->faker->sentence(),
            'body' => $this->faker->sentence(20),
            'show_in_rss' => false,
            'yatextid' => $this->faker->word,
            'active' => true,
            'published_at' => $this->faker->dateTimeBetween('-20 days', '-10 days'),
            'created_at' => $this->faker->dateTimeBetween('-30 days', '-20 days'),
            'updated_at' => $this->faker->dateTimeBetween('-10 days', '-5 days'),
//            'viewed' => 0,
//            'liked' => 0,
//            'commented' => 0,
//            'biblio' => $this->faker->words(),
//            'event_date' => $this->faker->dateTimeBetween('+2 days', '+2 days'),
//            'event_start_date' => $this->faker->dateTimeBetween('+2 days', '+2 days'),
//            'event_end_date' => $this->faker->dateTimeBetween('+5 days', '+5 days'),
        ];
    }
}
