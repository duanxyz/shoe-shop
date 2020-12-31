<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Item;
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
        Customer::factory()->count(50)
            ->hasAddresses(4)
            ->has(Order::factory()
                ->count(4))
            ->has(Cart::factory()
                ->count(1))
            ->create();

        $items = Item::all();
        Order::all()->each(function ($order) use ($items) {
            $order->items()->attach(
                $items->random(rand(4, 4))->pluck('id')->toArray()
            );
        });
        Cart::all()->each(function ($cart) use ($items) {
            $cart->items()->attach(
                $items->random(rand(10, 10))->pluck('id')->toArray()
            );
        });
    }
}
