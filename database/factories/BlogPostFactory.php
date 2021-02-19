<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(5,10));
        $text = $this->faker->text(rand(1000,2000));
        $isPublished = (rand(1, 15) == 1)? false : true;
        $createdAt = $this->faker->dateTimeBetween($startDate = '-2 month', $endDate = '-30 days', $timezone = null);

        return [
            'category_id'   => rand(1, 11),
            'user_id'       => (rand(1, 5) == 5)? 1 : 2,
            'slug'          => Str::slug($title),
            'title'         => $title,
            'excerpt'       => $this->faker->realText(),
            'content_raw'   => $text,
            'content_html'  => $text,
            'is_published'  => $isPublished,
            'published_at'  => $isPublished ? $this->faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now', $timezone = null) : null,
            'created_at'    => $createdAt,
            'updated_at'    => $createdAt,
        ];
    }
}
