<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'carts' => Customer::where('user_id', Auth::id())->first()->cart->items,
            'bestSellers' => Item::limit(20)->orderBy('sold')->get(),
        ]);
    }
}
