<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public static function defaultItems(): array
    {
        return [
            [
                'title' => 'Website Development',
                'slug' => 'website-development',
                'icon' => 'SH',
                'description' => 'Website perusahaan yang cepat, responsive, SEO-ready, dan mudah dikembangkan untuk kebutuhan bisnis jangka panjang.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'SEO Services',
                'slug' => 'seo-services',
                'icon' => 'DA',
                'description' => 'Optimasi struktur teknis, on-page, dan arsitektur konten agar website lebih mudah dipahami mesin pencari.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Web Application',
                'slug' => 'web-application',
                'icon' => '</>',
                'description' => 'Aplikasi web custom untuk workflow, data, approval, dashboard, dan proses internal yang lebih tertata.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Mobile Application',
                'slug' => 'mobile-application',
                'icon' => 'AP',
                'description' => 'Aplikasi mobile untuk kebutuhan pelanggan, operasional lapangan, atau proses internal dengan akses cepat.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'SaaS Development',
                'slug' => 'saas-development',
                'icon' => 'S',
                'description' => 'Pengembangan platform SaaS dengan akun pengguna, subscription-ready flow, dan roadmap produk modular.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'AI Integration',
                'slug' => 'ai-integration',
                'icon' => 'AI',
                'description' => 'Integrasi AI dan automation yang relevan untuk mempercepat pekerjaan, pencarian informasi, dan proses tim.',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];
    }
}
