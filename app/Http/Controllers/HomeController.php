<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    protected $item;
    protected $Customer;

    public function __construct(Item $item, Customer $customer)
    {
        $this->item = $item;
        $this->customer = $customer;
    }

    public function index()
    {
        return Inertia::render('Dashboard', [
            'bestSellers' => $this->item->getBestSellers(),
            'lastSeen' => $this->item->getLastSeen($this->customer->getIdItemLastSeen()),
        ]);
    }
}
