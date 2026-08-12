@extends('admin.layouts.app')

@section('title', 'Insights')
@section('page', 'Insights')

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <div>
                <h6>Insights</h6>
                <p class="text-sm mb-0">Manage published and draft articles.</p>
            </div>
            <a href="{{ route('admin.insights.create') }}" class="btn bg-gradient-info mb-0">Add Insight</a>
        </div>
        <div class="card-body px-4 pt-3 pb-2">
            @if (session('status'))
                <div class="alert alert-success text-white">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger text-white">{{ $errors->first() }}</div>
            @endif

            <form method="GET" action="{{ route('admin.insights.index') }}" class="row g-2 mb-4">
                <div class="col-md-4">
                    <input type="search" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control" placeholder="Search title or excerpt">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All status</option>
                        <option value="published" @selected(($filters['status'] ?? '') === 'published')>Published</option>
                        <option value="draft" @selected(($filters['status'] ?? '') === 'draft')>Draft</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-control">
                        <option value="">All categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) ($filters['category'] ?? '') === (string) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-info w-100 mb-0" type="submit">Filter</button>
                </div>
            </form>

            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Published</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($insights as $insight)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ $insight->imageUrl() }}" class="avatar avatar-sm me-3" alt="">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $insight->title }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $insight->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td><p class="text-sm font-weight-bold mb-0">{{ $insight->categoryName() }}</p></td>
                                <td><span class="badge badge-sm bg-gradient-{{ $insight->status === 'published' ? 'success' : 'secondary' }}">{{ ucfirst($insight->status) }}</span></td>
                                <td><p class="text-sm mb-0">{{ $insight->published_at?->format('Y-m-d H:i') ?: '-' }}</p></td>
                                <td><p class="text-sm mb-0">{{ $insight->updated_at?->format('Y-m-d H:i') }}</p></td>
                                <td class="align-middle text-end">
                                    <a href="{{ route('admin.insights.edit', $insight) }}" class="btn btn-link text-info mb-0 px-2">Edit</a>
                                    <form action="{{ route('admin.insights.destroy', $insight) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this insight?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger mb-0 px-2" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">No insights found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $insights->links() }}
            </div>
        </div>
    </div>
@endsection
