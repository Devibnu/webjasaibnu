<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Insight;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\Solution;
use App\Models\User;
use App\Models\VisitorEvent;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $hasVisitorEvents = Schema::hasTable('visitor_events');
        $todayPageViews = $hasVisitorEvents ? VisitorEvent::today()->count() : 0;
        $todayUniqueVisitors = $hasVisitorEvents ? VisitorEvent::today()->distinct('ip_hash')->count('ip_hash') : 0;
        $totalPageViews = $hasVisitorEvents ? VisitorEvent::count() : 0;

        $stats = [
            [
                'label' => 'Page Views Today',
                'value' => $todayPageViews,
                'icon' => 'ni ni-world',
                'tone' => 'info',
                'sub' => 'Website visits today'
            ],
            [
                'label' => 'Visitors Today',
                'value' => $todayUniqueVisitors,
                'icon' => 'ni ni-single-02',
                'tone' => 'success',
                'sub' => 'Unique visitors today'
            ],
            [
                'label' => 'Total Page Views',
                'value' => $totalPageViews,
                'icon' => 'ni ni-chart-bar-32',
                'tone' => 'primary',
                'sub' => 'All public page views'
            ],
            [
                'label' => 'Total Insights',
                'value' => Insight::count(),
                'icon' => 'ni ni-single-copy-04',
                'tone' => 'info',
                'sub' => Insight::where('status', Insight::STATUS_PUBLISHED)->count() . ' Published'
            ],
            [
                'label' => 'Portfolio Items',
                'value' => PortfolioItem::count(),
                'icon' => 'ni ni-briefcase-24',
                'tone' => 'success',
                'sub' => PortfolioItem::where('status', PortfolioItem::STATUS_PUBLISHED)->count() . ' Published'
            ],
            [
                'label' => 'Services',
                'value' => Service::count(),
                'icon' => 'ni ni-app',
                'tone' => 'primary',
                'sub' => Service::where('is_active', true)->count() . ' Active'
            ],
            [
                'label' => 'Solutions',
                'value' => Solution::count(),
                'icon' => 'ni ni-bulb-61',
                'tone' => 'warning',
                'sub' => Solution::where('is_active', true)->count() . ' Active'
            ],
            [
                'label' => 'Contact Inbox',
                'value' => ContactMessage::count(),
                'icon' => 'ni ni-email-83',
                'tone' => 'danger',
                'sub' => ContactMessage::unread()->count() . ' Unread'
            ],
            [
                'label' => 'Administrators',
                'value' => User::where('is_admin', true)->count(),
                'icon' => 'ni ni-circle-08',
                'tone' => 'dark',
                'sub' => 'Admin Access'
            ],
        ];

        $recentContacts = ContactMessage::latest()->take(5)->get();
        $recentInsights = Insight::with('category')->latest('updated_at')->take(5)->get();
        $recentPortfolio = PortfolioItem::with('category')->latest('updated_at')->take(5)->get();
        $unreadMessagesCount = ContactMessage::unread()->count();

        return view('admin.dashboard.index', compact(
            'stats',
            'recentContacts',
            'recentInsights',
            'recentPortfolio',
            'unreadMessagesCount'
        ));
    }
}
