<?php

namespace Database\Seeders;

use App\Kasut\dummy;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (dummy::categories() as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
