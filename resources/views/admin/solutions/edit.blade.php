@extends('admin.layouts.app')

@section('title', 'Edit Solution')
@section('page', 'Solutions CMS')

@section('content')
    @include('admin.solutions.form', [
        'action' => route('admin.solutions.update', $solution),
        'method' => 'PUT',
        'button' => 'Update Solution',
    ])
@endsection
