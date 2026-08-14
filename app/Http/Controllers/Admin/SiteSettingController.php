<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validated();

        // Handle Logo
        if ($request->boolean('remove_logo')) {
            if ($settings->logo_path) {
                Storage::disk('public')->delete($settings->logo_path);
            }
            $data['logo_path'] = null;
        } elseif ($request->hasFile('logo_path')) {
            if ($settings->logo_path) {
                Storage::disk('public')->delete($settings->logo_path);
            }
            $data['logo_path'] = $request->file('logo_path')->store('site', 'public');
        } else {
            unset($data['logo_path']);
        }

        // Handle Dark Logo
        if ($request->boolean('remove_logo_dark')) {
            if ($settings->logo_dark_path) {
                Storage::disk('public')->delete($settings->logo_dark_path);
            }
            $data['logo_dark_path'] = null;
        } elseif ($request->hasFile('logo_dark_path')) {
            if ($settings->logo_dark_path) {
                Storage::disk('public')->delete($settings->logo_dark_path);
            }
            $data['logo_dark_path'] = $request->file('logo_dark_path')->store('site', 'public');
        } else {
            unset($data['logo_dark_path']);
        }

        // Handle Favicon
        if ($request->boolean('remove_favicon')) {
            if ($settings->favicon_path) {
                Storage::disk('public')->delete($settings->favicon_path);
            }
            $data['favicon_path'] = null;
        } elseif ($request->hasFile('favicon_path')) {
            if ($settings->favicon_path) {
                Storage::disk('public')->delete($settings->favicon_path);
            }
            $data['favicon_path'] = $request->file('favicon_path')->store('site', 'public');
        } else {
            unset($data['favicon_path']);
        }

        unset($data['remove_logo'], $data['remove_logo_dark'], $data['remove_favicon']);

        $settings->update($data);

        return redirect()->route('admin.site-settings.edit')
            ->with('status', 'Site settings updated.');
    }
}
