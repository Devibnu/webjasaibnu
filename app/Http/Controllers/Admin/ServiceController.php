<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Service::query()->ordered();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $services = $query->paginate(10)->withQueryString();

        return view('admin.services.index', compact('services', 'search'));
    }

    public function create()
    {
        return view('admin.services.create', [
            'service' => new Service(['is_active' => true, 'sort_order' => 0]),
        ]);
    }

    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = (bool) $request->input('is_active', false);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('status', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->validated();
        $data['is_active'] = (bool) $request->input('is_active', false);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('status', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('status', 'Service deleted successfully.');
    }
}
