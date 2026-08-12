<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSolutionRequest;
use App\Http\Requests\Admin\UpdateSolutionRequest;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SolutionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Solution::query()->ordered();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $solutions = $query->paginate(10)->withQueryString();

        return view('admin.solutions.index', compact('solutions', 'search'));
    }

    public function create()
    {
        return view('admin.solutions.create', [
            'solution' => new Solution(['is_active' => true, 'sort_order' => 0]),
        ]);
    }

    public function store(StoreSolutionRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = (bool) $request->input('is_active', false);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        Solution::create($data);

        return redirect()->route('admin.solutions.index')
            ->with('status', 'Solution created successfully.');
    }

    public function edit(Solution $solution)
    {
        return view('admin.solutions.edit', compact('solution'));
    }

    public function update(UpdateSolutionRequest $request, Solution $solution)
    {
        $data = $request->validated();
        $data['is_active'] = (bool) $request->input('is_active', false);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $solution->update($data);

        return redirect()->route('admin.solutions.index')
            ->with('status', 'Solution updated successfully.');
    }

    public function destroy(Solution $solution)
    {
        $solution->delete();

        return redirect()->route('admin.solutions.index')
            ->with('status', 'Solution deleted successfully.');
    }
}
