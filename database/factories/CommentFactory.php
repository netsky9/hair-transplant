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
        $createdAt = $this->faker->dateTimeBetween($startDate = '-1 month', $endDate = '-10 days', $timezone = null);

        return [
            'comment_id' => 0, // no parent
            'report_id' => rand(1, 90),
            'user_id' => rand(3, 20),
            'text' => $this->faker->realText(),
            'created_at' => $createdAt,
            'updated_at' => $createdAt
        ];
    }
}
