@extends('admin.layouts.app')

@section('title', 'Add Technology')
@section('page', 'Service Technologies')

@section('content')
    @include('admin.service-technologies.form', [
        'action' => route('admin.service-technologies.store'),
        'method' => 'POST',
        'button' => 'Create Technology',
    ])
@endsection
