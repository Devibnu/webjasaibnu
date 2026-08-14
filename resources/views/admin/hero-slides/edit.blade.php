@extends('admin.layouts.app')

@section('title', 'Edit Hero Slide')
@section('page', 'Hero Slider CMS')

@section('content')
    @include('admin.hero-slides.form', [
        'action' => route('admin.hero-slides.update', $slide),
        'method' => 'PUT',
        'button' => 'Update Hero Slide',
    ])
@endsection