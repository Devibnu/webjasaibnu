<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'region',
        'country',
        'google_maps_embed_url',
        'google_maps_external_url',
        'home_consultation_eyebrow',
        'home_consultation_title',
        'home_consultation_feature_one',
        'home_consultation_feature_two',
        'home_consultation_description',
        'home_consultation_contact_label',
        'home_consultation_card_title',
        'home_consultation_card_description',
        'home_consultation_button_text',
        'x_url',
        'facebook_url',
        'linkedin_url',
        'instagram_url',
        'footer_description',
        'copyright_text',
        'logo_path',
        'logo_dark_path',
        'favicon_path',
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
            'region' => null,
            'country' => 'Indonesia',
            'google_maps_embed_url' => 'https://www.google.com/maps?q=Jakarta%2C%20Indonesia&output=embed',
            'google_maps_external_url' => null,
            'home_consultation_eyebrow' => 'Consultation',
            'home_consultation_title' => 'Butuh Solusi Digital yang Sesuai dengan Proses Bisnis Anda?',
            'home_consultation_feature_one' => 'Analisis kebutuhan awal',
            'home_consultation_feature_two' => 'Diskusi scope teknis',
            'home_consultation_description' => 'Diskusikan kebutuhan website, aplikasi, SaaS, SEO, integrasi AI, atau sistem internal yang ingin Anda bangun bersama JASAIBNU. Kami membantu memetakan pendekatan yang realistis sebelum masuk ke tahap produksi.',
            'home_consultation_contact_label' => 'Mulai dengan konsultasi',
            'home_consultation_card_title' => 'Konsultasi Gratis',
            'home_consultation_card_description' => 'Ceritakan target bisnis dan kebutuhan sistem Anda. Kami akan membantu memetakan solusi digital yang sesuai.',
            'home_consultation_button_text' => 'Hubungi JASAIBNU',
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
            ['label' => 'X', 'key' => 'x_url', 'value' => $this->publicSocialUrl($this->x_url), 'text' => 'x'],
            ['label' => 'Facebook', 'key' => 'facebook_url', 'value' => $this->publicSocialUrl($this->facebook_url), 'text' => 'f'],
            ['label' => 'LinkedIn', 'key' => 'linkedin_url', 'value' => $this->publicSocialUrl($this->linkedin_url), 'text' => 'in'],
            ['label' => 'Instagram', 'key' => 'instagram_url', 'value' => $this->publicSocialUrl($this->instagram_url), 'text' => 'ig'],
        ];
    }

    private function publicSocialUrl(?string $url): ?string
    {
        return is_string($url) && filter_var($url, FILTER_VALIDATE_URL) ? $url : null;
    }

    public function publicLogoUrl(): ?string
    {
        return $this->logo_path ? asset('storage/' . $this->logo_path) : null;
    }

    public function whatsappContactUrl(?string $message = null): ?string
    {
        if ($this->whatsapp_url && filter_var($this->whatsapp_url, FILTER_VALIDATE_URL)) {
            return $this->whatsapp_url;
        }

        $number = preg_replace('/\D+/', '', (string) $this->whatsapp_number);

        if ($number === '' && $this->phone && ! Str::contains(Str::lower($this->phone), ['whatsapp', 'konsultasi'])) {
            $number = preg_replace('/\D+/', '', (string) $this->phone);
        }

        if ($number === '') {
            return null;
        }

        $url = 'https://wa.me/' . $number;

        if (filled($message)) {
            $url .= '?text=' . rawurlencode($message);
        }

        return $url;
    }

    public function validSocialProfileUrls(): array
    {
        return collect($this->socialLinks())
            ->pluck('value')
            ->filter(fn ($url) => is_string($url) && filter_var($url, FILTER_VALIDATE_URL))
            ->values()
            ->all();
    }

    public function schemaAddress(): ?array
    {
        $address = collect([
            'streetAddress' => $this->address,
            'addressLocality' => $this->city,
            'addressRegion' => $this->region,
            'addressCountry' => $this->country,
        ])->filter(fn ($value) => filled($value))->all();

        if (count($address) < 2) {
            return null;
        }

        return ['@type' => 'PostalAddress', ...$address];
    }

    public function organizationSchema(string $homeUrl): array
    {
        $homeUrl = rtrim($homeUrl, '/');
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => $homeUrl . '#organization',
            'name' => $this->company_legal_name ?: $this->company_name,
            'url' => $homeUrl,
        ];

        if ($logoUrl = $this->publicLogoUrl()) {
            $schema['logo'] = $logoUrl;
        }

        if ($this->email) {
            $schema['email'] = $this->email;
        }

        if ($this->phone && ! Str::contains(Str::lower($this->phone), ['whatsapp', 'konsultasi'])) {
            $schema['telephone'] = $this->phone;
        }

        if ($address = $this->schemaAddress()) {
            $schema['address'] = $address;
        }

        $sameAs = $this->validSocialProfileUrls();
        if ($sameAs !== []) {
            $schema['sameAs'] = $sameAs;
        }

        return $schema;
    }

    public function professionalServiceSchema(string $homeUrl): array
    {
        $homeUrl = rtrim($homeUrl, '/');

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            '@id' => $homeUrl . '#professional-service',
            'name' => $this->company_legal_name ?: $this->company_name,
            'alternateName' => $this->company_name ?: 'JASAIBNU',
            'url' => $homeUrl,
            'description' => 'JASAIBNU menyediakan jasa pembuatan website, aplikasi bisnis, SaaS, SEO, integrasi sistem, dan solusi AI untuk bisnis di Indonesia.',
            'priceRange' => '$$',
            'areaServed' => array_values(array_filter([
                ['@type' => 'City', 'name' => $this->city ?: 'Serang'],
                ['@type' => 'AdministrativeArea', 'name' => $this->region],
                ['@type' => 'Country', 'name' => $this->country ?: 'Indonesia'],
            ], fn (array $area) => filled($area['name']))),
            'serviceType' => [
                'Jasa pembuatan website',
                'Jasa pembuatan aplikasi bisnis',
                'SaaS development',
                'SEO services',
                'AI integration',
                'System integration',
            ],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Layanan Digital JASAIBNU',
                'itemListElement' => [
                    $this->serviceOffer('Jasa Pembuatan Website', 'Website company profile, landing page, dan website bisnis yang responsive, SEO-ready, dan mudah dikelola.'),
                    $this->serviceOffer('Jasa Pembuatan Aplikasi Bisnis', 'Aplikasi web untuk CRM, operasional, sales pipeline, ticketing, dashboard, dan workflow bisnis.'),
                    $this->serviceOffer('SEO Services', 'Optimasi SEO teknis dan on-page untuk meningkatkan visibilitas website bisnis di mesin pencari.'),
                    $this->serviceOffer('AI & System Integration', 'Integrasi API, automasi workflow, dan penerapan AI untuk meningkatkan produktivitas bisnis.'),
                ],
            ],
        ];

        if ($this->email) {
            $schema['email'] = $this->email;
        }

        if ($this->phone && ! Str::contains(Str::lower($this->phone), ['whatsapp', 'konsultasi'])) {
            $schema['telephone'] = $this->phone;
        }

        if ($logoUrl = $this->publicLogoUrl()) {
            $schema['image'] = $logoUrl;
        }

        if ($address = $this->schemaAddress()) {
            $schema['address'] = $address;
        }

        return $schema;
    }

    private function serviceOffer(string $name, string $description): array
    {
        return [
            '@type' => 'Offer',
            'itemOffered' => [
                '@type' => 'Service',
                'name' => $name,
                'description' => $description,
            ],
        ];
    }

    public function websiteSchema(string $homeUrl): array
    {
        $homeUrl = rtrim($homeUrl, '/');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => $homeUrl . '#website',
            'name' => $this->company_legal_name ?: $this->company_name,
            'url' => $homeUrl,
            'publisher' => [
                '@id' => $homeUrl . '#organization',
            ],
        ];
    }
}
