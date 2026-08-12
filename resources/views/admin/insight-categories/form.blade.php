<div class="card">
    <div class="card-header pb-0">
        <h6>{{ $button }}</h6>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger text-white">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ $action }}" method="POST">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <label>Name</label>
            <input name="name" class="form-control mb-3" value="{{ old('name', $category->name) }}" required>

            <label>Slug</label>
            <input name="slug" class="form-control mb-3" value="{{ old('slug', $category->slug) }}" placeholder="Generated from name if blank">

            <label>Sort Order</label>
            <input type="number" name="sort_order" class="form-control mb-3" value="{{ old('sort_order', $category->sort_order ?? 0) }}" min="0">

            <div class="form-check form-switch mb-4">
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true))>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <button class="btn bg-gradient-info" type="submit">{{ $button }}</button>
            <a href="{{ route('admin.insight-categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
