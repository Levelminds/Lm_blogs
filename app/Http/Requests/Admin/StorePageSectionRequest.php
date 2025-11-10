<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePageSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'page_template_id' => ['required', 'exists:page_templates,id'],
            'title' => ['nullable', 'string', 'max:150'],
            'handle' => ['nullable', 'string', 'max:150'],
            'type' => ['required', 'string', 'max:150'],
            'position' => ['nullable', 'integer', 'min:0'],
            'settings' => ['nullable', 'array'],
            'content' => ['nullable', 'array'],
            'background_media_id' => ['nullable', 'exists:media,id'],
        ];
    }
}
