<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePageBlockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'page_section_id' => ['required', 'exists:page_sections,id'],
            'type' => ['required', 'string', 'max:150'],
            'title' => ['nullable', 'string', 'max:150'],
            'position' => ['nullable', 'integer', 'min:0'],
            'content' => ['nullable', 'array'],
            'settings' => ['nullable', 'array'],
        ];
    }
}
