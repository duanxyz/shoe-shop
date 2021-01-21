<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use function PHPSTORM_META\map;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = collect($request->item)->sortBy('id')->values()->all();
        $itemId = [];
        $quantity = [];

        foreach ($sort as $item) {
            array_push($itemId, $item['id']);
            array_push($quantity, $item['quantity']);
        }

        $item = Item::find($itemId)->transform(function ($item, $key) use ($quantity) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'photo_url' => $item->photo->photo_url,
                'quantity' => $quantity[$key]
            ];
        });

        if ($request->lots) {
            return $this->checkout($item);
        } else {
            return $this->buyDirectly($item);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Auth::user()->customer;

        $order = $customer->orders()->create([
            'customer_id' => $customer->id,
            'payment' => $request->payment,
            'grand_total' => $request->grand_total,
            'status' => "Awaiting Confirmation",
        ]);

        foreach ($request->item_id as $id) {
            $order->items()->attach($id);
            if (count($request->item_id)) {
                $customer->cart->items()->detach($id);
            }
        }

        return Redirect::route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function buyDirectly($item)
    {
        return Inertia::render('BuyDirectly/index', [
            'item' => $item,
            'addresses' => Auth::user()->customer->addresses,
        ]);
    }

    public function checkout($item)
    {
        return Inertia::render('Checkout/index', [
            'items' => $item,
            'addresses' => Auth::user()->customer->addresses,
        ]);
    }
}
