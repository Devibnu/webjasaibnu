<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'company_name',
        'company_legal_name',
        'email',
        'phone',
        'whatsapp_number',
        'whatsapp_url',
        'address',
        'city',
        'country',
        'google_maps_embed_url',
        'google_maps_external_url',
        'x_url',
        'facebook_url',
        'linkedin_url',
        'instagram_url',
        'footer_description',
        'copyright_text',
    ];

    public static function defaults(): array
    {
        return [
            'company_name' => 'JASAIBNU',
            'company_legal_name' => 'PT JASA IBNU DEVELOPMENT',
            'email' => 'hello@jasaibnu.com',
            'phone' => 'Konsultasi via WhatsApp',
            'whatsapp_number' => null,
            'whatsapp_url' => null,
            'address' => 'Jakarta, Indonesia',
            'city' => 'Jakarta',
            'country' => 'Indonesia',
            'google_maps_embed_url' => 'https://www.google.com/maps?q=Jakarta%2C%20Indonesia&output=embed',
            'google_maps_external_url' => null,
            'x_url' => '#',
            'facebook_url' => '#',
            'linkedin_url' => '#',
            'instagram_url' => '#',
            'footer_description' => 'Solusi digital untuk website, aplikasi, SaaS, SEO, dan integrasi AI yang dirancang agar scalable, aman, dan siap dikembangkan jangka panjang.',
            'copyright_text' => 'All Rights Reserved.',
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

    public function contactAddress(): string
    {
        return $this->address ?: trim(collect([$this->city, $this->country])->filter()->implode(', '));
    }

    public function socialLinks(): array
    {
        return [
            ['label' => 'X', 'key' => 'x_url', 'value' => $this->x_url, 'text' => 'x'],
            ['label' => 'Facebook', 'key' => 'facebook_url', 'value' => $this->facebook_url, 'text' => 'f'],
            ['label' => 'LinkedIn', 'key' => 'linkedin_url', 'value' => $this->linkedin_url, 'text' => 'in'],
            ['label' => 'Instagram', 'key' => 'instagram_url', 'value' => $this->instagram_url, 'text' => 'ig'],
        ];
    }
}
