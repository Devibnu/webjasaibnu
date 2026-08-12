<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = PortfolioItem::with('category')->latest('updated_at');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('portfolio_category_id', $request->input('category'));
        }

        return view('admin.portfolio.index', [
            'items' => $query->paginate(10)->withQueryString(),
            'categories' => PortfolioCategory::ordered()->get(),
            'filters' => $request->only(['search', 'status', 'category']),
        ]);
    }

    public function create()
    {
        return view('admin.portfolio.create', [
            'item' => new PortfolioItem(['status' => PortfolioItem::STATUS_DRAFT]),
            'categories' => PortfolioCategory::active()->ordered()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['created_by'] = $request->user()?->id;

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('portfolio', 'public');
        }

        PortfolioItem::create($data);

        return redirect()->route('admin.portfolio.index')
            ->with('status', 'Portfolio item created.');
    }

    public function edit(PortfolioItem $portfolioItem)
    {
        return view('admin.portfolio.edit', [
            'item' => $portfolioItem,
            'categories' => PortfolioCategory::active()->ordered()->get(),
        ]);
    }

    public function update(Request $request, PortfolioItem $portfolioItem)
    {
        $data = $this->validated($request, $portfolioItem);

        if ($request->hasFile('featured_image')) {
            $this->deleteManagedImage($portfolioItem);
            $data['featured_image'] = $request->file('featured_image')->store('portfolio', 'public');
        }

        $portfolioItem->update($data);

        return redirect()->route('admin.portfolio.index')
            ->with('status', 'Portfolio item updated.');
    }

    public function destroy(PortfolioItem $portfolioItem)
    {
        $this->deleteManagedImage($portfolioItem);
        $portfolioItem->delete();

        return redirect()->route('admin.portfolio.index')
            ->with('status', 'Portfolio item deleted.');
    }

    private function validated(Request $request, ?PortfolioItem $item = null): array
    {
        $request->merge([
            'slug' => $request->filled('slug') ? $request->input('slug') : Str::slug($request->input('title')),
            'is_featured' => $request->boolean('is_featured'),
        ]);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:220'],
            'slug' => ['required', 'string', 'max:240', Rule::unique('portfolio_items', 'slug')->ignore($item)],
            'portfolio_category_id' => ['nullable', 'exists:portfolio_categories,id'],
            'code' => ['nullable', 'string', 'max:12'],
            'excerpt' => ['nullable', 'string', 'max:700'],
            'description' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'client_name' => ['nullable', 'string', 'max:180'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'technologies' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', Rule::in([PortfolioItem::STATUS_DRAFT, PortfolioItem::STATUS_PUBLISHED])],
            'published_at' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['boolean'],
            'seo_title' => ['nullable', 'string', 'max:220'],
            'seo_description' => ['nullable', 'string', 'max:320'],
        ]);

        $data['technologies'] = collect(explode(',', $data['technologies'] ?? ''))
            ->map(fn ($technology) => trim($technology))
            ->filter()
            ->values()
            ->all();

        if ($data['status'] === PortfolioItem::STATUS_PUBLISHED && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($data['status'] === PortfolioItem::STATUS_DRAFT) {
            $data['published_at'] = $data['published_at'] ?? null;
        }

        return $data;
    }

    private function deleteManagedImage(PortfolioItem $item): void
    {
        if ($item->featured_image && ! str_starts_with($item->featured_image, 'assets/')) {
            Storage::disk('public')->delete($item->featured_image);
        }
    }
}
