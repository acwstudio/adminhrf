<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return $fillable = [
            'user_id'=>$this->faker->numberBetween(1,10),
            'body'=>$this->faker->text(200),
            'date'=>$this->faker->date(),
            'commentable_id'=>$this->faker->numberBetween(1,30),
            'commentable_type'=>'App\Models\News',
            'parents'=>null,
        ];
    }
}
