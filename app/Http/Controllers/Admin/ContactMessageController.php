<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query()->newest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('service', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        return view('admin.contact.index', [
            'messages' => $query->paginate(12)->withQueryString(),
            'filters' => $request->only(['search', 'status']),
            'totalMessages' => ContactMessage::count(),
            'unreadMessages' => ContactMessage::unread()->count(),
            'readMessages' => ContactMessage::read()->count(),
        ]);
    }

    public function show(ContactMessage $contactMessage)
    {
        if ($contactMessage->isUnread()) {
            $contactMessage->markAsRead();
            $contactMessage->refresh();
        }

        return view('admin.contact.show', compact('contactMessage'));
    }

    public function markRead(ContactMessage $contactMessage)
    {
        $contactMessage->markAsRead();

        return back()->with('status', 'Message marked as read.');
    }

    public function markUnread(ContactMessage $contactMessage)
    {
        $contactMessage->markAsUnread();

        return back()->with('status', 'Message marked as unread.');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact.index')
            ->with('status', 'Message deleted.');
    }
}
