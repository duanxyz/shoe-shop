<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    protected $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function index(Request $request)
    {
        $category = null;

        $query = $this->item->query()->with(['category', 'photo']);
        if (!empty($request->min_price)) {
            $query->where('price', '>=', $request->min_price);
        }

        if (!empty($request->max_price)) {
            $query->where('price', '<=', $request->max_price);
        }

        if (!empty($request->condition)) {
            $query->where('condition', $request->condition);
        }

        if (!empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if (!empty($request->category)) {
            $category = $request->category;
        } else {
            $category = $request->search;
        }

        $query->whereHas('category', function ($q) use ($category) {
            $q->where('name', 'like', '%' . $category . '%');
        });

        if ($request->low) {
            $query->orderBy('price', 'asc');
        }

        if ($request->height) {
            $query->orderBy('price', 'desc');
        }

        if ($request->latest) {
            $query->orderBy('created_at', 'desc');
        }

        return Inertia::render('Search/index', [
            'filters' => $request->only('min_price', 'max_price', 'condition', 'search', 'low', 'height', 'latest', 'category'),
            'items' => $query->get(),
        ]);
    }
}
