@include('admin.portfolio.editor')

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
    const imagePreviewContainer = document.getElementById('portfolio-image-preview-container');
    const imagePreview = document.getElementById('portfolio-image-preview');
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

        previewUrl.textContent = 'jasaibnu.com/portfolio';
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

    let generatedPreviewUrl = null;
    imageInput.addEventListener('change', function () {
        if (generatedPreviewUrl) {
            URL.revokeObjectURL(generatedPreviewUrl);
            generatedPreviewUrl = null;
        }

        const selectedImage = imageInput.files && imageInput.files[0];
        if (selectedImage) {
            generatedPreviewUrl = URL.createObjectURL(selectedImage);
            imagePreview.src = generatedPreviewUrl;
            imagePreview.alt = `Selected featured image preview for ${titleInput.value.trim() || 'portfolio project'}`;
            imagePreviewContainer.hidden = false;
            return;
        }

        const existingImageUrl = imagePreview.dataset.existingSrc;
        imagePreview.src = existingImageUrl;
        imagePreviewContainer.hidden = ! existingImageUrl;
    });

    window.addEventListener('beforeunload', function () {
        if (generatedPreviewUrl) {
            URL.revokeObjectURL(generatedPreviewUrl);
        }
    });

    analyzeSEO();
});
</script>
@endpush
