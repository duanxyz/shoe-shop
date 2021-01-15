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

    public function index($filter)
    {
        $query = null;

        if ($filter == "terlaris") {
            $query = $this->item->getBestSellers();
            $view = "ShowAll/BestSellers";
        }

        return Inertia::render($view, [
            'items' => $query,
        ]);
    }
}
