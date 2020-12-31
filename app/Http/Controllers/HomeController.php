<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    protected $items;

    public function __construct(Item $items)
    {
        $this->items = $items;
    }
    public function index()
    {
        return Inertia::render('Dashboard', [
            'bestSellers' => $this->items->shortItems(),
        ]);
    }
}
