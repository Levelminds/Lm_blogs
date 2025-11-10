<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml', 'max:20480'],
            'collection' => ['nullable', 'string', 'max:120'],
        ];
    }
}
