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
                    <label>Eyebrow / Small Heading</label>
                    <input name="eyebrow" class="form-control mb-3" value="{{ old('eyebrow', $slide->eyebrow) }}" placeholder="e.g. IT Solutions • Software Development • SaaS • AI Integration">

                    <label>Hero Title</label>
                    <input name="title" class="form-control mb-3" value="{{ old('title', $slide->title) }}" required>

                    <label>Description</label>
                    <textarea name="description" class="form-control mb-3" rows="4" placeholder="Short supporting paragraph shown under the title">{{ old('description', $slide->description) }}</textarea>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Primary CTA Text</label>
                            <input name="primary_button_text" class="form-control mb-3" value="{{ old('primary_button_text', $slide->primary_button_text) }}" placeholder="Konsultasi Gratis">
                        </div>
                        <div class="col-md-6">
                            <label>Primary CTA URL</label>
                            <input name="primary_button_url" class="form-control mb-3" value="{{ old('primary_button_url', $slide->primary_button_url) }}" placeholder="/contact or https://example.com">
                        </div>
                        <div class="col-md-6">
                            <label>Secondary CTA Text</label>
                            <input name="secondary_button_text" class="form-control mb-3" value="{{ old('secondary_button_text', $slide->secondary_button_text) }}" placeholder="Lihat Layanan">
                        </div>
                        <div class="col-md-6">
                            <label>Secondary CTA URL</label>
                            <input name="secondary_button_url" class="form-control mb-3" value="{{ old('secondary_button_url', $slide->secondary_button_url) }}" placeholder="/services or https://example.com">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label>Background Image</label>
                    <input type="file" name="image" class="form-control mb-2" accept=".jpg,.jpeg,.png,.webp">

                    @if ($slide->exists && $slide->image_path)
                        <img src="{{ $slide->imageUrl() }}" alt="{{ $slide->image_alt ?: $slide->title }}" class="img-fluid border-radius-lg mb-2 mt-1">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="remove_image">
                            <label class="form-check-label text-danger" for="remove_image">Remove Current Image</label>
                        </div>
                    @endif

                    <small class="text-muted d-block mb-3">
                        Recommended: 1920 × 900 px or larger, landscape image, JPG / PNG / WebP.<br>
                        Keep important subjects away from the extreme edges as the image may be cropped responsively.
                    </small>

                    <label>Image Alt Text</label>
                    <input name="image_alt" class="form-control mb-3" value="{{ old('image_alt', $slide->image_alt) }}" placeholder="Describe the background image">

                    <label>Overlay Opacity (0–100)</label>
                    <input type="number" name="overlay_opacity" class="form-control mb-3" value="{{ old('overlay_opacity', $slide->overlay_opacity ?? 70) }}" min="0" max="100">
                    <small class="text-muted d-block mb-3">Darkness of the overlay behind the text. 70 matches the current homepage look.</small>

                    <label>Sort Order</label>
                    <input type="number" name="sort_order" class="form-control mb-3" value="{{ old('sort_order', $slide->sort_order ?? 0) }}" min="0">

                    <div class="form-check form-switch mb-4">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $slide->is_active))>
                        <label class="form-check-label" for="is_active">Active (Visible on Homepage)</label>
                    </div>

                    <button class="btn bg-gradient-info w-100" type="submit">{{ $button }}</button>
                    <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>