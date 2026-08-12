@extends('admin.layouts.app')

@section('title', 'Edit Category')
@section('page', 'Edit Category')

@section('content')
    @include('admin.insight-categories.form', [
        'action' => route('admin.insight-categories.update', $category),
        'method' => 'PUT',
        'button' => 'Update Category',
    ])
@endsection
