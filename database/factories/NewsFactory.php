<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->name,
            'slug'=>$this->faker->slug(3),
            'announce'=>$this->faker->paragraph,
            'listorder'=>$this->faker->numberBetween(1,200),
            'body'=>$this->faker->paragraph(3),
            'published_at' => $this->faker->dateTime(),
            'show_in_rss'=>true,
            'yatextid'=>null,
            'status'=>true,
            'show_in_main'=>true,
            'close_commentation'=>true,
            'show_in_afisha' => false,
        ];
    }
}
