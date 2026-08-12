@extends('admin.layouts.app')

@section('title', 'Add Category')
@section('page', 'Add Category')

@section('content')
    @include('admin.insight-categories.form', [
        'action' => route('admin.insight-categories.store'),
        'method' => 'POST',
        'button' => 'Create Category',
    ])
@endsection
