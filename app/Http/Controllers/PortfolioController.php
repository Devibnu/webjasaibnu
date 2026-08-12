<?php

namespace App\Http\Controllers;

use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = PortfolioItem::with('category')->published()->ordered();

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($builder) => $builder->where('slug', $request->input('category')));
        }

        return view('pages.portfolio', [
            'items' => $query->get(),
            'categories' => PortfolioCategory::active()
                ->whereHas('items', fn ($builder) => $builder->published())
                ->ordered()
                ->get(),
            'activeCategory' => $request->input('category'),
        ]);
    }
}
