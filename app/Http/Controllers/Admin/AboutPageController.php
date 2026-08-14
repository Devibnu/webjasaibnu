<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAboutPageRequest;
use App\Models\AboutPage;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    public function edit()
    {
        return view('admin.about.edit', [
            'about' => AboutPage::current(),
        ]);
    }

    public function update(UpdateAboutPageRequest $request)
    {
        $about = AboutPage::current();
        $data = $request->validated();

        if ($request->hasFile('visual_image')) {
            if ($about->visual_image && Storage::disk('public')->exists($about->visual_image)) {
                Storage::disk('public')->delete($about->visual_image);
            }

            $data['visual_image'] = $request->file('visual_image')->store('about', 'public');
        } else {
            unset($data['visual_image']);
        }

        if ($request->hasFile('homepage_about_image')) {
            if ($about->homepage_about_image && Storage::disk('public')->exists($about->homepage_about_image)) {
                Storage::disk('public')->delete($about->homepage_about_image);
            }

            $data['homepage_about_image'] = $request->file('homepage_about_image')->store('about', 'public');
        } else {
            unset($data['homepage_about_image']);
        }

        $about->update($data);

        return redirect()->route('admin.about.edit')
            ->with('status', 'About page content updated successfully.');
    }
}
