@extends('admin.layouts.app')

@section('title', 'Edit Service')
@section('page', 'Services CMS')

@section('content')
    @include('admin.services.form', [
        'action' => route('admin.services.update', $service),
        'method' => 'PUT',
        'button' => 'Update Service',
    ])
@endsection
