@extends('admin.layouts.app')

@section('title', 'Add Insight')
@section('page', 'Add Insight')

@section('content')
    @include('admin.insights.form', [
        'action' => route('admin.insights.store'),
        'method' => 'POST',
        'button' => 'Create Insight',
    ])
@endsection
