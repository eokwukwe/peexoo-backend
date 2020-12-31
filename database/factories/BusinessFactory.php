<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Business::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('en_NG');

        return [
            'name' => $faker->unique()->company,
            'description' => $faker->sentence(),
            'address' => $faker->address(),
            'email' => $faker->unique()->freeEmail,
            'phone_1' => $faker->unique()->phoneNumber
        ];
    }
}
