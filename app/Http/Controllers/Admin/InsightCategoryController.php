<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InsightCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InsightCategoryController extends Controller
{
    public function index()
    {
        $categories = InsightCategory::withCount('insights')
            ->ordered()
            ->paginate(15);

        return view('admin.insight-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.insight-categories.create', [
            'category' => new InsightCategory(['is_active' => true]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        InsightCategory::create($data);

        return redirect()->route('admin.insight-categories.index')
            ->with('status', 'Category created.');
    }

    public function edit(InsightCategory $insightCategory)
    {
        return view('admin.insight-categories.edit', [
            'category' => $insightCategory,
        ]);
    }

    public function update(Request $request, InsightCategory $insightCategory)
    {
        $insightCategory->update($this->validated($request, $insightCategory));

        return redirect()->route('admin.insight-categories.index')
            ->with('status', 'Category updated.');
    }

    public function destroy(InsightCategory $insightCategory)
    {
        if ($insightCategory->insights()->exists()) {
            return redirect()->route('admin.insight-categories.index')
                ->withErrors('Category cannot be deleted while insights still reference it.');
        }

        $insightCategory->delete();

        return redirect()->route('admin.insight-categories.index')
            ->with('status', 'Category deleted.');
    }

    private function validated(Request $request, ?InsightCategory $category = null): array
    {
        $request->merge([
            'slug' => $request->filled('slug') ? $request->input('slug') : Str::slug($request->input('name')),
            'is_active' => $request->boolean('is_active'),
        ]);

        return $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['required', 'string', 'max:180', Rule::unique('insight_categories', 'slug')->ignore($category)],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
