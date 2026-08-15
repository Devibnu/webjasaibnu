<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceTechnologyRequest;
use App\Http\Requests\Admin\UpdateServiceTechnologyRequest;
use App\Models\ServiceTechnology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceTechnologyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = ServiceTechnology::query()->ordered();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return view('admin.service-technologies.index', [
            'technologies' => $query->paginate(12)->withQueryString(),
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('admin.service-technologies.create', [
            'technology' => new ServiceTechnology(['is_active' => true, 'sort_order' => 0]),
        ]);
    }

    public function store(StoreServiceTechnologyRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = (bool) $request->input('is_active', false);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('logo_path')) {
            $data['logo_path'] = $request->file('logo_path')->store('service-technologies', 'public');
        }

        ServiceTechnology::create($data);

        return redirect()->route('admin.service-technologies.index')
            ->with('status', 'Technology created successfully.');
    }

    public function edit(ServiceTechnology $serviceTechnology)
    {
        return view('admin.service-technologies.edit', [
            'technology' => $serviceTechnology,
        ]);
    }

    public function update(UpdateServiceTechnologyRequest $request, ServiceTechnology $serviceTechnology)
    {
        $data = $request->validated();
        $data['is_active'] = (bool) $request->input('is_active', false);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->boolean('remove_logo')) {
            if ($serviceTechnology->logo_path) {
                Storage::disk('public')->delete($serviceTechnology->logo_path);
            }
            $data['logo_path'] = null;
        } elseif ($request->hasFile('logo_path')) {
            if ($serviceTechnology->logo_path) {
                Storage::disk('public')->delete($serviceTechnology->logo_path);
            }
            $data['logo_path'] = $request->file('logo_path')->store('service-technologies', 'public');
        } else {
            unset($data['logo_path']);
        }

        unset($data['remove_logo']);

        $serviceTechnology->update($data);

        return redirect()->route('admin.service-technologies.index')
            ->with('status', 'Technology updated successfully.');
    }

    public function destroy(ServiceTechnology $serviceTechnology)
    {
        if ($serviceTechnology->logo_path) {
            Storage::disk('public')->delete($serviceTechnology->logo_path);
        }

        $serviceTechnology->delete();

        return redirect()->route('admin.service-technologies.index')
            ->with('status', 'Technology deleted successfully.');
    }
}
