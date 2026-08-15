@extends('admin.layouts.app')

@section('title', 'Edit Technology')
@section('page', 'Service Technologies')

@section('content')
    @include('admin.service-technologies.form', [
        'action' => route('admin.service-technologies.update', $technology),
        'method' => 'PUT',
        'button' => 'Update Technology',
    ])
@endsection
