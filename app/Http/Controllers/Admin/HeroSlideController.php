<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHeroSlideRequest;
use App\Http\Requests\Admin\UpdateHeroSlideRequest;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = HeroSlide::query()->ordered();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('eyebrow', 'like', "%{$search}%");
            });
        }

        $slides = $query->paginate(10)->withQueryString();

        return view('admin.hero-slides.index', compact('slides', 'search'));
    }

    public function create()
    {
        return view('admin.hero-slides.create', [
            'slide' => new HeroSlide([
                'is_active' => true,
                'sort_order' => 0,
                'overlay_opacity' => HeroSlide::DEFAULT_OVERLAY_OPACITY,
            ]),
        ]);
    }

    public function store(StoreHeroSlideRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = (bool) $request->input('is_active', false);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['overlay_opacity'] = $data['overlay_opacity'] ?? HeroSlide::DEFAULT_OVERLAY_OPACITY;

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('hero-slides', 'public');
        }

        HeroSlide::create($data);

        return redirect()->route('admin.hero-slides.index')
            ->with('status', 'Hero slide created successfully.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        $slide = $heroSlide;
        return view('admin.hero-slides.edit', compact('slide'));
    }

    public function update(UpdateHeroSlideRequest $request, HeroSlide $slide)
    {
        $data = $request->validated();
        $data['is_active'] = (bool) $request->input('is_active', false);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['overlay_opacity'] = $data['overlay_opacity'] ?? $slide->overlay_opacity;

        if ($request->boolean('remove_image')) {
            $this->deleteManagedImage($slide);
            $data['image_path'] = null;
        } elseif ($request->hasFile('image')) {
            $newPath = $request->file('image')->store('hero-slides', 'public');
            $previousPath = $slide->image_path;
            $data['image_path'] = $newPath;
            $slide->update($data);
            $this->deleteManagedPath($previousPath);

            return redirect()->route('admin.hero-slides.index')
                ->with('status', 'Hero slide updated successfully.');
        }

        $slide->update($data);

        return redirect()->route('admin.hero-slides.index')
            ->with('status', 'Hero slide updated successfully.');
    }

    public function destroy(HeroSlide $slide)
    {
        $this->deleteManagedImage($slide);
        $slide->delete();

        return redirect()->route('admin.hero-slides.index')
            ->with('status', 'Hero slide deleted successfully.');
    }

    private function deleteManagedImage(HeroSlide $slide): void
    {
        $this->deleteManagedPath($slide->image_path);
    }

    private function deleteManagedPath(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'assets/')) {
            Storage::disk('public')->delete($path);
        }
    }
}