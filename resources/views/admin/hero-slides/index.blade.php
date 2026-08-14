@extends('admin.layouts.app')

@section('title', 'Hero Slider CMS')
@section('page', 'Hero Slider')

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <div>
                <h6>Hero Slider</h6>
                <p class="text-sm mb-0">Manage slides displayed on the homepage hero carousel.</p>
            </div>
            <a href="{{ route('admin.hero-slides.create') }}" class="btn bg-gradient-info mb-0">Add Hero Slide</a>
        </div>
        <div class="card-body px-4 pt-3 pb-2">
            @if (session('status'))
                <div class="alert alert-success text-white">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger text-white">{{ $errors->first() }}</div>
            @endif

            <form method="GET" action="{{ route('admin.hero-slides.index') }}" class="row g-2 mb-4">
                <div class="col-md-6">
                    <input type="search" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search slide title or eyebrow">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-info w-100 mb-0" type="submit">Search</button>
                </div>
            </form>

            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sort</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($slides as $slide)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ $slide->imageUrl() }}" class="avatar avatar-sm me-3" alt="{{ $slide->image_alt ?: $slide->title }}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $slide->title }}</h6>
                                        @if ($slide->eyebrow)
                                            <p class="text-xs text-secondary mb-0">{{ $slide->eyebrow }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-sm bg-gradient-{{ $slide->is_active ? 'success' : 'secondary' }} text-uppercase">{{ $slide->is_active ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td><p class="text-sm font-weight-bold mb-0">{{ $slide->sort_order }}</p></td>
                                <td><p class="text-sm mb-0">{{ $slide->updated_at?->format('Y-m-d H:i') }}</p></td>
                                <td class="align-middle text-end">
                                    <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="btn btn-link text-info mb-0 px-2">Edit</a>
                                    <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this hero slide?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger mb-0 px-2" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">
                                    <p class="mb-1">No hero slides found.</p>
                                    <p class="text-xs mb-0">The homepage will keep using its default hero until you add slides here.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $slides->links() }}
            </div>
        </div>
    </div>
@endsection