@extends('admin.layouts.app')

@section('title', 'Create Portfolio')
@section('page', 'Create Portfolio')

@section('content')
    @include('admin.portfolio.form', [
        'action' => route('admin.portfolio.store'),
        'method' => 'POST',
        'button' => 'Create Portfolio',
    ])
@endsection
