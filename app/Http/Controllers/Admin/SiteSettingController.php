<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSiteSettingRequest;
use App\Models\SiteSetting;

class SiteSettingController extends Controller
{
    public function edit()
    {
        return view('admin.site-settings.edit', [
            'settings' => SiteSetting::current(),
        ]);
    }

    public function update(UpdateSiteSettingRequest $request)
    {
        $settings = SiteSetting::current();
        $settings->update($request->validated());

        return redirect()->route('admin.site-settings.edit')
            ->with('status', 'Site settings updated.');
    }
}
