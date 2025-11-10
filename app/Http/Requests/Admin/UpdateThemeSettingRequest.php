<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThemeSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:150'],
            'primary_color' => ['nullable', 'string', 'max:20'],
            'secondary_color' => ['nullable', 'string', 'max:20'],
            'accent_color' => ['nullable', 'string', 'max:20'],
            'text_color' => ['nullable', 'string', 'max:20'],
            'heading_font' => ['nullable', 'string', 'max:150'],
            'body_font' => ['nullable', 'string', 'max:150'],
            'palette' => ['nullable', 'array'],
            'global_styles' => ['nullable', 'array'],
        ];
    }
}
