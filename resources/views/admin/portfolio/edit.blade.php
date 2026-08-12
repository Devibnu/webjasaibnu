@extends('admin.layouts.app')

@section('title', 'Edit Portfolio')
@section('page', 'Edit Portfolio')

@section('content')
    @include('admin.portfolio.form', [
        'action' => route('admin.portfolio.update', $item),
        'method' => 'PUT',
        'button' => 'Update Portfolio',
    ])
@endsection
