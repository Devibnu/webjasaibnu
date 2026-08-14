@extends('admin.layouts.app')

@section('title', 'Portfolio Page Settings')
@section('page', 'Portfolio Page Settings')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h6>Portfolio Page Settings</h6>
            <p class="text-sm mb-0">Manage intro and CTA copy displayed on the public /portfolio page.</p>
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

            <form action="{{ route('admin.portfolio-page-settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Portfolio Intro</h6>
                <div class="row">
                    <div class="col-md-4">
                        <label>Eyebrow</label>
                        <input name="eyebrow" class="form-control mb-3" value="{{ old('eyebrow', $settings->value('eyebrow')) }}">
                    </div>
                    <div class="col-md-8">
                        <label>Title</label>
                        <input name="title" class="form-control mb-3" value="{{ old('title', $settings->value('title')) }}">
                    </div>
                </div>

                <label>Description</label>
                <textarea name="description" class="form-control mb-4" rows="4">{{ old('description', $settings->value('description')) }}</textarea>

                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 mt-4">CTA Section</h6>
                <div class="row">
                    <div class="col-md-4">
                        <label>CTA Eyebrow</label>
                        <input name="cta_eyebrow" class="form-control mb-3" value="{{ old('cta_eyebrow', $settings->value('cta_eyebrow')) }}">
                    </div>
                    <div class="col-md-8">
                        <label>CTA Title</label>
                        <input name="cta_title" class="form-control mb-3" value="{{ old('cta_title', $settings->value('cta_title')) }}">
                    </div>
                </div>

                <label>CTA Description</label>
                <textarea name="cta_description" class="form-control mb-3" rows="3">{{ old('cta_description', $settings->value('cta_description')) }}</textarea>

                <div class="row">
                    <div class="col-md-6">
                        <label>Primary Button Label</label>
                        <input name="cta_primary_label" class="form-control mb-3" value="{{ old('cta_primary_label', $settings->ctaPrimaryLabel()) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Primary Button URL</label>
                        <input name="cta_primary_url" class="form-control mb-3" value="{{ old('cta_primary_url', $settings->value('cta_primary_url')) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Secondary Button Label</label>
                        <input name="cta_secondary_label" class="form-control mb-3" value="{{ old('cta_secondary_label', $settings->ctaSecondaryLabel()) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Secondary Button URL</label>
                        <input name="cta_secondary_url" class="form-control mb-3" value="{{ old('cta_secondary_url', $settings->value('cta_secondary_url')) }}">
                    </div>
                </div>

                <button class="btn bg-gradient-info" type="submit">Save Settings</button>
            </form>
        </div>
    </div>
@endsection
