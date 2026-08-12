<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:80'],
            'company' => ['nullable', 'string', 'max:160'],
            'service' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::create($validated);

        return back()
            ->withInput($request->except(['message']))
            ->with('contact_status', 'Pesan berhasil dikirim. Tim JASAIBNU akan meninjau kebutuhan Anda.');
    }
}
