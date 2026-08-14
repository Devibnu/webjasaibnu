@extends('admin.layouts.app')

@section('title', 'Site Settings')
@section('page', 'Site Settings')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h6>Site Settings</h6>
            <p class="text-sm mb-0">Manage global company information used by the public website.</p>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success text-white">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger text-white">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Company Information</h6>
                <div class="row">
                    <div class="col-md-6">
                        <label>Company Name</label>
                        <input name="company_name" class="form-control mb-3" value="{{ old('company_name', $settings->company_name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Legal Company Name</label>
                        <input name="company_legal_name" class="form-control mb-3" value="{{ old('company_legal_name', $settings->company_legal_name) }}">
                    </div>
                </div>

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 mt-4">Contact / WhatsApp</h6>
                <div class="row">
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control mb-3" value="{{ old('email', $settings->email) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Phone Display</label>
                        <input name="phone" class="form-control mb-3" value="{{ old('phone', $settings->phone) }}">
                    </div>
                    <div class="col-md-6">
                        <label>WhatsApp Number</label>
                        <input name="whatsapp_number" class="form-control mb-1" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}" placeholder="6281234567890">
                        <small class="text-muted d-block mb-3">Gunakan format 628xxxxxxxxxx tanpa spasi.</small>
                    </div>
                    <div class="col-md-6">
                        <label>WhatsApp URL (optional)</label>
                        <input type="url" name="whatsapp_url" class="form-control mb-1" value="{{ old('whatsapp_url', $settings->whatsapp_url) }}" placeholder="https://wa.link/s5wh92">
                        <small class="text-muted d-block mb-3">Optional. Gunakan wa.me, wa.link, api.whatsapp.com, atau whatsapp.com. Jika kosong, URL akan dibuat dari WhatsApp Number.</small>
                    </div>
                    <div class="col-md-6">
                        <label>Address</label>
                        <input name="address" class="form-control mb-3" value="{{ old('address', $settings->address) }}">
                    </div>
                    <div class="col-md-3">
                        <label>City</label>
                        <input name="city" class="form-control mb-3" value="{{ old('city', $settings->city) }}">
                    </div>
                    <div class="col-md-3">
                        <label>Country</label>
                        <input name="country" class="form-control mb-3" value="{{ old('country', $settings->country) }}">
                    </div>
                </div>

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 mt-4">Location / Maps</h6>
                <label>Google Maps Embed URL</label>
                <input type="url" name="google_maps_embed_url" class="form-control mb-3" value="{{ old('google_maps_embed_url', $settings->google_maps_embed_url) }}">

                <label>Google Maps External URL</label>
                <input type="url" name="google_maps_external_url" class="form-control mb-3" value="{{ old('google_maps_external_url', $settings->google_maps_external_url) }}">

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 mt-4">Social Media</h6>
                <div class="row">
                    <div class="col-md-6">
                        <label>X / Twitter</label>
                        <input name="x_url" class="form-control mb-3" value="{{ old('x_url', $settings->x_url) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Facebook</label>
                        <input name="facebook_url" class="form-control mb-3" value="{{ old('facebook_url', $settings->facebook_url) }}">
                    </div>
                    <div class="col-md-6">
                        <label>LinkedIn</label>
                        <input name="linkedin_url" class="form-control mb-3" value="{{ old('linkedin_url', $settings->linkedin_url) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Instagram</label>
                        <input name="instagram_url" class="form-control mb-3" value="{{ old('instagram_url', $settings->instagram_url) }}">
                    </div>
                </div>

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 mt-4">Footer</h6>
                <label>Footer Description</label>
                <textarea name="footer_description" class="form-control mb-3" rows="3">{{ old('footer_description', $settings->footer_description) }}</textarea>

                <label>Copyright Text</label>
                <input name="copyright_text" class="form-control mb-4" value="{{ old('copyright_text', $settings->copyright_text) }}">

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 mt-4">Branding</h6>
                <div class="row">
                    <div class="col-md-4">
                        <label>Public Logo</label>
                        @if ($settings->logo_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $settings->logo_path) }}" alt="Public Logo" style="max-height: 50px;" class="bg-dark p-1 rounded">
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="remove_logo" value="1" id="remove_logo">
                                <label class="form-check-label text-danger" for="remove_logo">Remove Logo</label>
                            </div>
                        @endif
                        <input type="file" name="logo_path" class="form-control mb-3" accept=".jpg,.jpeg,.png,.webp">
                        <small class="text-muted d-block mb-3">Formats: jpg, jpeg, png, webp (max 2MB)</small>
                    </div>

                    <div class="col-md-4">
                        <label>Dark Logo (optional)</label>
                        @if ($settings->logo_dark_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $settings->logo_dark_path) }}" alt="Dark Logo" style="max-height: 50px;" class="bg-dark p-1 rounded">
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="remove_logo_dark" value="1" id="remove_logo_dark">
                                <label class="form-check-label text-danger" for="remove_logo_dark">Remove Dark Logo</label>
                            </div>
                        @endif
                        <input type="file" name="logo_dark_path" class="form-control mb-3" accept=".jpg,.jpeg,.png,.webp">
                        <small class="text-muted d-block mb-3">Formats: jpg, jpeg, png, webp (max 2MB)</small>
                    </div>

                    <div class="col-md-4">
                        <label>Favicon</label>
                        @if ($settings->favicon_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $settings->favicon_path) }}" alt="Favicon" style="max-height: 32px;" class="bg-dark p-1 rounded">
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="remove_favicon" value="1" id="remove_favicon">
                                <label class="form-check-label text-danger" for="remove_favicon">Remove Favicon</label>
                            </div>
                        @endif
                        <input type="file" name="favicon_path" class="form-control mb-3" accept=".png,.ico,.webp">
                        <small class="text-muted d-block mb-3">Formats: png, ico, webp (max 1MB)</small>
                    </div>
                </div>

                <button class="btn bg-gradient-info" type="submit">Save Settings</button>
            </form>
        </div>
    </div>
@endsection
