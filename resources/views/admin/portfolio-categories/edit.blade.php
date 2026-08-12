@extends('admin.layouts.app')

@section('title', 'Edit Portfolio Category')
@section('page', 'Edit Portfolio Category')

@section('content')
    @include('admin.portfolio-categories.form', [
        'action' => route('admin.portfolio-categories.update', $category),
        'method' => 'PUT',
        'button' => 'Update Category',
    ])
@endsection
