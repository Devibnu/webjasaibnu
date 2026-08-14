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

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data" id="insight-form">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <div class="row">
                <div class="col-md-8">
                    <label class="form-label font-weight-bold">Title</label>
                    <input name="title" id="insight-title" class="form-control mb-3" value="{{ old('title', $insight->title) }}" required>

                    <label class="form-label font-weight-bold">Slug</label>
                    <input name="slug" id="insight-slug" class="form-control mb-3" value="{{ old('slug', $insight->slug) }}" placeholder="Generated from title if blank">

                    <label class="form-label font-weight-bold">Focus Keyword</label>
                    <input name="focus_keyword" id="insight-focus" class="form-control mb-3" value="{{ old('focus_keyword', $insight->focus_keyword) }}" placeholder="e.g. jasa pembuatan website">
                    <p class="text-xs text-secondary mb-3">Target keyword for on-page SEO readiness analysis.</p>

                    <label class="form-label font-weight-bold">Excerpt</label>
                    <textarea name="excerpt" id="insight-excerpt" class="form-control mb-3" rows="3" required>{{ old('excerpt', $insight->excerpt) }}</textarea>

                    <label class="form-label font-weight-bold">Content</label>
                    <textarea name="content" id="insight-content" class="form-control mb-3" rows="12" required>{{ old('content', $insight->content) }}</textarea>
                    <p class="text-xs text-secondary">Plain text is rendered safely. Prefix headings with <code>## </code>.</p>
                </div>

                <div class="col-md-4">
                    <!-- Real-Time SEO Panel -->
                    <div class="card border mb-3 shadow-none bg-gray-100">
                        <div class="card-body p-3">
                            <h6 class="text-uppercase text-xs font-weight-bolder mb-2 text-dark">Real-Time SEO Readiness</h6>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div>
                                    <h3 class="font-weight-bolder mb-0 text-info" id="seo-score-val">0 / 100</h3>
                                    <span class="badge badge-sm bg-gradient-secondary mt-1" id="seo-status-badge">Poor</span>
                                </div>
                                <div class="text-end text-xs text-secondary">
                                    <span class="d-block font-weight-bold text-dark">On-page check</span>
                                    <span>Guidance only</span>
                                </div>
                            </div>
                            <div class="progress progress-xs mb-3">
                                <div id="seo-progress-bar" class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="mb-2">
                                <span class="text-xs font-weight-bold text-dark d-block mb-1">Google Search Preview</span>
                                <div class="bg-white p-2 border-radius-sm border shadow-xs" style="font-size: 13px; line-height: 1.4;">
                                    <div class="text-xs text-secondary text-truncate" id="preview-url">jasaibnu.com/insights/slug</div>
                                    <div class="text-primary font-weight-bold text-truncate" id="preview-title" style="font-size: 15px;">Insight Title</div>
                                    <div class="text-dark text-xs" id="preview-desc" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">Insight excerpt or meta description will appear here in search results.</div>
                                </div>
                            </div>

                            <div style="max-height: 220px; overflow-y: auto;" class="pe-1">
                                <ul class="list-unstyled text-xs mb-0" id="seo-checklist">
                                    <!-- Dynamic checklist items -->
                                </ul>
                            </div>
                        </div>
                    </div>

                    <label class="form-label font-weight-bold">Category</label>
                    <select name="insight_category_id" id="insight-category" class="form-control mb-3">
                        <option value="">No category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) old('insight_category_id', $insight->insight_category_id) === (string) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <label class="form-label font-weight-bold">Status</label>
                    <select name="status" id="insight-status" class="form-control mb-3" required>
                        <option value="draft" @selected(old('status', $insight->status) === 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $insight->status) === 'published')>Published</option>
                    </select>

                    <label class="form-label font-weight-bold">Published At</label>
                    <input type="datetime-local" name="published_at" class="form-control mb-3" value="{{ old('published_at', $insight->published_at?->format('Y-m-d\\TH:i')) }}">

                    <label class="form-label font-weight-bold">Featured Image</label>
                    <input type="file" name="featured_image" id="insight-image" class="form-control mb-3" accept="image/jpeg,image/png,image/webp">
                    <input type="hidden" id="has-existing-image" value="{{ ($insight->exists && $insight->featured_image) ? '1' : '0' }}">
                    @if ($insight->exists && $insight->featured_image)
                        <img src="{{ $insight->imageUrl() }}" class="img-fluid border-radius-lg mb-3" alt="">
                    @endif

                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label font-weight-bold mb-0">SEO Title</label>
                        <span class="text-xs text-secondary" id="seo-title-counter">0 / 60</span>
                    </div>
                    <input name="seo_title" id="insight-seo-title" class="form-control mb-3" value="{{ old('seo_title', $insight->seo_title) }}" placeholder="Fallback to title if blank">

                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label font-weight-bold mb-0">SEO Description</label>
                        <span class="text-xs text-secondary" id="seo-desc-counter">0 / 160</span>
                    </div>
                    <textarea name="seo_description" id="insight-seo-desc" class="form-control mb-3" rows="3" placeholder="Fallback to excerpt if blank">{{ old('seo_description', $insight->seo_description) }}</textarea>

                    <label class="form-label font-weight-bold">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control mb-4" value="{{ old('sort_order', $insight->sort_order ?? 0) }}" min="0">

                    <button class="btn bg-gradient-info w-100" type="submit">{{ $button }}</button>
                    <a href="{{ route('admin.insights.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('insight-title');
    const slugInput = document.getElementById('insight-slug');
    const focusInput = document.getElementById('insight-focus');
    const excerptInput = document.getElementById('insight-excerpt');
    const contentInput = document.getElementById('insight-content');
    const categorySelect = document.getElementById('insight-category');
    const statusSelect = document.getElementById('insight-status');
    const imageInput = document.getElementById('insight-image');
    const hasExistingImage = document.getElementById('has-existing-image').value === '1';
    const seoTitleInput = document.getElementById('insight-seo-title');
    const seoDescInput = document.getElementById('insight-seo-desc');

    const scoreVal = document.getElementById('seo-score-val');
    const statusBadge = document.getElementById('seo-status-badge');
    const progressBar = document.getElementById('seo-progress-bar');
    const checklistEl = document.getElementById('seo-checklist');

    const previewUrl = document.getElementById('preview-url');
    const previewTitle = document.getElementById('preview-title');
    const previewDesc = document.getElementById('preview-desc');
    const titleCounter = document.getElementById('seo-title-counter');
    const descCounter = document.getElementById('seo-desc-counter');

    function analyzeSEO() {
        const title = titleInput.value.trim();
        let slug = slugInput.value.trim() || title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        const focus = focusInput.value.trim().toLowerCase();
        const excerpt = excerptInput.value.trim();
        const content = contentInput.value.trim();
        const categoryId = categorySelect.value;
        const status = statusSelect.value;
        const hasImage = hasExistingImage || (imageInput.files && imageInput.files.length > 0);
        const seoTitle = seoTitleInput.value.trim() || title;
        const seoDesc = seoDescInput.value.trim() || excerpt;

        // Counters
        titleCounter.textContent = `${seoTitle.length} / 60`;
        if (seoTitle.length === 0) {
            titleCounter.className = 'text-xs text-secondary';
        } else if (seoTitle.length >= 30 && seoTitle.length <= 60) {
            titleCounter.className = 'text-xs text-success font-weight-bold';
        } else {
            titleCounter.className = 'text-xs text-warning font-weight-bold';
        }

        descCounter.textContent = `${seoDesc.length} / 160`;
        if (seoDesc.length === 0) {
            descCounter.className = 'text-xs text-secondary';
        } else if (seoDesc.length >= 120 && seoDesc.length <= 160) {
            descCounter.className = 'text-xs text-success font-weight-bold';
        } else {
            descCounter.className = 'text-xs text-warning font-weight-bold';
        }

        // Preview
        previewUrl.textContent = `jasaibnu.com/insights/${slug || 'slug'}`;
        previewTitle.textContent = seoTitle || 'Insight Title';
        previewDesc.textContent = seoDesc || 'Insight excerpt or meta description will appear here in search results.';

        // Scoring rules
        let score = 0;
        let checks = [];

        // 1. SEO Title quality (15 pts)
        if (seoTitle.length >= 30 && seoTitle.length <= 60) {
            score += 15;
            checks.push({ ok: true, text: 'SEO title length is good (30-60 chars).' });
        } else if (seoTitle.length > 0) {
            score += 8;
            checks.push({ ok: false, text: 'SEO title length should ideally be 30-60 characters.' });
        } else {
            checks.push({ ok: false, text: 'SEO title is missing.' });
        }

        // 2. SEO Description quality (15 pts)
        if (seoDesc.length >= 120 && seoDesc.length <= 160) {
            score += 15;
            checks.push({ ok: true, text: 'Meta description length is good (120-160 chars).' });
        } else if (seoDesc.length > 0) {
            score += 8;
            checks.push({ ok: false, text: 'Meta description should ideally be 120-160 characters.' });
        } else {
            checks.push({ ok: false, text: 'Meta description is missing.' });
        }

        if (focus) {
            // 3. Focus keyword in title (10 pts)
            const focusInTitle = seoTitle.toLowerCase().includes(focus);
            if (focusInTitle) {
                score += 10;
                checks.push({ ok: true, text: 'Focus keyword appears in SEO title.' });
            } else {
                checks.push({ ok: false, text: 'Focus keyword not found in SEO title.' });
            }

            // 4. Focus keyword in description (10 pts)
            const focusInDesc = seoDesc.toLowerCase().includes(focus);
            if (focusInDesc) {
                score += 10;
                checks.push({ ok: true, text: 'Focus keyword appears in meta description.' });
            } else {
                checks.push({ ok: false, text: 'Focus keyword not found in meta description.' });
            }

            // 5. Slug quality & keyword (10 pts)
            const focusSlugTerm = focus.split(/\s+/)[0];
            const slugHasKeyword = slug.toLowerCase().includes(focusSlugTerm);
            if (slugHasKeyword && slug.length <= 75) {
                score += 10;
                checks.push({ ok: true, text: 'Slug is clean and includes focus keyword.' });
            } else if (slug.length <= 75) {
                score += 6;
                checks.push({ ok: false, text: 'Slug is clean, but could include focus keyword terms.' });
            } else {
                checks.push({ ok: false, text: 'Slug is too long.' });
            }

            // 7. Keyword in content (10 pts)
            const contentLower = content.toLowerCase();
            const focusCount = (contentLower.match(new RegExp(focus.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'), 'g')) || []).length;
            if (focusCount >= 2 && focusCount <= 8) {
                score += 10;
                checks.push({ ok: true, text: `Focus keyword appears naturally in content (${focusCount} times).` });
            } else if (focusCount > 8) {
                score += 5;
                checks.push({ ok: false, text: 'Focus keyword appears too frequently (avoid keyword stuffing).' });
            } else if (focusCount === 1) {
                score += 6;
                checks.push({ ok: false, text: 'Focus keyword appears only once in content. Add a few more natural mentions.' });
            } else {
                checks.push({ ok: false, text: 'Focus keyword not found in article content.' });
            }
        } else {
            // Give default credit if no focus keyword specified yet
            score += 30;
            checks.push({ ok: false, text: 'Tip: Add a Focus Keyword to enable advanced on-page SEO checks.' });
        }

        // 6. Content quality / length (15 pts)
        if (content.length >= 400) {
            score += 15;
            checks.push({ ok: true, text: 'Article content has good length (>400 chars).' });
        } else if (content.length >= 150) {
            score += 8;
            checks.push({ ok: false, text: 'Article content is a bit short. Aim for more depth.' });
        } else {
            checks.push({ ok: false, text: 'Article content is too short.' });
        }

        // 8. Excerpt (5 pts)
        if (excerpt.length >= 50 && excerpt.length <= 300) {
            score += 5;
            checks.push({ ok: true, text: 'Excerpt length is good.' });
        } else {
            checks.push({ ok: false, text: 'Excerpt should be between 50 and 300 characters.' });
        }

        // 9. Featured image (5 pts)
        if (hasImage) {
            score += 5;
            checks.push({ ok: true, text: 'Featured image is present.' });
        } else {
            checks.push({ ok: false, text: 'Add a featured image for better social & SEO visibility.' });
        }

        // 10. Category (5 pts)
        if (categoryId) {
            score += 5;
            checks.push({ ok: true, text: 'Insight category is selected.' });
        } else {
            checks.push({ ok: false, text: 'Select an insight category.' });
        }

        // Ensure bounds
        score = Math.min(100, Math.max(0, score));

        // Display Score
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

        // Render checklist
        checklistEl.innerHTML = '';
        checks.forEach(check => {
            const li = document.createElement('li');
            li.className = 'mb-1 d-flex align-items-start';
            const icon = check.ok ? '<i class="fas fa-check-circle text-success me-2 mt-1"></i>' : '<i class="fas fa-exclamation-circle text-warning me-2 mt-1"></i>';
            li.innerHTML = `${icon}<span class="${check.ok ? 'text-dark font-weight-bold' : 'text-secondary'}">${check.text}</span>`;
            checklistEl.appendChild(li);
        });
    }

    [titleInput, slugInput, focusInput, excerptInput, contentInput, categorySelect, statusSelect, imageInput, seoTitleInput, seoDescInput].forEach(el => {
        if (el) {
            el.addEventListener('input', analyzeSEO);
            el.addEventListener('change', analyzeSEO);
        }
    });

    // Run initial analysis
    analyzeSEO();
});
</script>
@endpush
