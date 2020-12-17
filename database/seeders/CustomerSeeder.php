<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Faker\Factory;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Customer::factory()->count(50)
            ->hasAddresses(4)
            ->has(Order::factory()
                ->count(4)
                ->hasItems(4))
            ->has(Cart::factory()
                ->count(1)
                ->hasItems(10))
            ->create();
    }
}
