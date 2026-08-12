@extends('admin.layouts.app')

@section('title', 'Edit Insight')
@section('page', 'Edit Insight')

@section('content')
    @include('admin.insights.form', [
        'action' => route('admin.insights.update', $insight),
        'method' => 'PUT',
        'button' => 'Update Insight',
    ])
@endsection
