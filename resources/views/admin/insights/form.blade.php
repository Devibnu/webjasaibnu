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

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <div class="row">
                <div class="col-md-8">
                    <label>Title</label>
                    <input name="title" class="form-control mb-3" value="{{ old('title', $insight->title) }}" required>

                    <label>Slug</label>
                    <input name="slug" class="form-control mb-3" value="{{ old('slug', $insight->slug) }}" placeholder="Generated from title if blank">

                    <label>Excerpt</label>
                    <textarea name="excerpt" class="form-control mb-3" rows="3" required>{{ old('excerpt', $insight->excerpt) }}</textarea>

                    <label>Content</label>
                    <textarea name="content" class="form-control mb-3" rows="12" required>{{ old('content', $insight->content) }}</textarea>
                    <p class="text-xs text-secondary">Plain text is rendered safely. Prefix headings with <code>## </code>.</p>
                </div>

                <div class="col-md-4">
                    <label>Category</label>
                    <select name="insight_category_id" class="form-control mb-3">
                        <option value="">No category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) old('insight_category_id', $insight->insight_category_id) === (string) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <label>Status</label>
                    <select name="status" class="form-control mb-3" required>
                        <option value="draft" @selected(old('status', $insight->status) === 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $insight->status) === 'published')>Published</option>
                    </select>

                    <label>Published At</label>
                    <input type="datetime-local" name="published_at" class="form-control mb-3" value="{{ old('published_at', $insight->published_at?->format('Y-m-d\\TH:i')) }}">

                    <label>Featured Image</label>
                    <input type="file" name="featured_image" class="form-control mb-3" accept="image/jpeg,image/png,image/webp">
                    @if ($insight->exists && $insight->featured_image)
                        <img src="{{ $insight->imageUrl() }}" class="img-fluid border-radius-lg mb-3" alt="">
                    @endif

                    <label>SEO Title</label>
                    <input name="seo_title" class="form-control mb-3" value="{{ old('seo_title', $insight->seo_title) }}">

                    <label>SEO Description</label>
                    <textarea name="seo_description" class="form-control mb-3" rows="3">{{ old('seo_description', $insight->seo_description) }}</textarea>

                    <label>Sort Order</label>
                    <input type="number" name="sort_order" class="form-control mb-4" value="{{ old('sort_order', $insight->sort_order ?? 0) }}" min="0">

                    <button class="btn bg-gradient-info w-100" type="submit">{{ $button }}</button>
                    <a href="{{ route('admin.insights.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
