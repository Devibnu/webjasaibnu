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

            <form action="{{ route('admin.site-settings.update') }}" method="POST">
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

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 mt-4">Contact Information</h6>
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
                        <input name="whatsapp_number" class="form-control mb-3" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}">
                    </div>
                    <div class="col-md-6">
                        <label>WhatsApp URL</label>
                        <input type="url" name="whatsapp_url" class="form-control mb-3" value="{{ old('whatsapp_url', $settings->whatsapp_url) }}">
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

                <button class="btn bg-gradient-info" type="submit">Save Settings</button>
            </form>
        </div>
    </div>
@endsection
