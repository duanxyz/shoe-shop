<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        } else if ($filter == "terakhir-dilihat") {
            $query = $this->item->getLastSeen(Auth::user()->customer->getIdItemLastSeen());
            $view = "ShowAll/LastSeen";
        }

        return Inertia::render($view, [
            'items' => $query,
        ]);
    }
}
