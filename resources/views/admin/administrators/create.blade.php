@extends('admin.layouts.app')

@section('title', 'Add Administrator')
@section('page', 'Administrators CMS')

@section('content')
    @include('admin.administrators.form', [
        'action' => route('admin.administrators.store'),
        'method' => 'POST',
        'button' => 'Create Administrator',
        'isCreate' => true,
    ])
@endsection
