@extends('admin.layouts.app')

@section('title', 'Manage About Page')
@section('page', 'About CMS')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h6>About Page CMS</h6>
            <p class="text-sm mb-0">Manage content, values, and work process displayed on the public /about page.</p>
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

            <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hero Section</h6>
                <div class="row">
                    <div class="col-md-4">
                        <label>Hero Label</label>
                        <input name="hero_label" class="form-control mb-3" value="{{ old('hero_label', $about->hero_label) }}" required>
                    </div>
                    <div class="col-md-8">
                        <label>Hero Title</label>
                        <input name="hero_title" class="form-control mb-3" value="{{ old('hero_title', $about->hero_title) }}" required>
                    </div>
                </div>

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 mt-3">Company Introduction</h6>
                <label>First Paragraph</label>
                <textarea name="content_p1" class="form-control mb-3" rows="3" required>{{ old('content_p1', $about->content_p1) }}</textarea>

                <label>Second Paragraph</label>
                <textarea name="content_p2" class="form-control mb-3" rows="3">{{ old('content_p2', $about->content_p2) }}</textarea>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label>About Visual Image (optional)</label>
                        <input type="file" name="visual_image" class="form-control mb-3" accept="image/jpeg,image/png,image/jpg,image/webp">
                        <small class="text-muted d-block mb-3">Upload a new image to replace the default Startup2 about.jpg.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="d-block">Current Visual Image</label>
                        <div class="border rounded p-2 bg-light text-center" style="max-width: 240px;">
                            <img src="{{ $about->visualImageUrl() }}" alt="About Visual" class="img-fluid rounded" style="max-height: 120px; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <hr class="horizontal dark my-4">
                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Homepage About Section</h6>
                <p class="text-sm text-muted">Manage the About JASAIBNU block displayed on the homepage.</p>
                <div class="row">
                    <div class="col-md-4">
                        <label>Homepage About Label</label>
                        <input name="homepage_about_label" class="form-control mb-3" value="{{ old('homepage_about_label', $about->homepageAboutValue('homepage_about_label')) }}" required>
                    </div>
                    <div class="col-md-8">
                        <label>Homepage About Title</label>
                        <input name="homepage_about_title" class="form-control mb-3" value="{{ old('homepage_about_title', $about->homepageAboutValue('homepage_about_title')) }}" required>
                    </div>
                </div>

                <label>Homepage About Description</label>
                <textarea name="homepage_about_description" class="form-control mb-3" rows="3" required>{{ old('homepage_about_description', $about->homepageAboutValue('homepage_about_description')) }}</textarea>

                <div class="row">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-md-6">
                            <label>Checklist {{ $i }}</label>
                            <input name="homepage_checklist_{{ $i }}" class="form-control mb-3" value="{{ old('homepage_checklist_' . $i, $about->homepageAboutValue('homepage_checklist_' . $i)) }}" required>
                        </div>
                    @endfor
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label>CTA Small Text</label>
                        <input name="homepage_cta_small_text" class="form-control mb-3" value="{{ old('homepage_cta_small_text', $about->homepageAboutValue('homepage_cta_small_text')) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label>CTA Main Text</label>
                        <input name="homepage_cta_main_text" class="form-control mb-3" value="{{ old('homepage_cta_main_text', $about->homepageAboutValue('homepage_cta_main_text')) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label>WhatsApp URL / Destination</label>
                        <input name="homepage_cta_url" class="form-control mb-3" value="{{ old('homepage_cta_url', $about->homepageAboutValue('homepage_cta_url')) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Button Label</label>
                        <input name="homepage_button_label" class="form-control mb-3" value="{{ old('homepage_button_label', $about->homepageAboutValue('homepage_button_label')) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Button URL / Route</label>
                        <input name="homepage_button_url" class="form-control mb-3" value="{{ old('homepage_button_url', $about->homepageAboutValue('homepage_button_url')) }}" required>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label>Homepage About Image (optional)</label>
                        <input type="file" name="homepage_about_image" class="form-control mb-3" accept="image/jpeg,image/png,image/jpg,image/webp">
                        <small class="text-muted d-block mb-3">Upload a new image only for the homepage About section.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="d-block">Current Homepage About Image</label>
                        <div class="border rounded p-2 bg-light text-center" style="max-width: 240px;">
                            <img src="{{ $about->homepageAboutImageUrl() }}" alt="Homepage About Visual" class="img-fluid rounded" style="max-height: 120px; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 mt-4">Core Values (4 Items)</h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="border rounded p-3 mb-3 bg-gray-100">
                            <label class="font-weight-bold">Value 1 Title</label>
                            <input name="value_1_title" class="form-control mb-2" value="{{ old('value_1_title', $about->value_1_title) }}" required>
                            <label class="font-weight-bold">Value 1 Body</label>
                            <textarea name="value_1_body" class="form-control" rows="2" required>{{ old('value_1_body', $about->value_1_body) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 mb-3 bg-gray-100">
                            <label class="font-weight-bold">Value 2 Title</label>
                            <input name="value_2_title" class="form-control mb-2" value="{{ old('value_2_title', $about->value_2_title) }}" required>
                            <label class="font-weight-bold">Value 2 Body</label>
                            <textarea name="value_2_body" class="form-control" rows="2" required>{{ old('value_2_body', $about->value_2_body) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 mb-3 bg-gray-100">
                            <label class="font-weight-bold">Value 3 Title</label>
                            <input name="value_3_title" class="form-control mb-2" value="{{ old('value_3_title', $about->value_3_title) }}" required>
                            <label class="font-weight-bold">Value 3 Body</label>
                            <textarea name="value_3_body" class="form-control" rows="2" required>{{ old('value_3_body', $about->value_3_body) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 mb-3 bg-gray-100">
                            <label class="font-weight-bold">Value 4 Title</label>
                            <input name="value_4_title" class="form-control mb-2" value="{{ old('value_4_title', $about->value_4_title) }}" required>
                            <label class="font-weight-bold">Value 4 Body</label>
                            <textarea name="value_4_body" class="form-control" rows="2" required>{{ old('value_4_body', $about->value_4_body) }}</textarea>
                        </div>
                    </div>
                </div>

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 mt-3">CTA Button Labels</h6>
                <div class="row">
                    <div class="col-md-6">
                        <label>Consultation Button Text</label>
                        <input name="cta_consultation_text" class="form-control mb-3" value="{{ old('cta_consultation_text', $about->cta_consultation_text) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Services Button Text</label>
                        <input name="cta_services_text" class="form-control mb-3" value="{{ old('cta_services_text', $about->cta_services_text) }}" required>
                    </div>
                </div>

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 mt-4">Work Process Section</h6>
                <div class="row">
                    <div class="col-md-4">
                        <label>Process Label</label>
                        <input name="process_label" class="form-control mb-3" value="{{ old('process_label', $about->process_label) }}" required>
                    </div>
                    <div class="col-md-8">
                        <label>Process Title</label>
                        <input name="process_title" class="form-control mb-3" value="{{ old('process_title', $about->process_title) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="border rounded p-3 mb-3 bg-gray-100">
                            <label class="font-weight-bold">Step 1 Title</label>
                            <input name="step_1_title" class="form-control mb-2" value="{{ old('step_1_title', $about->step_1_title) }}" required>
                            <label class="font-weight-bold">Step 1 Body</label>
                            <textarea name="step_1_body" class="form-control" rows="3" required>{{ old('step_1_body', $about->step_1_body) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 mb-3 bg-gray-100">
                            <label class="font-weight-bold">Step 2 Title</label>
                            <input name="step_2_title" class="form-control mb-2" value="{{ old('step_2_title', $about->step_2_title) }}" required>
                            <label class="font-weight-bold">Step 2 Body</label>
                            <textarea name="step_2_body" class="form-control" rows="3" required>{{ old('step_2_body', $about->step_2_body) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 mb-3 bg-gray-100">
                            <label class="font-weight-bold">Step 3 Title</label>
                            <input name="step_3_title" class="form-control mb-2" value="{{ old('step_3_title', $about->step_3_title) }}" required>
                            <label class="font-weight-bold">Step 3 Body</label>
                            <textarea name="step_3_body" class="form-control" rows="3" required>{{ old('step_3_body', $about->step_3_body) }}</textarea>
                        </div>
                    </div>
                </div>

                <button class="btn bg-gradient-info mt-3" type="submit">Save About Page</button>
            </form>
        </div>
    </div>
@endsection
