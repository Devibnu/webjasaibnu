@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page', 'Dashboard')

@section('content')
    <div class="row">
        @foreach ($stats as $stat)
            <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ $stat['label'] }}</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $stat['value'] }}</h5>
                                    @if (!empty($stat['sub']))
                                        <p class="mb-0 text-xs text-secondary font-weight-bold mt-1">{{ $stat['sub'] }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-{{ $stat['tone'] }} shadow text-center border-radius-md">
                                    <i class="{{ $stat['icon'] }} text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row mt-4">
        <!-- Quick Actions Card -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Quick Actions</h6>
                        </div>
                        <div class="col-6 text-end">
                            <span class="text-xs text-secondary font-weight-bold">CMS Shortcut Hub</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.insights.create') }}" class="btn btn-sm bg-gradient-info mb-0 me-2">
                            <i class="fas fa-plus me-1"></i> Add Insight
                        </a>
                        <a href="{{ route('admin.portfolio.create') }}" class="btn btn-sm bg-gradient-success mb-0 me-2">
                            <i class="fas fa-plus me-1"></i> Add Portfolio
                        </a>
                        <a href="{{ route('admin.services.create') }}" class="btn btn-sm bg-gradient-primary mb-0 me-2">
                            <i class="fas fa-plus me-1"></i> Add Service
                        </a>
                        <a href="{{ route('admin.solutions.create') }}" class="btn btn-sm bg-gradient-warning mb-0 me-2">
                            <i class="fas fa-plus me-1"></i> Add Solution
                        </a>
                        <a href="{{ route('admin.contact.index') }}" class="btn btn-sm bg-gradient-dark mb-0">
                            <i class="fas fa-envelope me-1"></i> Contact Inbox @if($unreadMessagesCount > 0) <span class="badge badge-sm bg-white text-dark ms-1">{{ $unreadMessagesCount }}</span> @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <!-- Recent Contact Messages -->
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Recent Messages</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-primary btn-sm mb-0">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Sender</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subject</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentContacts as $contact)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm font-weight-bold">{{ e($contact->name) }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ e($contact->email) }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-truncate" style="max-width: 150px;">{{ e($contact->subject ?? $contact->service ?? 'General Inquiry') }}</p>
                                            <span class="text-secondary text-xxs">{{ $contact->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td>
                                            @if ($contact->is_read)
                                                <span class="badge badge-sm bg-gradient-secondary">Read</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-warning">Unread</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-end pe-4">
                                            <a href="{{ route('admin.contact.show', $contact) }}" class="btn btn-link text-dark px-3 mb-0">
                                                <i class="fas fa-eye text-dark me-2"></i>View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-secondary py-4">No messages received yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Insights -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Recent Insights</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.insights.index') }}" class="btn btn-outline-info btn-sm mb-0">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentInsights as $insight)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm font-weight-bold text-truncate" style="max-width: 180px;">{{ e($insight->title) }}</h6>
                                                    <p class="text-secondary text-xxs mb-0">{{ $insight->updated_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">{{ e($insight->categoryName()) }}</span>
                                        </td>
                                        <td>
                                            @if ($insight->status === \App\Models\Insight::STATUS_PUBLISHED)
                                                <span class="badge badge-sm bg-gradient-success">Published</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-end pe-4">
                                            <a href="{{ route('admin.insights.edit', $insight) }}" class="btn btn-link text-info px-2 mb-0">
                                                <i class="fas fa-pencil-alt text-info me-1"></i>Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-secondary py-4">No insights created yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <!-- Recent Portfolio -->
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Recent Portfolio Projects</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-outline-success btn-sm mb-0">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Project Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Client</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentPortfolio as $portfolio)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm font-weight-bold">{{ e($portfolio->title) }}</h6>
                                                    <p class="text-secondary text-xxs mb-0">{{ $portfolio->updated_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">{{ e($portfolio->categoryName()) }}</span>
                                        </td>
                                        <td>
                                            <span class="text-xs text-secondary">{{ e($portfolio->client_name ?? '-') }}</span>
                                        </td>
                                        <td>
                                            @if ($portfolio->status === \App\Models\PortfolioItem::STATUS_PUBLISHED)
                                                <span class="badge badge-sm bg-gradient-success">Published</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-end pe-4">
                                            <a href="{{ route('admin.portfolio.edit', $portfolio) }}" class="btn btn-link text-success px-2 mb-0">
                                                <i class="fas fa-pencil-alt text-success me-1"></i>Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-secondary py-4">No portfolio projects found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
