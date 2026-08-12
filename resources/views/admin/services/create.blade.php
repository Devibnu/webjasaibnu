@extends('admin.layouts.app')

@section('title', 'Add Service')
@section('page', 'Services CMS')

@section('content')
    @include('admin.services.form', [
        'action' => route('admin.services.store'),
        'method' => 'POST',
        'button' => 'Create Service',
    ])
@endsection
