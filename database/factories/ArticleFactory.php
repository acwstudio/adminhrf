<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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

        $randUser=User::all()->count();
        return [
            'title'=>$this->faker->name,
            'slug'=>$this->faker->slug(3),
            'url'=>$this->faker->slug(3),
            'announce'=>$this->faker->paragraph,
            'listorder'=>$this->faker->numberBetween(1,200),
            'body'=>$this->faker->paragraph(3),
            'show_in_rss'=>true,
            'yatextid'=>null,
            'status'=>true,
            'image_id'=>$this->faker->numberBetween(1,1000),
            'show_in_main'=>true,
            'close_commentation'=>false,
            'gallery_id'=>$this->faker->numberBetween(1,1000),
            'date'=>$this->faker->date(),
            'author_id'=>$this->faker->numberBetween(1,$randUser),
        ];
    }
}
