@extends('admin.layouts.app')

@section('title', 'Contact Message')
@section('page', 'Contact Message')

@section('content')
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6>{{ $contactMessage->subjectLine() }}</h6>
                        <p class="text-sm mb-0">Submitted from the public contact form.</p>
                    </div>
                    <span class="badge badge-sm bg-gradient-{{ $contactMessage->isUnread() ? 'warning' : 'success' }}">{{ strtoupper($contactMessage->status) }}</span>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success text-white">{{ session('status') }}</div>
                    @endif

                    <dl class="row mb-4">
                        <dt class="col-sm-3 text-sm text-secondary">Sender</dt>
                        <dd class="col-sm-9 text-sm font-weight-bold">{{ $contactMessage->name }}</dd>

                        <dt class="col-sm-3 text-sm text-secondary">Email</dt>
                        <dd class="col-sm-9 text-sm">
                            <a href="mailto:{{ $contactMessage->email }}?subject={{ rawurlencode('Re: '.$contactMessage->subjectLine()) }}">{{ $contactMessage->email }}</a>
                        </dd>

                        @if ($contactMessage->phone)
                            <dt class="col-sm-3 text-sm text-secondary">Phone</dt>
                            <dd class="col-sm-9 text-sm">{{ $contactMessage->phone }}</dd>
                        @endif

                        @if ($contactMessage->company)
                            <dt class="col-sm-3 text-sm text-secondary">Company</dt>
                            <dd class="col-sm-9 text-sm">{{ $contactMessage->company }}</dd>
                        @endif

                        <dt class="col-sm-3 text-sm text-secondary">Service</dt>
                        <dd class="col-sm-9 text-sm">{{ $contactMessage->service }}</dd>

                        <dt class="col-sm-3 text-sm text-secondary">Received</dt>
                        <dd class="col-sm-9 text-sm">{{ $contactMessage->created_at?->format('Y-m-d H:i') }}</dd>

                        <dt class="col-sm-3 text-sm text-secondary">Read At</dt>
                        <dd class="col-sm-9 text-sm">{{ $contactMessage->read_at?->format('Y-m-d H:i') ?: '-' }}</dd>
                    </dl>

                    <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Message</h6>
                    <p class="text-sm mb-0" style="white-space: pre-line;">{{ $contactMessage->message }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Actions</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.contact.read', $contactMessage) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn bg-gradient-success w-100" type="submit">Mark as Read</button>
                    </form>

                    <form action="{{ route('admin.contact.unread', $contactMessage) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-outline-warning w-100" type="submit">Mark as Unread</button>
                    </form>

                    <form action="{{ route('admin.contact.destroy', $contactMessage) }}" method="POST" onsubmit="return confirm('Delete this contact message?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger w-100" type="submit">Delete</button>
                    </form>

                    <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-secondary w-100 mb-0">Back to Inbox</a>
                </div>
            </div>
        </div>
    </div>
@endsection
