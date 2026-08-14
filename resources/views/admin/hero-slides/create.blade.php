@extends('admin.layouts.app')

@section('title', 'Add Hero Slide')
@section('page', 'Hero Slider CMS')

@section('content')
    @include('admin.hero-slides.form', [
        'action' => route('admin.hero-slides.store'),
        'method' => 'POST',
        'button' => 'Create Hero Slide',
    ])
@endsection