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

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data" id="portfolio-form">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <div class="row">
                <div class="col-md-8">
                    <label>Title</label>
                    <input name="title" id="portfolio-title" class="form-control mb-3" value="{{ old('title', $item->title) }}" required>

                    <label>Slug</label>
                    <input name="slug" id="portfolio-slug" class="form-control mb-3" value="{{ old('slug', $item->slug) }}" placeholder="Generated from title if blank">

                    <label>Excerpt</label>
                    <textarea name="excerpt" id="portfolio-excerpt" class="form-control mb-3" rows="3">{{ old('excerpt', $item->excerpt) }}</textarea>

                    <label>Description</label>
                    <textarea name="description" id="portfolio-description" class="form-control mb-3" rows="10">{{ old('description', $item->description) }}</textarea>

                    <label>Technologies</label>
                    <input name="technologies" id="portfolio-technologies" class="form-control mb-3" value="{{ old('technologies', implode(', ', $item->technologyList())) }}" placeholder="Laravel, PostgreSQL, REST API">
                    <p class="text-xs text-secondary">Separate technologies with commas.</p>
                </div>

                <div class="col-md-4">
                    <div class="card border mb-3 shadow-none bg-gray-100">
                        <div class="card-body p-3">
                            <h6 class="text-uppercase text-xs font-weight-bolder mb-2 text-dark">Real-Time SEO Readiness</h6>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div>
                                    <h3 class="font-weight-bolder mb-0 text-info" id="portfolio-seo-score-val">0 / 100</h3>
                                    <span class="badge badge-sm bg-gradient-secondary mt-1" id="portfolio-seo-status-badge">Poor</span>
                                </div>
                                <div class="text-end text-xs text-secondary">
                                    <span class="d-block font-weight-bold text-dark">Project page check</span>
                                    <span>Guidance only</span>
                                </div>
                            </div>
                            <div class="progress progress-xs mb-3">
                                <div id="portfolio-seo-progress-bar" class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="mb-2">
                                <span class="text-xs font-weight-bold text-dark d-block mb-1">Google Search Preview</span>
                                <div class="bg-white p-2 border-radius-sm border shadow-xs" style="font-size: 13px; line-height: 1.4;">
                                    <div class="text-xs text-secondary text-truncate" id="portfolio-preview-url">jasaibnu.com/portfolio/slug</div>
                                    <div class="text-primary font-weight-bold text-truncate" id="portfolio-preview-title" style="font-size: 15px;">Portfolio Project Title</div>
                                    <div class="text-dark text-xs" id="portfolio-preview-desc" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">Project excerpt or meta description will appear here in search results.</div>
                                </div>
                            </div>

                            <div style="max-height: 220px; overflow-y: auto;" class="pe-1">
                                <ul class="list-unstyled text-xs mb-0" id="portfolio-seo-checklist"></ul>
                            </div>
                        </div>
                    </div>

                    <label>Category</label>
                    <select name="portfolio_category_id" id="portfolio-category" class="form-control mb-3">
                        <option value="">No category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) old('portfolio_category_id', $item->portfolio_category_id) === (string) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <label>Code</label>
                    <input name="code" class="form-control mb-3" value="{{ old('code', $item->code) }}" placeholder="CRM">

                    <label>Status</label>
                    <select name="status" id="portfolio-status" class="form-control mb-3" required>
                        <option value="draft" @selected(old('status', $item->status) === 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $item->status) === 'published')>Published</option>
                    </select>

                    <label>Published At</label>
                    <input type="datetime-local" name="published_at" class="form-control mb-3" value="{{ old('published_at', $item->published_at?->format('Y-m-d\\TH:i')) }}">

                    <label>Featured Image</label>
                    <input type="file" name="featured_image" id="portfolio-image" class="form-control mb-3" accept="image/jpeg,image/png,image/webp">
                    <input type="hidden" id="portfolio-has-existing-image" value="{{ ($item->exists && $item->imageUrl()) ? '1' : '0' }}">
                    @if ($item->exists && $item->imageUrl())
                        <img src="{{ $item->imageUrl() }}" class="img-fluid border-radius-lg mb-3" alt="">
                    @endif

                    <label>Client Name</label>
                    <input name="client_name" class="form-control mb-3" value="{{ old('client_name', $item->client_name) }}">

                    <label>Project URL</label>
                    <input type="url" name="project_url" id="portfolio-project-url" class="form-control mb-3" value="{{ old('project_url', $item->project_url) }}" placeholder="https://example.com">

                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="is_featured" value="0">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" @checked(old('is_featured', $item->is_featured))>
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label font-weight-bold mb-0">SEO Title</label>
                        <span class="text-xs text-secondary" id="portfolio-seo-title-counter">0 / 60</span>
                    </div>
                    <input name="seo_title" id="portfolio-seo-title" class="form-control mb-3" value="{{ old('seo_title', $item->seo_title) }}" placeholder="Fallback to title if blank">

                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label font-weight-bold mb-0">SEO Description</label>
                        <span class="text-xs text-secondary" id="portfolio-seo-desc-counter">0 / 160</span>
                    </div>
                    <textarea name="seo_description" id="portfolio-seo-desc" class="form-control mb-3" rows="3" placeholder="Fallback to excerpt if blank">{{ old('seo_description', $item->seo_description) }}</textarea>

                    <label>Sort Order</label>
                    <input type="number" name="sort_order" class="form-control mb-4" value="{{ old('sort_order', $item->sort_order ?? 0) }}" min="0">

                    <button class="btn bg-gradient-info w-100" type="submit">{{ $button }}</button>
                    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('portfolio-title');
    const slugInput = document.getElementById('portfolio-slug');
    const excerptInput = document.getElementById('portfolio-excerpt');
    const descriptionInput = document.getElementById('portfolio-description');
    const technologiesInput = document.getElementById('portfolio-technologies');
    const categorySelect = document.getElementById('portfolio-category');
    const statusSelect = document.getElementById('portfolio-status');
    const imageInput = document.getElementById('portfolio-image');
    const projectUrlInput = document.getElementById('portfolio-project-url');
    const hasExistingImage = document.getElementById('portfolio-has-existing-image').value === '1';
    const seoTitleInput = document.getElementById('portfolio-seo-title');
    const seoDescInput = document.getElementById('portfolio-seo-desc');

    const scoreVal = document.getElementById('portfolio-seo-score-val');
    const statusBadge = document.getElementById('portfolio-seo-status-badge');
    const progressBar = document.getElementById('portfolio-seo-progress-bar');
    const checklistEl = document.getElementById('portfolio-seo-checklist');

    const previewUrl = document.getElementById('portfolio-preview-url');
    const previewTitle = document.getElementById('portfolio-preview-title');
    const previewDesc = document.getElementById('portfolio-preview-desc');
    const titleCounter = document.getElementById('portfolio-seo-title-counter');
    const descCounter = document.getElementById('portfolio-seo-desc-counter');

    function cleanSlug(value) {
        return value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
    }

    function setCounter(counter, length, idealMin, idealMax, max) {
        counter.textContent = `${length} / ${max}`;
        if (length === 0) {
            counter.className = 'text-xs text-secondary';
        } else if (length >= idealMin && length <= idealMax) {
            counter.className = 'text-xs text-success font-weight-bold';
        } else {
            counter.className = 'text-xs text-warning font-weight-bold';
        }
    }

    function analyzeSEO() {
        const title = titleInput.value.trim();
        const slug = slugInput.value.trim() || cleanSlug(title);
        const excerpt = excerptInput.value.trim();
        const description = descriptionInput.value.trim();
        const technologies = technologiesInput.value.trim();
        const technologyCount = technologies ? technologies.split(',').map((tag) => tag.trim()).filter(Boolean).length : 0;
        const categoryId = categorySelect.value;
        const status = statusSelect.value;
        const hasImage = hasExistingImage || (imageInput.files && imageInput.files.length > 0);
        const hasProjectUrl = projectUrlInput.value.trim().length > 0;
        const seoTitle = seoTitleInput.value.trim() || title;
        const seoDesc = seoDescInput.value.trim() || excerpt;

        setCounter(titleCounter, seoTitle.length, 30, 60, 60);
        setCounter(descCounter, seoDesc.length, 120, 160, 160);

        previewUrl.textContent = `jasaibnu.com/portfolio/${slug || 'slug'}`;
        previewTitle.textContent = seoTitle || 'Portfolio Project Title';
        previewDesc.textContent = seoDesc || 'Project excerpt or meta description will appear here in search results.';

        let score = 0;
        const checks = [];

        if (seoTitle.length >= 30 && seoTitle.length <= 60) {
            score += 18;
            checks.push({ ok: true, text: 'SEO title length is good (30-60 chars).' });
        } else if (seoTitle.length > 0) {
            score += 9;
            checks.push({ ok: false, text: 'SEO title should ideally be 30-60 characters.' });
        } else {
            checks.push({ ok: false, text: 'SEO title is missing.' });
        }

        if (seoDesc.length >= 120 && seoDesc.length <= 160) {
            score += 18;
            checks.push({ ok: true, text: 'Meta description length is good (120-160 chars).' });
        } else if (seoDesc.length > 0) {
            score += 9;
            checks.push({ ok: false, text: 'Meta description should ideally be 120-160 characters.' });
        } else {
            checks.push({ ok: false, text: 'Meta description is missing.' });
        }

        if (slug.length > 0 && slug.length <= 75) {
            score += 10;
            checks.push({ ok: true, text: 'Slug is clean and not too long.' });
        } else if (slug.length > 75) {
            checks.push({ ok: false, text: 'Slug is too long; keep it under 75 characters.' });
        } else {
            checks.push({ ok: false, text: 'Slug is missing.' });
        }

        if (excerpt.length >= 50 && excerpt.length <= 300) {
            score += 10;
            checks.push({ ok: true, text: 'Excerpt length is good for a project summary.' });
        } else if (excerpt.length > 0) {
            score += 5;
            checks.push({ ok: false, text: 'Excerpt should be between 50 and 300 characters.' });
        } else {
            checks.push({ ok: false, text: 'Excerpt is missing.' });
        }

        if (description.length >= 250) {
            score += 12;
            checks.push({ ok: true, text: 'Project description has enough detail.' });
        } else if (description.length >= 100) {
            score += 6;
            checks.push({ ok: false, text: 'Project description is a bit short; add more context.' });
        } else {
            checks.push({ ok: false, text: 'Project description is too short.' });
        }

        if (hasImage) {
            score += 8;
            checks.push({ ok: true, text: 'Featured image is present.' });
        } else {
            checks.push({ ok: false, text: 'Add a featured image for stronger portfolio presentation.' });
        }

        if (categoryId) {
            score += 6;
            checks.push({ ok: true, text: 'Portfolio category is selected.' });
        } else {
            checks.push({ ok: false, text: 'Select a portfolio category.' });
        }

        if (technologyCount >= 2) {
            score += 6;
            checks.push({ ok: true, text: 'Technologies are listed.' });
        } else if (technologyCount === 1) {
            score += 3;
            checks.push({ ok: false, text: 'Add more technology tags if relevant.' });
        } else {
            checks.push({ ok: false, text: 'Add technology tags, separated with commas.' });
        }

        if (hasProjectUrl) {
            score += 6;
            checks.push({ ok: true, text: 'Project URL is filled.' });
        } else {
            checks.push({ ok: false, text: 'Add a project URL when there is a live demo or website.' });
        }

        if (status === 'published') {
            score += 6;
            checks.push({ ok: true, text: 'Project is ready to publish.' });
        } else {
            checks.push({ ok: false, text: 'Draft projects will not appear publicly until published.' });
        }

        score = Math.min(100, Math.max(0, score));
        scoreVal.textContent = `${score} / 100`;
        progressBar.style.width = `${score}%`;

        let statusText = 'Poor';
        let badgeClass = 'bg-gradient-danger';
        let barClass = 'progress-bar bg-danger';

        if (score >= 85) {
            statusText = 'Excellent';
            badgeClass = 'bg-gradient-success';
            barClass = 'progress-bar bg-success';
        } else if (score >= 70) {
            statusText = 'Good';
            badgeClass = 'bg-gradient-info';
            barClass = 'progress-bar bg-info';
        } else if (score >= 50) {
            statusText = 'Needs Improvement';
            badgeClass = 'bg-gradient-warning';
            barClass = 'progress-bar bg-warning';
        }

        statusBadge.textContent = statusText;
        statusBadge.className = `badge badge-sm ${badgeClass} mt-1`;
        progressBar.className = barClass;

        checklistEl.innerHTML = '';
        checks.forEach((check) => {
            const li = document.createElement('li');
            li.className = 'mb-1 d-flex align-items-start';
            const icon = check.ok ? '<i class="fas fa-check-circle text-success me-2 mt-1"></i>' : '<i class="fas fa-exclamation-circle text-warning me-2 mt-1"></i>';
            li.innerHTML = `${icon}<span class="${check.ok ? 'text-dark font-weight-bold' : 'text-secondary'}">${check.text}</span>`;
            checklistEl.appendChild(li);
        });
    }

    [
        titleInput,
        slugInput,
        excerptInput,
        descriptionInput,
        technologiesInput,
        categorySelect,
        statusSelect,
        imageInput,
        projectUrlInput,
        seoTitleInput,
        seoDescInput,
    ].forEach((el) => {
        if (el) {
            el.addEventListener('input', analyzeSEO);
            el.addEventListener('change', analyzeSEO);
        }
    });

    analyzeSEO();
});
</script>
@endpush
