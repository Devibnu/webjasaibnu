@extends('admin.layouts.app')

@section('title', 'Create Portfolio Category')
@section('page', 'Create Portfolio Category')

@section('content')
    @include('admin.portfolio-categories.form', [
        'action' => route('admin.portfolio-categories.store'),
        'method' => 'POST',
        'button' => 'Create Category',
    ])
@endsection
