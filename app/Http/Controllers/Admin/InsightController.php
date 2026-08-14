<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insight;
use App\Models\InsightCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InsightController extends Controller
{
    public function index(Request $request)
    {
        $query = Insight::with('category')->latest('updated_at');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('insight_category_id', $request->input('category'));
        }

        return view('admin.insights.index', [
            'insights' => $query->paginate(10)->withQueryString(),
            'categories' => InsightCategory::ordered()->get(),
            'filters' => $request->only(['search', 'status', 'category']),
        ]);
    }

    public function create()
    {
        return view('admin.insights.create', [
            'insight' => new Insight(['status' => Insight::STATUS_DRAFT]),
            'categories' => InsightCategory::active()->ordered()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['created_by'] = $request->user()?->id;

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('insights', 'public');
        }

        Insight::create($data);

        return redirect()->route('admin.insights.index')
            ->with('status', 'Insight created.');
    }

    public function edit(Insight $insight)
    {
        return view('admin.insights.edit', [
            'insight' => $insight,
            'categories' => InsightCategory::active()->ordered()->get(),
        ]);
    }

    public function update(Request $request, Insight $insight)
    {
        $data = $this->validated($request, $insight);

        if ($request->hasFile('featured_image')) {
            $this->deleteManagedImage($insight);
            $data['featured_image'] = $request->file('featured_image')->store('insights', 'public');
        }

        $insight->update($data);

        return redirect()->route('admin.insights.index')
            ->with('status', 'Insight updated.');
    }

    public function destroy(Insight $insight)
    {
        $this->deleteManagedImage($insight);
        $insight->delete();

        return redirect()->route('admin.insights.index')
            ->with('status', 'Insight deleted.');
    }

    private function validated(Request $request, ?Insight $insight = null): array
    {
        $request->merge([
            'slug' => $request->filled('slug') ? $request->input('slug') : Str::slug($request->input('title')),
        ]);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:220'],
            'slug' => ['required', 'string', 'max:240', Rule::unique('insights', 'slug')->ignore($insight)],
            'focus_keyword' => ['nullable', 'string', 'max:255'],
            'insight_category_id' => ['nullable', 'exists:insight_categories,id'],
            'excerpt' => ['required', 'string', 'max:600'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', Rule::in([Insight::STATUS_DRAFT, Insight::STATUS_PUBLISHED])],
            'published_at' => ['nullable', 'date'],
            'seo_title' => ['nullable', 'string', 'max:220'],
            'seo_description' => ['nullable', 'string', 'max:320'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($data['status'] === Insight::STATUS_PUBLISHED && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($data['status'] === Insight::STATUS_DRAFT) {
            $data['published_at'] = $data['published_at'] ?? null;
        }

        return $data;
    }

    private function deleteManagedImage(Insight $insight): void
    {
        if ($insight->featured_image && ! str_starts_with($insight->featured_image, 'assets/')) {
            Storage::disk('public')->delete($insight->featured_image);
        }
    }
}
