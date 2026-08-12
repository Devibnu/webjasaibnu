@extends('admin.layouts.app')

@section('title', 'Add Solution')
@section('page', 'Solutions CMS')

@section('content')
    @include('admin.solutions.form', [
        'action' => route('admin.solutions.store'),
        'method' => 'POST',
        'button' => 'Create Solution',
    ])
@endsection
