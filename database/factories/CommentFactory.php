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
            'user_id' => $this->faker->numberBetween(35265,35274),
            'text' => $this->faker->text(200),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
            'commentable_id' => 3928,
            'commentable_type' => 'article',
            'parent_id' => null,
            'answer_to' => $this->faker->randomElement([
                [
                    'user_name' => 'Donnie Jakubowski',
                    'user_id' => 35274,
                    'comment_id' => $this->faker->numberBetween(1,10)
                ],
                [
                    'user_name' => 'Hilma Schaefer',
                    'user_id' => 35273,
                    'comment_id' => $this->faker->numberBetween(1,10)
                ],
                [
                    'user_name' => 'Dr. Madison Leuschke',
                    'user_id' => 35272,
                    'comment_id' => $this->faker->numberBetween(1,10)
                ]
            ])
        ];
    }
}
