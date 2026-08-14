@extends('admin.layouts.app')

@section('title', 'Edit Administrator')
@section('page', 'Administrators CMS')

@section('content')
    @include('admin.administrators.form', [
        'action' => route('admin.administrators.update', $user),
        'method' => 'PUT',
        'button' => 'Update Administrator',
        'isCreate' => false,
    ])
@endsection
