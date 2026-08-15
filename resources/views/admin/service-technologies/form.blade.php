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
                    <label>Name</label>
                    <input name="name" class="form-control mb-3" value="{{ old('name', $technology->name) }}" placeholder="Laravel" required>

                    <label>Logo</label>
                    @if ($technology->logo_path)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $technology->logo_path) }}" alt="{{ $technology->name }}" style="max-width: 120px; max-height: 70px; object-fit: contain;" class="border rounded p-2">
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="remove_logo" value="1" id="remove_logo">
                            <label class="form-check-label text-danger" for="remove_logo">Remove Logo</label>
                        </div>
                    @endif
                    <input type="file" name="logo_path" class="form-control mb-1" accept=".jpg,.jpeg,.png,.webp,.svg">
                    <small class="text-muted d-block mb-3">Upload logo png, jpg, webp, atau svg. Jika kosong, fallback mark tetap dipakai.</small>
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

                    <button class="btn bg-gradient-info w-100" type="submit">{{ $button }}</button>
                    <a href="{{ route('admin.service-technologies.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
