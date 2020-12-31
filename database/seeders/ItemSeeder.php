<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::factory()->count(100)
            ->hasPhotos(4)
            ->create();
        // Cart::factory()
        //     ->count(1)
        //     ->forCustomer()
        //     ->hasItems(3)->create();
    }
}
