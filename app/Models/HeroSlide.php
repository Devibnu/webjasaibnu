<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HeroSlide extends Model
{
    public const DEFAULT_OVERLAY_OPACITY = 70;

    protected $fillable = [
        'eyebrow',
        'title',
        'description',
        'image_path',
        'image_alt',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
        'overlay_opacity',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'overlay_opacity' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function imageUrl(): string
    {
        if (! $this->image_path) {
            return asset('assets/startup2/img/carousel-1.jpg');
        }

        if (str_starts_with($this->image_path, 'assets/')) {
            return asset($this->image_path);
        }

        return Storage::url($this->image_path);
    }

    public function optimizedMobileImageUrl(): ?string
    {
        return match ($this->image_path) {
            null, 'assets/startup2/img/carousel-1.jpg' => asset('assets/startup2/img/optimized/carousel-1-mobile.webp'),
            'assets/startup2/img/carousel-2.jpg' => asset('assets/startup2/img/optimized/carousel-2-mobile.webp'),
            default => null,
        };
    }

    public function optimizedDesktopImageUrl(): ?string
    {
        return match ($this->image_path) {
            null, 'assets/startup2/img/carousel-1.jpg' => asset('assets/startup2/img/optimized/carousel-1-desktop.webp'),
            'assets/startup2/img/carousel-2.jpg' => asset('assets/startup2/img/optimized/carousel-2-desktop.webp'),
            default => null,
        };
    }

    public function preloadImageUrl(): string
    {
        return $this->optimizedMobileImageUrl() ?: $this->imageUrl();
    }

    public function overlayRgba(string $color = '9, 30, 62'): string
    {
        $opacity = $this->overlay_opacity ?? self::DEFAULT_OVERLAY_OPACITY;

        return sprintf('rgba(%s, %.2f)', $color, max(0, min(100, $opacity)) / 100);
    }

    public static function defaultItems(): array
    {
        return [
            [
                'eyebrow' => 'IT Solutions • Software Development • SaaS • AI Integration',
                'title' => 'Solusi Digital untuk Bisnis yang Siap Bertumbuh',
                'description' => 'PT JASA IBNU DEVELOPMENT membantu bisnis membangun website, aplikasi, SaaS, SEO, dan integrasi AI dengan fondasi teknis yang scalable, aman, dan siap dikembangkan jangka panjang.',
                'image_path' => 'assets/startup2/img/carousel-1.jpg',
                'image_alt' => 'Diskusi strategi digital untuk bisnis',
                'primary_button_text' => 'Konsultasi Gratis',
                'primary_button_url' => '/contact',
                'secondary_button_text' => 'Lihat Layanan',
                'secondary_button_url' => '/services',
                'overlay_opacity' => self::DEFAULT_OVERLAY_OPACITY,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'eyebrow' => 'PT JASA IBNU DEVELOPMENT',
                'title' => 'Website, Aplikasi, SaaS, SEO, dan AI Integration',
                'description' => 'Bangun fondasi teknis yang rapi untuk produk digital, workflow bisnis, automation, dan pertumbuhan jangka panjang.',
                'image_path' => 'assets/startup2/img/carousel-2.jpg',
                'image_alt' => 'Kolaborasi pengembangan sistem digital',
                'primary_button_text' => 'Konsultasi Gratis',
                'primary_button_url' => '/contact',
                'secondary_button_text' => 'Lihat Layanan',
                'secondary_button_url' => '/services',
                'overlay_opacity' => self::DEFAULT_OVERLAY_OPACITY,
                'sort_order' => 2,
                'is_active' => true,
            ],
        ];
    }
}
