<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowAllController extends Controller
{
    protected $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function index(Request $request)
    {
        return Inertia::render('ShowAll/index', [
            'items' => $this->item->getBestSellers(),
        ]);
    }
}
