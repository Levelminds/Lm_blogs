<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePageTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'slug' => ['required', 'string', 'max:150', 'unique:page_templates,slug'],
            'status' => ['sometimes', 'string', 'in:draft,published,archived'],
            'layout_variant' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'meta' => ['nullable', 'array'],
            'theme_setting_id' => ['nullable', 'exists:theme_settings,id'],
        ];
    }
}
