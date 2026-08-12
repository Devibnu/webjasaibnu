<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        return [
            'hero_label' => ['required', 'string', 'max:120'],
            'hero_title' => ['required', 'string', 'max:220'],
            'content_p1' => ['required', 'string', 'max:1000'],
            'content_p2' => ['nullable', 'string', 'max:1000'],
            'visual_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'value_1_title' => ['required', 'string', 'max:120'],
            'value_1_body' => ['required', 'string', 'max:500'],
            'value_2_title' => ['required', 'string', 'max:120'],
            'value_2_body' => ['required', 'string', 'max:500'],
            'value_3_title' => ['required', 'string', 'max:120'],
            'value_3_body' => ['required', 'string', 'max:500'],
            'value_4_title' => ['required', 'string', 'max:120'],
            'value_4_body' => ['required', 'string', 'max:500'],
            'cta_consultation_text' => ['required', 'string', 'max:120'],
            'cta_services_text' => ['required', 'string', 'max:120'],
            'process_label' => ['required', 'string', 'max:120'],
            'process_title' => ['required', 'string', 'max:220'],
            'step_1_title' => ['required', 'string', 'max:120'],
            'step_1_body' => ['required', 'string', 'max:500'],
            'step_2_title' => ['required', 'string', 'max:120'],
            'step_2_body' => ['required', 'string', 'max:500'],
            'step_3_title' => ['required', 'string', 'max:120'],
            'step_3_body' => ['required', 'string', 'max:500'],
        ];
    }
}
