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
                    <input name="title" class="form-control mb-3" value="{{ old('title', $item->title) }}" required>

                    <label>Slug</label>
                    <input name="slug" class="form-control mb-3" value="{{ old('slug', $item->slug) }}" placeholder="Generated from title if blank">

                    <label>Excerpt</label>
                    <textarea name="excerpt" class="form-control mb-3" rows="3">{{ old('excerpt', $item->excerpt) }}</textarea>

                    <label>Description</label>
                    <textarea name="description" class="form-control mb-3" rows="10">{{ old('description', $item->description) }}</textarea>

                    <label>Technologies</label>
                    <input name="technologies" class="form-control mb-3" value="{{ old('technologies', implode(', ', $item->technologyList())) }}" placeholder="Laravel, PostgreSQL, REST API">
                    <p class="text-xs text-secondary">Separate technologies with commas.</p>
                </div>

                <div class="col-md-4">
                    <label>Category</label>
                    <select name="portfolio_category_id" class="form-control mb-3">
                        <option value="">No category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) old('portfolio_category_id', $item->portfolio_category_id) === (string) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <label>Code</label>
                    <input name="code" class="form-control mb-3" value="{{ old('code', $item->code) }}" placeholder="CRM">

                    <label>Status</label>
                    <select name="status" class="form-control mb-3" required>
                        <option value="draft" @selected(old('status', $item->status) === 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $item->status) === 'published')>Published</option>
                    </select>

                    <label>Published At</label>
                    <input type="datetime-local" name="published_at" class="form-control mb-3" value="{{ old('published_at', $item->published_at?->format('Y-m-d\\TH:i')) }}">

                    <label>Featured Image</label>
                    <input type="file" name="featured_image" class="form-control mb-3" accept="image/jpeg,image/png,image/webp">
                    @if ($item->exists && $item->imageUrl())
                        <img src="{{ $item->imageUrl() }}" class="img-fluid border-radius-lg mb-3" alt="">
                    @endif

                    <label>Client Name</label>
                    <input name="client_name" class="form-control mb-3" value="{{ old('client_name', $item->client_name) }}">

                    <label>Project URL</label>
                    <input type="url" name="project_url" class="form-control mb-3" value="{{ old('project_url', $item->project_url) }}" placeholder="https://example.com">

                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="is_featured" value="0">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" @checked(old('is_featured', $item->is_featured))>
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>

                    <label>SEO Title</label>
                    <input name="seo_title" class="form-control mb-3" value="{{ old('seo_title', $item->seo_title) }}">

                    <label>SEO Description</label>
                    <textarea name="seo_description" class="form-control mb-3" rows="3">{{ old('seo_description', $item->seo_description) }}</textarea>

                    <label>Sort Order</label>
                    <input type="number" name="sort_order" class="form-control mb-4" value="{{ old('sort_order', $item->sort_order ?? 0) }}" min="0">

                    <button class="btn bg-gradient-info w-100" type="submit">{{ $button }}</button>
                    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
