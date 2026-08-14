<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateSiteSettingRequest extends FormRequest
{
    private const WHATSAPP_URL_HOSTS = [
        'wa.me',
        'wa.link',
        'api.whatsapp.com',
        'whatsapp.com',
    ];

    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:120'],
            'company_legal_name' => ['nullable', 'string', 'max:180'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:120'],
            'whatsapp_number' => ['nullable', 'string', 'max:20', 'regex:/^\+?62\d{7,16}$/'],
            'whatsapp_url' => ['nullable', 'url', 'max:255'],
            'address' => ['nullable', 'string', 'max:220'],
            'city' => ['nullable', 'string', 'max:120'],
            'country' => ['nullable', 'string', 'max:120'],
            'google_maps_embed_url' => ['nullable', 'url', 'max:2000'],
            'google_maps_external_url' => ['nullable', 'url', 'max:255'],
            'x_url' => ['nullable', 'string', 'max:255', 'regex:/^(#|https?:\/\/.+)$/'],
            'facebook_url' => ['nullable', 'string', 'max:255', 'regex:/^(#|https?:\/\/.+)$/'],
            'linkedin_url' => ['nullable', 'string', 'max:255', 'regex:/^(#|https?:\/\/.+)$/'],
            'instagram_url' => ['nullable', 'string', 'max:255', 'regex:/^(#|https?:\/\/.+)$/'],
            'footer_description' => ['nullable', 'string', 'max:600'],
            'copyright_text' => ['nullable', 'string', 'max:220'],
            'logo_path' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'logo_dark_path' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'favicon_path' => ['nullable', 'file', 'mimes:png,ico,webp', 'max:1024'],
            'remove_logo' => ['nullable', 'boolean'],
            'remove_logo_dark' => ['nullable', 'boolean'],
            'remove_favicon' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $whatsappNumber = $this->input('whatsapp_number');

        if (is_string($whatsappNumber)) {
            $normalizedNumber = preg_replace('/[\s-]+/', '', $whatsappNumber);

            $this->merge([
                'whatsapp_number' => $normalizedNumber === '' ? null : $normalizedNumber,
            ]);
        }

        $whatsappUrl = $this->input('whatsapp_url');

        if (is_string($whatsappUrl) && trim($whatsappUrl) === '') {
            $this->merge(['whatsapp_url' => null]);
        }

        $googleMapsEmbedUrl = $this->input('google_maps_embed_url');

        if (is_string($googleMapsEmbedUrl)) {
            $this->merge([
                'google_maps_embed_url' => $this->normalizeGoogleMapsEmbedUrl($googleMapsEmbedUrl),
            ]);
        }
    }

    private function normalizeGoogleMapsEmbedUrl(string $value): ?string
    {
        $value = trim($value);

        if ($value === '') {
            return null;
        }

        if (preg_match('/<iframe\b[^>]*\bsrc=(["\'])(.*?)\1/i', $value, $matches)) {
            return html_entity_decode($matches[2], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        return $value;
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $url = $this->input('whatsapp_url');

                if (! $url) {
                    return;
                }

                $host = parse_url($url, PHP_URL_HOST);
                $host = is_string($host) ? strtolower($host) : null;
                $host = $host ? preg_replace('/^www\./', '', $host) : null;

                if (! in_array($host, self::WHATSAPP_URL_HOSTS, true)) {
                    $validator->errors()->add('whatsapp_url', 'WhatsApp URL must use wa.me, wa.link, api.whatsapp.com, or whatsapp.com.');
                }
            },
        ];
    }
}
