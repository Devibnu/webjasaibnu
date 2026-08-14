<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreHeroSlideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        return [
            'eyebrow' => ['nullable', 'string', 'max:220'],
            'title' => ['required', 'string', 'max:220'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'primary_button_text' => ['nullable', 'string', 'max:120'],
            'primary_button_url' => ['nullable', 'string', 'max:255', 'regex:/^(?:https?:\/\/|\/|#)/'],
            'secondary_button_text' => ['nullable', 'string', 'max:120'],
            'secondary_button_url' => ['nullable', 'string', 'max:255', 'regex:/^(?:https?:\/\/|\/|#)/'],
            'overlay_opacity' => ['nullable', 'integer', 'between:0,100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}