<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:150'],
            'handle' => ['sometimes', 'string', 'max:150'],
            'type' => ['sometimes', 'string', 'max:150'],
            'position' => ['nullable', 'integer', 'min:0'],
            'settings' => ['nullable', 'array'],
            'content' => ['nullable', 'array'],
            'background_media_id' => ['nullable', 'exists:media,id'],
        ];
    }
}
