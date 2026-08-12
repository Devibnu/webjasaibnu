@extends('admin.layouts.app')

@section('title', 'Portfolio Categories')
@section('page', 'Portfolio Categories')

@section('content')
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <div>
                <h6>Portfolio Categories</h6>
                <p class="text-sm mb-0">Organize public portfolio items by project type.</p>
            </div>
            <a href="{{ route('admin.portfolio-categories.create') }}" class="btn bg-gradient-info mb-0">Add Category</a>
        </div>
        <div class="card-body px-4 pt-3 pb-2">
            @if (session('status'))
                <div class="alert alert-success text-white">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger text-white">{{ $errors->first() }}</div>
            @endif

            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Slug</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Active</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Items</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sort</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td><h6 class="mb-0 text-sm px-2">{{ $category->name }}</h6></td>
                                <td><p class="text-sm mb-0">{{ $category->slug }}</p></td>
                                <td><span class="badge badge-sm bg-gradient-{{ $category->is_active ? 'success' : 'secondary' }}">{{ $category->is_active ? 'Yes' : 'No' }}</span></td>
                                <td><p class="text-sm mb-0">{{ $category->items_count }}</p></td>
                                <td><p class="text-sm mb-0">{{ $category->sort_order }}</p></td>
                                <td class="align-middle text-end">
                                    <a href="{{ route('admin.portfolio-categories.edit', $category) }}" class="btn btn-link text-info mb-0 px-2">Edit</a>
                                    <form action="{{ route('admin.portfolio-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger mb-0 px-2" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $categories->links() }}</div>
        </div>
    </div>
@endsection
