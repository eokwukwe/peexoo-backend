<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = [
            'web design',
            'digital marketing',
            'software development',
            'photography',
            'online tutoring'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($categories)
        ];
    }
}
