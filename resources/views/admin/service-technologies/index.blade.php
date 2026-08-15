@extends('admin.layouts.app')

@section('title', 'Service Technologies')
@section('page', 'Service Technologies')

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <div>
                <h6>Service Technologies</h6>
                <p class="text-sm mb-0">Manage logos displayed in the Technology & Expertise section on /services.</p>
            </div>
            <a href="{{ route('admin.service-technologies.create') }}" class="btn bg-gradient-info mb-0">Add Technology</a>
        </div>
        <div class="card-body px-4 pt-3 pb-2">
            @if (session('status'))
                <div class="alert alert-success text-white">{{ session('status') }}</div>
            @endif

            <form method="GET" action="{{ route('admin.service-technologies.index') }}" class="row g-2 mb-4">
                <div class="col-md-6">
                    <input type="search" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search technology name">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-info w-100 mb-0" type="submit">Search</button>
                </div>
            </form>

            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Technology</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Logo</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fallback Mark</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sort</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($technologies as $technology)
                            <tr>
                                <td>
                                    <h6 class="mb-0 text-sm">{{ $technology->name }}</h6>
                                    <p class="text-xs text-secondary mb-0">Updated {{ $technology->updated_at?->format('Y-m-d H:i') }}</p>
                                </td>
                                <td>
                                    @if ($technology->logo_path)
                                        <img src="{{ asset('storage/' . $technology->logo_path) }}" alt="{{ $technology->name }}" style="max-width: 54px; max-height: 34px; object-fit: contain;">
                                    @else
                                        <span class="text-xs text-secondary">No logo</span>
                                    @endif
                                </td>
                                <td><span class="badge badge-sm bg-gradient-dark">{{ $technology->mark ?: '-' }}</span></td>
                                <td><span class="badge badge-sm bg-gradient-{{ $technology->is_active ? 'success' : 'secondary' }}">{{ $technology->is_active ? 'Active' : 'Inactive' }}</span></td>
                                <td><p class="text-sm font-weight-bold mb-0">{{ $technology->sort_order }}</p></td>
                                <td class="align-middle text-end">
                                    <a href="{{ route('admin.service-technologies.edit', $technology) }}" class="btn btn-link text-info mb-0 px-2">Edit</a>
                                    <form action="{{ route('admin.service-technologies.destroy', $technology) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this technology?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger mb-0 px-2" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">No technologies found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $technologies->links() }}
            </div>
        </div>
    </div>
@endsection
