<?php

namespace App\Console\Commands;

use App\Models\SiteSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OptimizeSiteLogos extends Command
{
    protected $signature = 'site:optimize-logos';

    protected $description = 'Resize configured site logos into lightweight WebP assets.';

    public function handle(): int
    {
        if (! extension_loaded('gd')) {
            $this->error('The GD extension is required to optimize logos.');

            return self::FAILURE;
        }

        $settings = SiteSetting::current();
        $changed = false;

        foreach (['logo_path', 'logo_dark_path'] as $field) {
            $optimizedPath = $this->optimizeLogoPath($settings->{$field});

            if ($optimizedPath && $optimizedPath !== $settings->{$field}) {
                $settings->{$field} = $optimizedPath;
                $changed = true;
                $this->line($field . ' optimized to ' . $optimizedPath);
            }
        }

        if ($changed) {
            $settings->save();
            $this->info('Site logos optimized.');

            return self::SUCCESS;
        }

        $this->info('No site logos needed optimization.');

        return self::SUCCESS;
    }

    private function optimizeLogoPath(?string $path): ?string
    {
        if (! $path || Str::endsWith(Str::lower($path), '.webp')) {
            return $path;
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($path)) {
            return $path;
        }

        $fullPath = $disk->path($path);
        $info = @getimagesize($fullPath);

        if (! $info || empty($info[0]) || empty($info[1])) {
            return $path;
        }

        [$width, $height] = $info;
        $targetWidth = min($width, 428);
        $targetHeight = max(1, (int) round($height * ($targetWidth / $width)));
        $image = match ($info[2]) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($fullPath),
            IMAGETYPE_PNG => @imagecreatefrompng($fullPath),
            IMAGETYPE_WEBP => @imagecreatefromwebp($fullPath),
            default => null,
        };

        if (! $image) {
            return $path;
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
            return $path;
        }

        $optimizedPath = 'site/' . Str::uuid() . '.webp';
        $disk->put($optimizedPath, $contents);

        return $optimizedPath;
    }
}
