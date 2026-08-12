<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Insight;
use App\Models\PortfolioItem;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            ['label' => 'Public Pages', 'value' => '7', 'icon' => 'ni ni-world-2', 'tone' => 'primary'],
            ['label' => 'Total Insights', 'value' => Insight::count(), 'icon' => 'ni ni-single-copy-04', 'tone' => 'info'],
            ['label' => 'Published', 'value' => Insight::where('status', Insight::STATUS_PUBLISHED)->count(), 'icon' => 'ni ni-check-bold', 'tone' => 'success'],
            ['label' => 'Draft', 'value' => Insight::where('status', Insight::STATUS_DRAFT)->count(), 'icon' => 'ni ni-folder-17', 'tone' => 'secondary'],
            ['label' => 'Portfolio Items', 'value' => PortfolioItem::count(), 'icon' => 'ni ni-briefcase-24', 'tone' => 'success'],
            ['label' => 'Contact Inbox', 'value' => ContactMessage::count(), 'icon' => 'ni ni-email-83', 'tone' => 'warning'],
        ];

        $contentAreas = [
            ['name' => 'Insights', 'source' => 'Database', 'status' => 'CMS enabled'],
            ['name' => 'Portfolio', 'source' => 'Database', 'status' => 'CMS enabled'],
            ['name' => 'Contact', 'source' => 'Database', 'status' => ContactMessage::unread()->count().' unread'],
            ['name' => 'Site Settings', 'source' => 'Database managed', 'status' => 'READY'],
        ];

        return view('admin.dashboard.index', compact('stats', 'contentAreas'));
    }
}
