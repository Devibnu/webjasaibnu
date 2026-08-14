<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioPageSetting;
use Illuminate\Http\Request;

class PortfolioPageSettingController extends Controller
{
    public function edit()
    {
        return view('admin.portfolio-page-settings.edit', [
            'settings' => PortfolioPageSetting::current(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:120'],
            'title' => ['nullable', 'string', 'max:220'],
            'description' => ['nullable', 'string'],
            'cta_eyebrow' => ['nullable', 'string', 'max:120'],
            'cta_title' => ['nullable', 'string', 'max:220'],
            'cta_description' => ['nullable', 'string'],
            'cta_primary_label' => ['nullable', 'string', 'max:120'],
            'cta_primary_url' => ['nullable', 'string', 'max:255'],
            'cta_secondary_label' => ['nullable', 'string', 'max:120'],
            'cta_secondary_url' => ['nullable', 'string', 'max:255'],
        ]);

        PortfolioPageSetting::current()->update($data);

        return redirect()->route('admin.portfolio-page-settings.edit')
            ->with('status', 'Portfolio page settings updated.');
    }
}
