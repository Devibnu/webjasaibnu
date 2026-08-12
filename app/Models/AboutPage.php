<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AboutPage extends Model
{
    protected $fillable = [
        'hero_label',
        'hero_title',
        'content_p1',
        'content_p2',
        'visual_image',
        'value_1_title',
        'value_1_body',
        'value_2_title',
        'value_2_body',
        'value_3_title',
        'value_3_body',
        'value_4_title',
        'value_4_body',
        'cta_consultation_text',
        'cta_services_text',
        'process_label',
        'process_title',
        'step_1_title',
        'step_1_body',
        'step_2_title',
        'step_2_body',
        'step_3_title',
        'step_3_body',
    ];

    public static function defaults(): array
    {
        return [
            'hero_label' => 'TENTANG JASAIBNU',
            'hero_title' => 'Partner Teknologi untuk Pertumbuhan Bisnis Digital',
            'content_p1' => 'JASAIBNU melalui PT JASA IBNU DEVELOPMENT membantu bisnis membangun dan mengembangkan solusi digital mulai dari website, aplikasi web, SaaS, SEO, integrasi sistem, hingga penerapan AI.',
            'content_p2' => 'Kami berfokus pada solusi yang tidak hanya berjalan hari ini, tetapi juga memiliki fondasi teknis yang scalable, aman, mudah dipelihara, dan siap dikembangkan mengikuti kebutuhan bisnis.',
            'visual_image' => null,
            'value_1_title' => 'Scalable Development',
            'value_1_body' => 'Arsitektur dan kode dipersiapkan agar dapat berkembang mengikuti kebutuhan bisnis.',
            'value_2_title' => 'Security Focused',
            'value_2_body' => 'Keamanan menjadi bagian dari proses perancangan dan pengembangan sistem.',
            'value_3_title' => 'Business Oriented',
            'value_3_body' => 'Teknologi dipilih berdasarkan kebutuhan dan proses bisnis, bukan sekadar mengikuti tren.',
            'value_4_title' => 'Long-Term Development',
            'value_4_body' => 'Solusi dirancang agar mudah dipelihara, diintegrasikan, dan dikembangkan dalam jangka panjang.',
            'cta_consultation_text' => 'Konsultasi Gratis',
            'cta_services_text' => 'Lihat Layanan',
            'process_label' => 'CARA KAMI BEKERJA',
            'process_title' => 'Teknologi yang Dimulai dari Kebutuhan Bisnis',
            'step_1_title' => 'Understand',
            'step_1_body' => 'Memahami kebutuhan, proses, masalah, dan target bisnis.',
            'step_2_title' => 'Build',
            'step_2_body' => 'Merancang dan mengembangkan solusi dengan teknologi yang sesuai.',
            'step_3_title' => 'Grow',
            'step_3_body' => 'Mengoptimalkan dan mengembangkan sistem mengikuti pertumbuhan bisnis.',
        ];
    }

    public static function current(): self
    {
        return static::query()->first() ?: static::query()->create(static::defaults());
    }

    public static function fallback(): self
    {
        return new static(static::defaults());
    }

    public function visualImageUrl(): string
    {
        if ($this->visual_image && Storage::disk('public')->exists($this->visual_image)) {
            return asset('storage/' . $this->visual_image);
        }

        return asset('assets/startup2/img/about.jpg');
    }

    public function valuesList(): array
    {
        return [
            ['title' => $this->value_1_title, 'body' => $this->value_1_body],
            ['title' => $this->value_2_title, 'body' => $this->value_2_body],
            ['title' => $this->value_3_title, 'body' => $this->value_3_body],
            ['title' => $this->value_4_title, 'body' => $this->value_4_body],
        ];
    }

    public function processSteps(): array
    {
        return [
            ['step' => '01', 'title' => $this->step_1_title, 'body' => $this->step_1_body],
            ['step' => '02', 'title' => $this->step_2_title, 'body' => $this->step_2_body],
            ['step' => '03', 'title' => $this->step_3_title, 'body' => $this->step_3_body],
        ];
    }
}
