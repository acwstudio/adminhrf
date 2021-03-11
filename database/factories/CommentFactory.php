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
        $models = [
            'article',
            'news',
            'document',
            'biography'
        ];
        return $fillable = [
            'user_id'=>$this->faker->numberBetween(1,10),
            'text'=>$this->faker->text(200),
            'created_at'=>$this->faker->date(),
            'updated_at'=>$this->faker->date(),
            'commentable_id'=>$this->faker->numberBetween(1,30),
            'commentable_type'=>$models[rand(0,3)],
            'parents'=>null,
        ];
    }
}
