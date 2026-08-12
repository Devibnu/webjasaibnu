@extends('admin.layouts.app')

@section('title', 'Services CMS')
@section('page', 'Services')

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <div>
                <h6>Services</h6>
                <p class="text-sm mb-0">Manage services displayed on the public /services page.</p>
            </div>
            <a href="{{ route('admin.services.create') }}" class="btn bg-gradient-info mb-0">Add Service</a>
        </div>
        <div class="card-body px-4 pt-3 pb-2">
            @if (session('status'))
                <div class="alert alert-success text-white">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger text-white">{{ $errors->first() }}</div>
            @endif

            <form method="GET" action="{{ route('admin.services.index') }}" class="row g-2 mb-4">
                <div class="col-md-6">
                    <input type="search" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search service title or description">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-info w-100 mb-0" type="submit">Search</button>
                </div>
            </form>

            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Service</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Icon</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sort</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $service->title }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ Str::limit($service->description, 65) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-sm bg-gradient-dark">{{ $service->icon }}</span></td>
                                <td><span class="badge badge-sm bg-gradient-{{ $service->is_active ? 'success' : 'secondary' }}">{{ $service->is_active ? 'Active' : 'Inactive' }}</span></td>
                                <td><p class="text-sm font-weight-bold mb-0">{{ $service->sort_order }}</p></td>
                                <td><p class="text-sm mb-0">{{ $service->updated_at?->format('Y-m-d H:i') }}</p></td>
                                <td class="align-middle text-end">
                                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-link text-info mb-0 px-2">Edit</a>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this service?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger mb-0 px-2" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">No services found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $services->links() }}
            </div>
        </div>
    </div>
@endsection
