<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioPageSetting extends Model
{
    protected $fillable = [
        'eyebrow',
        'title',
        'description',
        'cta_eyebrow',
        'cta_title',
        'cta_description',
        'cta_primary_label',
        'cta_primary_url',
        'cta_secondary_label',
        'cta_secondary_url',
    ];

    public static function defaults(): array
    {
        return [
            'eyebrow' => 'PORTFOLIO JASAIBNU',
            'title' => 'Solusi Digital yang Kami Bangun untuk Kebutuhan Bisnis',
            'description' => 'Beberapa contoh pengembangan website, aplikasi, sistem bisnis, dan platform digital yang menggambarkan pendekatan JASAIBNU dalam membangun solusi yang scalable dan mudah dikembangkan.',
            'cta_eyebrow' => 'PUNYA PROYEK?',
            'cta_title' => 'Mari Bangun Solusi Digital untuk Bisnis Anda',
            'cta_description' => 'Diskusikan kebutuhan website, aplikasi, SaaS, integrasi sistem, atau AI bersama JASAIBNU.',
            'cta_primary_label' => 'Konsultasi Gratis',
            'cta_primary_url' => '/contact',
            'cta_secondary_label' => 'Lihat Layanan',
            'cta_secondary_url' => '/services',
        ];
    }

    public static function current(): self
    {
        return static::query()->first() ?: static::query()->create(static::defaults());
    }

    public function value(string $key): ?string
    {
        return $this->{$key} ?: static::defaults()[$key] ?? null;
    }

    public function ctaPrimaryLabel(): string
    {
        return $this->value('cta_primary_label') ?: 'Konsultasi Gratis';
    }

    public function ctaSecondaryLabel(): string
    {
        return $this->value('cta_secondary_label') ?: 'Lihat Layanan';
    }

    public function ctaPrimaryUrl(): string
    {
        return $this->resolveUrl($this->cta_primary_url, route('contact'));
    }

    public function ctaSecondaryUrl(): string
    {
        return $this->resolveUrl($this->cta_secondary_url, route('services.index'));
    }

    private function resolveUrl(?string $url, string $fallback): string
    {
        $url = trim((string) $url);

        if ($url === '') {
            return $fallback;
        }

        return str_starts_with($url, 'http://') || str_starts_with($url, 'https://')
            ? $url
            : url($url);
    }
}
