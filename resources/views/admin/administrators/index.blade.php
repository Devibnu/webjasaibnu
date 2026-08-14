@extends('admin.layouts.app')

@section('title', 'Administrators')
@section('page', 'Administrators')

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <div>
                <h6>Administrators</h6>
                <p class="text-sm mb-0">Kelola akun yang memiliki akses ke Admin JASAIBNU.</p>
            </div>
            <a href="{{ route('admin.administrators.create') }}" class="btn bg-gradient-info mb-0">Add Administrator</a>
        </div>
        <div class="card-body px-4 pt-3 pb-2">
            @if (session('status'))
                <div class="alert alert-success text-white">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger text-white">{{ $errors->first() }}</div>
            @endif

            <form method="GET" action="{{ route('admin.administrators.index') }}" class="row g-2 mb-4">
                <div class="col-md-6">
                    <input type="search" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search name or email">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-info w-100 mb-0" type="submit">Search</button>
                </div>
            </form>

            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Administrator</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $adminUser)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <span class="avatar avatar-sm bg-gradient-info me-3 text-white font-weight-bold">{{ strtoupper(substr($adminUser->name, 0, 2)) }}</span>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $adminUser->name }} @if(auth()->id() === $adminUser->id) <span class="text-xs text-info">(You)</span> @endif</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $adminUser->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-sm bg-gradient-{{ $adminUser->is_admin ? 'success' : 'secondary' }}">{{ $adminUser->is_admin ? 'Admin' : 'Standard' }}</span></td>
                                <td><p class="text-sm mb-0">{{ $adminUser->updated_at?->format('Y-m-d H:i') }}</p></td>
                                <td class="align-middle text-end">
                                    <a href="{{ route('admin.administrators.edit', $adminUser) }}" class="btn btn-link text-info mb-0 px-2">Edit</a>
                                    @if(auth()->id() !== $adminUser->id)
                                        <form action="{{ route('admin.administrators.destroy', $adminUser) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this administrator account?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-link text-danger mb-0 px-2" type="submit">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-secondary py-4">No administrators found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
