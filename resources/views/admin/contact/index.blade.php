@extends('admin.layouts.app')

@section('title', 'Contact Inbox')
@section('page', 'Contact Inbox')

@section('content')
    <div class="row mb-4">
        @foreach ([
            ['label' => 'Total Messages', 'value' => $totalMessages, 'tone' => 'info', 'icon' => 'ni ni-email-83'],
            ['label' => 'Unread', 'value' => $unreadMessages, 'tone' => 'warning', 'icon' => 'ni ni-bell-55'],
            ['label' => 'Read', 'value' => $readMessages, 'tone' => 'success', 'icon' => 'ni ni-check-bold'],
        ] as $metric)
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ $metric['label'] }}</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $metric['value'] }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-{{ $metric['tone'] }} shadow text-center border-radius-md">
                                    <i class="{{ $metric['icon'] }} text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Contact Inbox</h6>
            <p class="text-sm mb-0">Manage messages submitted from the public contact form.</p>
        </div>
        <div class="card-body px-4 pt-3 pb-2">
            @if (session('status'))
                <div class="alert alert-success text-white">{{ session('status') }}</div>
            @endif

            <form method="GET" action="{{ route('admin.contact.index') }}" class="row g-2 mb-4">
                <div class="col-md-7">
                    <input type="search" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control" placeholder="Search name, email, subject, or message">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All status</option>
                        <option value="unread" @selected(($filters['status'] ?? '') === 'unread')>Unread</option>
                        <option value="read" @selected(($filters['status'] ?? '') === 'read')>Read</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-info w-100 mb-0" type="submit">Filter</button>
                </div>
            </form>

            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sender</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subject</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Received</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $message)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="icon icon-shape icon-sm bg-gradient-info shadow text-center border-radius-md me-3">
                                            <i class="ni ni-email-83 text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm {{ $message->isUnread() ? 'font-weight-bolder' : '' }}">{{ $message->name }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $message->company ?: 'No company' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td><p class="text-sm mb-0 {{ $message->isUnread() ? 'font-weight-bold' : '' }}">{{ $message->email }}</p></td>
                                <td><p class="text-sm mb-0 {{ $message->isUnread() ? 'font-weight-bold' : '' }}">{{ $message->subjectLine() }}</p></td>
                                <td><span class="badge badge-sm bg-gradient-{{ $message->isUnread() ? 'warning' : 'success' }}">{{ strtoupper($message->status) }}</span></td>
                                <td><p class="text-sm mb-0">{{ $message->created_at?->format('Y-m-d H:i') }}</p></td>
                                <td class="align-middle text-end">
                                    <a href="{{ route('admin.contact.show', $message) }}" class="btn btn-link text-info mb-0 px-2">View</a>
                                    <form action="{{ route('admin.contact.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this contact message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger mb-0 px-2" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">No contact messages found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
@endsection
