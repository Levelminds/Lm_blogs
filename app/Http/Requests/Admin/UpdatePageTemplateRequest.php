<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePageTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:150'],
            'slug' => [
                'sometimes',
                'string',
                'max:150',
                Rule::unique('page_templates', 'slug')->ignore($this->route('template')),
            ],
            'status' => ['sometimes', 'string', 'in:draft,published,archived'],
            'layout_variant' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'meta' => ['nullable', 'array'],
            'theme_setting_id' => ['nullable', 'exists:theme_settings,id'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
