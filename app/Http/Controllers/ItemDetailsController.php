<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemDetailsController extends Controller
{
    public function index($id)
    {
        return Inertia::render('ItemDetails/index', [
            'item' => Item::with('photos', 'category')->find($id),
        ]);
    }
}
