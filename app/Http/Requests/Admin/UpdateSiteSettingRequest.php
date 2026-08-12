<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingRequest extends FormRequest
{
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
            'whatsapp_number' => ['nullable', 'string', 'max:80'],
            'whatsapp_url' => ['nullable', 'url', 'max:255'],
            'address' => ['nullable', 'string', 'max:220'],
            'city' => ['nullable', 'string', 'max:120'],
            'country' => ['nullable', 'string', 'max:120'],
            'google_maps_embed_url' => ['nullable', 'url', 'max:255'],
            'google_maps_external_url' => ['nullable', 'url', 'max:255'],
            'x_url' => ['nullable', 'string', 'max:255', 'regex:/^(#|https?:\/\/.+)$/'],
            'facebook_url' => ['nullable', 'string', 'max:255', 'regex:/^(#|https?:\/\/.+)$/'],
            'linkedin_url' => ['nullable', 'string', 'max:255', 'regex:/^(#|https?:\/\/.+)$/'],
            'instagram_url' => ['nullable', 'string', 'max:255', 'regex:/^(#|https?:\/\/.+)$/'],
            'footer_description' => ['nullable', 'string', 'max:600'],
            'copyright_text' => ['nullable', 'string', 'max:220'],
        ];
    }
}
