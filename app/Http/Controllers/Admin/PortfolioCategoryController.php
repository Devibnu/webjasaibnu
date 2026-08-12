<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PortfolioCategoryController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::withCount('items')
            ->ordered()
            ->paginate(15);

        return view('admin.portfolio-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.portfolio-categories.create', [
            'category' => new PortfolioCategory(['is_active' => true]),
        ]);
    }

    public function store(Request $request)
    {
        PortfolioCategory::create($this->validated($request));

        return redirect()->route('admin.portfolio-categories.index')
            ->with('status', 'Portfolio category created.');
    }

    public function edit(PortfolioCategory $portfolioCategory)
    {
        return view('admin.portfolio-categories.edit', [
            'category' => $portfolioCategory,
        ]);
    }

    public function update(Request $request, PortfolioCategory $portfolioCategory)
    {
        $portfolioCategory->update($this->validated($request, $portfolioCategory));

        return redirect()->route('admin.portfolio-categories.index')
            ->with('status', 'Portfolio category updated.');
    }

    public function destroy(PortfolioCategory $portfolioCategory)
    {
        if ($portfolioCategory->items()->exists()) {
            return redirect()->route('admin.portfolio-categories.index')
                ->withErrors('Category cannot be deleted while portfolio items still reference it.');
        }

        $portfolioCategory->delete();

        return redirect()->route('admin.portfolio-categories.index')
            ->with('status', 'Portfolio category deleted.');
    }

    private function validated(Request $request, ?PortfolioCategory $category = null): array
    {
        $request->merge([
            'slug' => $request->filled('slug') ? $request->input('slug') : Str::slug($request->input('name')),
            'is_active' => $request->boolean('is_active'),
        ]);

        return $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['required', 'string', 'max:180', Rule::unique('portfolio_categories', 'slug')->ignore($category)],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
