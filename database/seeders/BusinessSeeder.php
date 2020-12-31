<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::factory()->count(10)->create();

        foreach (Business::all() as $business) {
            $categories = Category::inRandomOrder()
                ->take(rand(2, 3))
                ->pluck('id');

            $business->categories()->attach($categories);
        }
    }
}
