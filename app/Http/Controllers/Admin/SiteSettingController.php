<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            $data['logo_path'] = $this->storeOptimizedLogo($request->file('logo_path'));
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
            $data['logo_dark_path'] = $this->storeOptimizedLogo($request->file('logo_dark_path'));
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

    private function storeOptimizedLogo(UploadedFile $file): string
    {
        if (! extension_loaded('gd')) {
            return $file->store('site', 'public');
        }

        $info = @getimagesize($file->getRealPath());

        if (! $info || empty($info[0]) || empty($info[1])) {
            return $file->store('site', 'public');
        }

        [$width, $height] = $info;
        $maxWidth = 428;
        $targetWidth = min($width, $maxWidth);
        $targetHeight = max(1, (int) round($height * ($targetWidth / $width)));
        $image = match ($info[2]) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($file->getRealPath()),
            IMAGETYPE_PNG => @imagecreatefrompng($file->getRealPath()),
            IMAGETYPE_WEBP => @imagecreatefromwebp($file->getRealPath()),
            default => null,
        };

        if (! $image) {
            return $file->store('site', 'public');
        }

        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);
        imagefill($canvas, 0, 0, imagecolorallocatealpha($canvas, 0, 0, 0, 127));
        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

        ob_start();
        $encoded = imagewebp($canvas, null, 84);
        $contents = ob_get_clean();

        imagedestroy($image);
        imagedestroy($canvas);

        if (! $encoded || ! $contents) {
            return $file->store('site', 'public');
        }

        $path = 'site/' . Str::uuid() . '.webp';
        Storage::disk('public')->put($path, $contents);

        return $path;
    }
}
