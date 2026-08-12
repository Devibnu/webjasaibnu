<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Solution extends Model
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

        static::creating(function ($solution) {
            if (empty($solution->slug)) {
                $solution->slug = Str::slug($solution->title);
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
                'title' => 'Business Process Automation',
                'slug' => 'business-process-automation',
                'icon' => 'BA',
                'description' => 'Digitalisasi dan otomasi workflow untuk mengurangi proses manual dan meningkatkan efisiensi operasional.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'System Integration',
                'slug' => 'system-integration',
                'icon' => 'SI',
                'description' => 'Integrasi antar aplikasi, API, database, dan layanan eksternal agar data dan proses bisnis berjalan lebih terhubung.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Cloud & Scalable Architecture',
                'slug' => 'cloud-scalable-architecture',
                'icon' => 'CL',
                'description' => 'Perancangan arsitektur aplikasi yang scalable, maintainable, dan siap berkembang mengikuti kebutuhan bisnis.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'AI-Powered Solutions',
                'slug' => 'ai-powered-solutions',
                'icon' => 'AI',
                'description' => 'Penerapan AI untuk automation, chatbot, intelligent search, document processing, dan peningkatan produktivitas.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Digital Platform Development',
                'slug' => 'digital-platform-development',
                'icon' => 'DP',
                'description' => 'Pengembangan platform digital custom untuk mendukung operasional, customer experience, dan model bisnis baru.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Legacy System Modernization',
                'slug' => 'legacy-system-modernization',
                'icon' => 'LM',
                'description' => 'Modernisasi aplikasi lama secara bertahap agar lebih aman, mudah dikembangkan, dan siap terintegrasi dengan teknologi baru.',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];
    }
}
