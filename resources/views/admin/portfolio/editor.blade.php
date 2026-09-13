@push('head')
<style>
    .portfolio-editor .editor-card { border: 1px solid #e9ecef; box-shadow: none; }
    .portfolio-editor .editor-title { color: #344767; font-size: .75rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; }
    .portfolio-editor .editor-copy { color: #8392ab; font-size: .75rem; }
    .portfolio-editor .image-preview { overflow: hidden; border: 1px solid #dee2e6; border-radius: .75rem; background: #f8f9fa; }
    .portfolio-editor .image-preview img { display: block; width: 100%; height: auto; max-height: 460px; object-fit: contain; }
    .portfolio-editor .editor-actions { display: flex; flex-direction: column; gap: .75rem; }
    .portfolio-editor .editor-submit { order: 1; }
    .portfolio-editor .editor-cancel { order: 2; }
    @media (min-width: 992px) {
        .portfolio-editor .editor-actions { flex-direction: row; justify-content: space-between; }
        .portfolio-editor .editor-actions .btn { width: auto !important; }
        .portfolio-editor .editor-submit { order: 2; }
        .portfolio-editor .editor-cancel { order: 1; }
    }
</style>
@endpush

@php
    $fieldClass = fn (string $name) => 'form-control' . ($errors->has($name) ? ' is-invalid' : '');
    $describedBy = fn (string $name, ?string $help = null) => trim(($help ?? '') . ($errors->has($name) ? ' portfolio-' . str_replace('_', '-', $name) . '-error' : ''));
@endphp

<div class="portfolio-editor">
    <header class="mb-4">
        <h4 class="mb-1">{{ $button }}</h4>
        <p class="text-sm text-secondary mb-0">Add or manage a project displayed in the JASAIBNU portfolio.</p>
    </header>

    @if ($errors->any())
        <div class="alert alert-danger text-white" role="alert" aria-labelledby="portfolio-error-heading">
            <p class="font-weight-bold mb-2" id="portfolio-error-heading">Please correct the following fields:</p>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" id="portfolio-form">
        @csrf
        @if ($method !== 'POST') @method($method) @endif

        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-8">
                <section class="card editor-card mb-4" aria-labelledby="project-information-heading">
                    <div class="card-header pb-0">
                        <h2 class="editor-title mb-1" id="project-information-heading">Project Information</h2>
                        <p class="editor-copy mb-0">Core project identity and public attribution.</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label font-weight-bold" for="portfolio-title">Title <span class="text-danger" aria-hidden="true">*</span></label>
                            <input name="title" id="portfolio-title" class="{{ $fieldClass('title') }}" value="{{ old('title', $item->title) }}" required @if($errors->has('title')) aria-invalid="true" aria-describedby="portfolio-title-error" @endif>
                            @error('title')<div class="invalid-feedback" id="portfolio-title-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold" for="portfolio-slug">Slug</label>
                            <input name="slug" id="portfolio-slug" class="{{ $fieldClass('slug') }}" value="{{ old('slug', $item->slug) }}" placeholder="project-slug" aria-describedby="{{ $describedBy('slug', 'portfolio-slug-help') }}" @if($errors->has('slug')) aria-invalid="true" @endif>
                            <div class="text-xs text-secondary mt-1" id="portfolio-slug-help">Generated from title when left blank.</div>
                            @error('slug')<div class="invalid-feedback" id="portfolio-slug-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-8 mb-3">
                                <label class="form-label font-weight-bold" for="portfolio-category">Category</label>
                                <select name="portfolio_category_id" id="portfolio-category" class="{{ $fieldClass('portfolio_category_id') }}" @if($errors->has('portfolio_category_id')) aria-invalid="true" aria-describedby="portfolio-portfolio-category-id-error" @endif>
                                    <option value="">No category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected((string) old('portfolio_category_id', $item->portfolio_category_id) === (string) $category->id)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('portfolio_category_id')<div class="invalid-feedback" id="portfolio-portfolio-category-id-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-md-4 mb-3">
                                <label class="form-label font-weight-bold" for="portfolio-code">Code</label>
                                <input name="code" id="portfolio-code" class="{{ $fieldClass('code') }}" value="{{ old('code', $item->code) }}" placeholder="CRM" aria-describedby="{{ $describedBy('code', 'portfolio-code-help') }}" @if($errors->has('code')) aria-invalid="true" @endif>
                                <div class="text-xs text-secondary mt-1" id="portfolio-code-help">Short internal/card fallback code, maximum 12 characters.</div>
                                @error('code')<div class="invalid-feedback" id="portfolio-code-error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold" for="portfolio-client-name">Client Name</label>
                            <input name="client_name" id="portfolio-client-name" class="{{ $fieldClass('client_name') }}" value="{{ old('client_name', $item->client_name) }}" aria-describedby="{{ $describedBy('client_name', 'portfolio-client-name-help') }}" @if($errors->has('client_name')) aria-invalid="true" @endif>
                            <div class="text-xs text-secondary mt-1" id="portfolio-client-name-help">Optional. Displayed publicly when provided.</div>
                            @error('client_name')<div class="invalid-feedback" id="portfolio-client-name-error">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="form-label font-weight-bold" for="portfolio-project-url">Project URL</label>
                            <input type="url" name="project_url" id="portfolio-project-url" class="{{ $fieldClass('project_url') }}" value="{{ old('project_url', $item->project_url) }}" placeholder="https://example.com" aria-describedby="{{ $describedBy('project_url', 'portfolio-project-url-help') }}" @if($errors->has('project_url')) aria-invalid="true" @endif>
                            <div class="text-xs text-secondary mt-1" id="portfolio-project-url-help">Optional public project or website URL.</div>
                            @error('project_url')<div class="invalid-feedback" id="portfolio-project-url-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </section>

                <section class="card editor-card mb-4" aria-labelledby="project-content-heading">
                    <div class="card-header pb-0">
                        <h2 class="editor-title mb-1" id="project-content-heading">Project Content</h2>
                        <p class="editor-copy mb-0">Describe the project clearly for portfolio visitors.</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label font-weight-bold" for="portfolio-excerpt">Excerpt</label>
                            <textarea name="excerpt" id="portfolio-excerpt" class="{{ $fieldClass('excerpt') }}" rows="4" @if($errors->has('excerpt')) aria-invalid="true" aria-describedby="portfolio-excerpt-error" @endif>{{ old('excerpt', $item->excerpt) }}</textarea>
                            @error('excerpt')<div class="invalid-feedback" id="portfolio-excerpt-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold" for="portfolio-description">Description</label>
                            <textarea name="description" id="portfolio-description" class="{{ $fieldClass('description') }}" rows="8" @if($errors->has('description')) aria-invalid="true" aria-describedby="portfolio-description-error" @endif>{{ old('description', $item->description) }}</textarea>
                            @error('description')<div class="invalid-feedback" id="portfolio-description-error">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="form-label font-weight-bold" for="portfolio-technologies">Technologies</label>
                            <input name="technologies" id="portfolio-technologies" class="{{ $fieldClass('technologies') }}" value="{{ old('technologies', implode(', ', $item->technologyList())) }}" placeholder="Laravel, PostgreSQL, REST API" aria-describedby="{{ $describedBy('technologies', 'portfolio-technologies-help') }}" @if($errors->has('technologies')) aria-invalid="true" @endif>
                            <div class="text-xs text-secondary mt-1" id="portfolio-technologies-help">Separate technologies with commas.</div>
                            @error('technologies')<div class="invalid-feedback" id="portfolio-technologies-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </section>

                <section class="card editor-card mb-4 mb-lg-0" aria-labelledby="project-media-heading">
                    <div class="card-header pb-0">
                        <h2 class="editor-title mb-1" id="project-media-heading">Project Media</h2>
                        <p class="editor-copy mb-0">Add a clear screenshot or featured project image.</p>
                    </div>
                    <div class="card-body">
                        <label class="form-label font-weight-bold" for="portfolio-image">Featured Image</label>
                        <input type="file" name="featured_image" id="portfolio-image" class="{{ $fieldClass('featured_image') }}" accept="image/jpeg,image/png,image/webp" aria-describedby="{{ $describedBy('featured_image', 'portfolio-image-help') }}" @if($errors->has('featured_image')) aria-invalid="true" @endif>
                        <div class="text-xs text-secondary mt-1" id="portfolio-image-help">JPG, PNG, or WebP • Max 2 MB</div>
                        @error('featured_image')<div class="invalid-feedback" id="portfolio-featured-image-error">{{ $message }}</div>@enderror
                        <input type="hidden" id="portfolio-has-existing-image" value="{{ ($item->exists && $item->imageUrl()) ? '1' : '0' }}">
                        <div class="image-preview mt-3" id="portfolio-image-preview-container" @if(! ($item->exists && $item->imageUrl())) hidden @endif>
                            <img id="portfolio-image-preview" src="{{ ($item->exists && $item->imageUrl()) ? $item->imageUrl() : '' }}" data-existing-src="{{ ($item->exists && $item->imageUrl()) ? $item->imageUrl() : '' }}" alt="{{ ($item->exists && $item->imageUrl()) ? 'Current featured image for ' . $item->title : 'Selected featured image preview' }}">
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-12 col-lg-4">
                <section class="card editor-card mb-4" aria-labelledby="publishing-heading">
                    <div class="card-header pb-0">
                        <h2 class="editor-title mb-1" id="publishing-heading">Publishing</h2>
                        <p class="editor-copy mb-0">Control visibility and display order.</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label font-weight-bold" for="portfolio-status">Status <span class="text-danger" aria-hidden="true">*</span></label>
                            <select name="status" id="portfolio-status" class="{{ $fieldClass('status') }}" required aria-describedby="{{ $describedBy('status', 'portfolio-status-help') }}" @if($errors->has('status')) aria-invalid="true" @endif>
                                <option value="draft" @selected(old('status', $item->status) === 'draft')>Draft</option>
                                <option value="published" @selected(old('status', $item->status) === 'published')>Published</option>
                            </select>
                            <div class="text-xs text-secondary mt-1" id="portfolio-status-help">Draft projects are not shown on the public portfolio.</div>
                            @error('status')<div class="invalid-feedback" id="portfolio-status-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold" for="portfolio-published-at">Published At</label>
                            <input type="datetime-local" name="published_at" id="portfolio-published-at" class="{{ $fieldClass('published_at') }}" value="{{ old('published_at', $item->published_at?->format('Y-m-d\TH:i')) }}" aria-describedby="{{ $describedBy('published_at', 'portfolio-published-at-help') }}" @if($errors->has('published_at')) aria-invalid="true" @endif>
                            <div class="text-xs text-secondary mt-1" id="portfolio-published-at-help">Automatically set when publishing if left blank.</div>
                            @error('published_at')<div class="invalid-feedback" id="portfolio-published-at-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input type="hidden" name="is_featured" value="0">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" @checked(old('is_featured', $item->is_featured))>
                            <label class="form-check-label" for="is_featured">Featured</label>
                        </div>
                        <div>
                            <label class="form-label font-weight-bold" for="portfolio-sort-order">Sort Order</label>
                            <input type="number" name="sort_order" id="portfolio-sort-order" class="{{ $fieldClass('sort_order') }}" value="{{ old('sort_order', $item->sort_order ?? 0) }}" min="0" @if($errors->has('sort_order')) aria-invalid="true" aria-describedby="portfolio-sort-order-error" @endif>
                            @error('sort_order')<div class="invalid-feedback" id="portfolio-sort-order-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </section>

                <section class="card editor-card" aria-labelledby="seo-readiness-heading">
                    <div class="card-header pb-0">
                        <h2 class="editor-title mb-1" id="seo-readiness-heading">Content &amp; SEO Readiness</h2>
                        <p class="editor-copy mb-0">Preview and readiness guidance for portfolio content. Individual public project pages are not currently enabled.</p>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div><h3 class="font-weight-bolder mb-0 text-info" id="portfolio-seo-score-val">0 / 100</h3><span class="badge badge-sm bg-gradient-secondary mt-1" id="portfolio-seo-status-badge">Poor</span></div>
                            <div class="text-end text-xs text-secondary"><span class="d-block font-weight-bold text-dark">Content check</span><span>Guidance only</span></div>
                        </div>
                        <div class="progress progress-xs mb-3"><div id="portfolio-seo-progress-bar" class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>
                        <div class="mb-3">
                            <span class="text-xs font-weight-bold text-dark d-block mb-1">Conceptual Search Preview</span>
                            <div class="bg-white p-2 border-radius-sm border shadow-xs" style="font-size: 13px; line-height: 1.4;">
                                <div class="text-xs text-secondary text-truncate" id="portfolio-preview-url">jasaibnu.com/portfolio</div>
                                <div class="text-primary font-weight-bold text-truncate" id="portfolio-preview-title" style="font-size: 15px;">Portfolio Project Title</div>
                                <div class="text-dark text-xs" id="portfolio-preview-desc" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">Project excerpt or meta description will appear here.</div>
                            </div>
                        </div>
                        <div style="max-height: 220px; overflow-y: auto;" class="pe-1 mb-3"><ul class="list-unstyled text-xs mb-0" id="portfolio-seo-checklist"></ul></div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center"><label class="form-label font-weight-bold mb-0" for="portfolio-seo-title">SEO Title</label><span class="text-xs text-secondary" id="portfolio-seo-title-counter">0 / 60</span></div>
                            <input name="seo_title" id="portfolio-seo-title" class="{{ $fieldClass('seo_title') }}" value="{{ old('seo_title', $item->seo_title) }}" placeholder="Fallback to title if blank" @if($errors->has('seo_title')) aria-invalid="true" aria-describedby="portfolio-seo-title-error" @endif>
                            @error('seo_title')<div class="invalid-feedback" id="portfolio-seo-title-error">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <div class="d-flex justify-content-between align-items-center"><label class="form-label font-weight-bold mb-0" for="portfolio-seo-desc">SEO Description</label><span class="text-xs text-secondary" id="portfolio-seo-desc-counter">0 / 160</span></div>
                            <textarea name="seo_description" id="portfolio-seo-desc" class="{{ $fieldClass('seo_description') }}" rows="3" placeholder="Fallback to excerpt if blank" @if($errors->has('seo_description')) aria-invalid="true" aria-describedby="portfolio-seo-desc-error" @endif>{{ old('seo_description', $item->seo_description) }}</textarea>
                            @error('seo_description')<div class="invalid-feedback" id="portfolio-seo-desc-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="card editor-card mt-4"><div class="card-body editor-actions">
            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-outline-secondary mb-0 w-100 editor-cancel">Cancel</a>
            <button class="btn bg-gradient-info mb-0 w-100 editor-submit" type="submit">{{ $button }}</button>
        </div></div>
    </form>
</div>
