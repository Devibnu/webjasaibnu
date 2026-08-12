<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        $service = $this->route('service');

        return [
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180', Rule::unique('services', 'slug')->ignore($service?->id)],
            'icon' => ['required', 'string', 'max:40'],
            'description' => ['required', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
