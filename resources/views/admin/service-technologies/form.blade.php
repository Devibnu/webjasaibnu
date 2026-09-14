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

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data" id="service-technology-form">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <div class="row">
                <div class="col-md-8">
                    <label>Name</label>
                    <input name="name" class="form-control mb-3" value="{{ old('name', $technology->name) }}" placeholder="Laravel" required>

                    <label>Logo</label>
                    <div class="mb-2" id="service-technology-logo-preview-container" @if(! $technology->logo_path) hidden @endif>
                        <img
                            id="service-technology-logo-preview"
                            src="{{ $technology->logo_path ? asset('storage/' . $technology->logo_path) : '' }}"
                            data-existing-src="{{ $technology->logo_path ? asset('storage/' . $technology->logo_path) : '' }}"
                            alt="{{ $technology->logo_path ? 'Current logo for ' . $technology->name : 'Selected technology logo preview' }}"
                            style="max-width: 120px; max-height: 70px; object-fit: contain;"
                            class="border rounded p-2"
                        >
                    </div>
                    @if ($technology->logo_path)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="remove_logo" value="1" id="remove_logo">
                            <label class="form-check-label text-danger" for="remove_logo">Remove Logo</label>
                        </div>
                    @endif
                    <input type="file" name="logo_path" id="service-technology-logo" class="form-control mb-1" accept=".jpg,.jpeg,.png,.webp" aria-describedby="service-technology-logo-help service-technology-logo-status service-technology-logo-error">
                    <small class="text-muted d-block" id="service-technology-logo-help">Upload logo PNG, JPG, atau WebP. Maksimal 2 MB. Jika kosong, fallback mark tetap dipakai.</small>
                    @error('logo_path')
                        <div class="text-danger text-xs mt-1">{{ $message }}</div>
                    @enderror
                    <div class="text-info text-xs font-weight-bold mt-2" id="service-technology-logo-status" role="status" aria-live="polite"></div>
                    <div class="text-danger text-xs font-weight-bold mt-2 mb-3" id="service-technology-logo-error" role="alert" hidden></div>
                </div>

                <div class="col-md-4">
                    <label>Fallback Mark</label>
                    <input name="mark" class="form-control mb-3" value="{{ old('mark', $technology->mark) }}" placeholder="Lv">

                    <label>Sort Order</label>
                    <input type="number" name="sort_order" class="form-control mb-3" value="{{ old('sort_order', $technology->sort_order ?? 0) }}" min="0">

                    <div class="form-check form-switch mb-4">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $technology->is_active))>
                        <label class="form-check-label" for="is_active">Active (Visible Publicly)</label>
                    </div>

                    <button class="btn bg-gradient-info w-100" type="submit" id="service-technology-submit">{{ $button }}</button>
                    <a href="{{ route('admin.service-technologies.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('service-technology-form');
    const logoInput = document.getElementById('service-technology-logo');
    const logoPreviewContainer = document.getElementById('service-technology-logo-preview-container');
    const logoPreview = document.getElementById('service-technology-logo-preview');
    const logoStatus = document.getElementById('service-technology-logo-status');
    const logoError = document.getElementById('service-technology-logo-error');
    const submitButton = document.getElementById('service-technology-submit');

    if (! form || ! logoInput || ! logoPreviewContainer || ! logoPreview || ! logoStatus || ! logoError || ! submitButton) {
        return;
    }

    const MAX_LOGO_BYTES = 2 * 1024 * 1024;
    const TARGET_LOGO_BYTES = 750 * 1024;
    const MAX_LOGO_DIMENSION = 1200;
    const MIN_LOGO_DIMENSION = 480;
    const ALLOWED_LOGO_TYPES = ['image/jpeg', 'image/png', 'image/webp'];
    const LOGO_QUALITIES = [0.84, 0.78, 0.72, 0.66, 0.62];
    let generatedPreviewUrl = null;
    let logoSelectionVersion = 0;
    let compressionInProgress = false;
    let processingError = false;

    function formatFileSize(bytes) {
        if (bytes >= 1024 * 1024) {
            return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
        }

        return `${Math.round(bytes / 1024)} KB`;
    }

    function setProcessingState(processing) {
        compressionInProgress = processing;
        submitButton.disabled = processing;
        submitButton.setAttribute('aria-busy', processing ? 'true' : 'false');
    }

    function clearFeedback() {
        processingError = false;
        logoStatus.textContent = '';
        logoError.textContent = '';
        logoError.hidden = true;
        logoInput.setCustomValidity('');
    }

    function showLogoError(message) {
        processingError = true;
        logoStatus.textContent = '';
        logoError.textContent = message;
        logoError.hidden = false;
        logoInput.setCustomValidity(message);
    }

    function revokeGeneratedPreview() {
        if (generatedPreviewUrl) {
            URL.revokeObjectURL(generatedPreviewUrl);
            generatedPreviewUrl = null;
        }
    }

    function restoreExistingPreview() {
        revokeGeneratedPreview();
        const existingSrc = logoPreview.dataset.existingSrc;
        logoPreview.src = existingSrc;
        logoPreview.alt = existingSrc ? 'Current technology logo' : 'Selected technology logo preview';
        logoPreviewContainer.hidden = ! existingSrc;
    }

    function showLogoPreview(file) {
        revokeGeneratedPreview();
        generatedPreviewUrl = URL.createObjectURL(file);
        logoPreview.src = generatedPreviewUrl;
        logoPreview.alt = 'Selected technology logo preview';
        logoPreviewContainer.hidden = false;
    }

    function loadImage(file) {
        return new Promise((resolve, reject) => {
            const sourceUrl = URL.createObjectURL(file);
            const image = new Image();

            image.onload = function () {
                URL.revokeObjectURL(sourceUrl);
                resolve(image);
            };
            image.onerror = function () {
                URL.revokeObjectURL(sourceUrl);
                reject(new Error('The selected logo could not be read by this browser.'));
            };
            image.src = sourceUrl;
        });
    }

    function drawScaledImage(image, width, height) {
        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;
        const context = canvas.getContext('2d', { alpha: true });

        if (! context) {
            throw new Error('Logo optimization is not supported by this browser.');
        }

        context.imageSmoothingEnabled = true;
        context.imageSmoothingQuality = 'high';
        context.clearRect(0, 0, width, height);
        context.drawImage(image, 0, 0, width, height);
        return canvas;
    }

    function canvasToBlob(canvas, type, quality) {
        return new Promise((resolve) => canvas.toBlob(resolve, type, quality));
    }

    async function compressLogo(file) {
        const image = await loadImage(file);
        const originalLongestSide = Math.max(image.naturalWidth, image.naturalHeight);
        let scale = Math.min(1, MAX_LOGO_DIMENSION / originalLongestSide);
        let bestBlob = null;
        let bestType = null;

        for (let dimensionPass = 0; dimensionPass < 5; dimensionPass += 1) {
            const width = Math.max(1, Math.round(image.naturalWidth * scale));
            const height = Math.max(1, Math.round(image.naturalHeight * scale));
            const canvas = drawScaledImage(image, width, height);

            for (const quality of LOGO_QUALITIES) {
                let blob = await canvasToBlob(canvas, 'image/webp', quality);
                let outputType = blob && blob.type === 'image/webp' ? 'image/webp' : null;

                if (! outputType && file.type === 'image/jpeg') {
                    blob = await canvasToBlob(canvas, 'image/jpeg', quality);
                    outputType = blob && blob.type === 'image/jpeg' ? 'image/jpeg' : null;
                }

                if (! blob || ! outputType) {
                    continue;
                }

                if (! bestBlob || blob.size < bestBlob.size) {
                    bestBlob = blob;
                    bestType = outputType;
                }

                if (blob.size <= TARGET_LOGO_BYTES) {
                    return { blob, type: outputType };
                }
            }

            const currentLongestSide = Math.max(width, height);
            if (currentLongestSide <= MIN_LOGO_DIMENSION) {
                break;
            }

            scale *= Math.max(0.8, MIN_LOGO_DIMENSION / currentLongestSide);
        }

        if (bestBlob && bestBlob.size < MAX_LOGO_BYTES) {
            return { blob: bestBlob, type: bestType };
        }

        if (file.type !== 'image/jpeg') {
            throw new Error('This browser could not create a transparent WebP logo below 2 MB. Please choose a smaller PNG or WebP image.');
        }

        throw new Error('This logo could not be optimized below 2 MB. Please choose a smaller image.');
    }

    function replaceSelectedFile(blob, originalFile, outputType) {
        if (typeof DataTransfer === 'undefined' || typeof File === 'undefined') {
            throw new Error('This browser cannot attach the optimized logo. Please choose an image below 2 MB.');
        }

        const extension = outputType === 'image/webp' ? 'webp' : 'jpg';
        const baseName = originalFile.name.replace(/\.[^.]+$/, '') || 'technology-logo';
        const optimizedFile = new File([blob], `${baseName}-optimized.${extension}`, {
            type: outputType,
            lastModified: Date.now(),
        });
        const transfer = new DataTransfer();
        transfer.items.add(optimizedFile);
        logoInput.files = transfer.files;
        return optimizedFile;
    }

    logoInput.addEventListener('change', async function () {
        const selectionVersion = ++logoSelectionVersion;
        setProcessingState(false);
        clearFeedback();
        const selectedLogo = logoInput.files && logoInput.files[0];

        if (! selectedLogo) {
            restoreExistingPreview();
            return;
        }

        if (! ALLOWED_LOGO_TYPES.includes(selectedLogo.type)) {
            showLogoError('Please select a JPEG, PNG, or WebP logo. SVG is not supported.');
            return;
        }

        if (selectedLogo.size <= MAX_LOGO_BYTES) {
            showLogoPreview(selectedLogo);
            logoStatus.textContent = `Selected logo: ${formatFileSize(selectedLogo.size)}. No optimization needed.`;
            return;
        }

        setProcessingState(true);
        logoInput.setCustomValidity('Please wait while the logo is being optimized.');
        logoStatus.textContent = 'Optimizing logo...';

        try {
            const optimized = await compressLogo(selectedLogo);
            if (selectionVersion !== logoSelectionVersion) {
                return;
            }

            const optimizedFile = replaceSelectedFile(optimized.blob, selectedLogo, optimized.type);
            logoInput.setCustomValidity('');
            processingError = false;
            showLogoPreview(optimizedFile);
            logoStatus.textContent = `Original: ${formatFileSize(selectedLogo.size)} → Optimized: ${formatFileSize(optimizedFile.size)}. Image optimized automatically for web.`;
        } catch (error) {
            if (selectionVersion === logoSelectionVersion) {
                showLogoError(error instanceof Error ? error.message : 'Logo optimization failed. Please choose an image below 2 MB.');
            }
        } finally {
            if (selectionVersion === logoSelectionVersion) {
                setProcessingState(false);
            }
        }
    });

    form.addEventListener('submit', function (event) {
        const selectedLogo = logoInput.files && logoInput.files[0];

        if (compressionInProgress || processingError || (selectedLogo && selectedLogo.size > MAX_LOGO_BYTES)) {
            event.preventDefault();
            if (compressionInProgress) {
                showLogoError('Please wait until logo optimization is complete.');
            } else if (! processingError) {
                showLogoError('The selected logo is still larger than 2 MB and cannot be submitted.');
            }
            logoInput.reportValidity();
        }
    });

    window.addEventListener('beforeunload', revokeGeneratedPreview);
});
</script>
@endpush
