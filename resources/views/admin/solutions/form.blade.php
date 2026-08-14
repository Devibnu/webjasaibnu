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

            <div class="row">
                <div class="col-md-8">
                    <label>Title</label>
                    <input name="title" class="form-control mb-3" value="{{ old('title', $solution->title) }}" required>

                    <label>Slug</label>
                    <input name="slug" class="form-control mb-3" value="{{ old('slug', $solution->slug) }}" placeholder="Generated from title if blank">

                    <label>Description</label>
                    <textarea name="description" class="form-control mb-3" rows="4" required>{{ old('description', $solution->description) }}</textarea>
                </div>

                <div class="col-md-4">
                    <label>Icon Badge Code</label>
                    <input name="icon" class="form-control mb-3" value="{{ old('icon', $solution->icon) }}" placeholder="BA, SI, CL, AI, DP, LM" required>
                    <small class="text-secondary d-block mb-3">Short badge text rendered inside solution card icon box.</small>

                    <label>Sort Order</label>
                    <input type="number" name="sort_order" class="form-control mb-3" value="{{ old('sort_order', $solution->sort_order ?? 0) }}" min="0">

                    <div class="form-check form-switch mb-4">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $solution->is_active))>
                        <label class="form-check-label" for="is_active">Active (Visible Publicly)</label>
                    </div>

                    <button class="btn bg-gradient-info w-100" type="submit">{{ $button }}</button>
                    <a href="{{ route('admin.solutions.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
