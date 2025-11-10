<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Admin\Concerns\ResolvesBlockSchemas;
use Illuminate\Support\Facades\Validator;

class StorePageBlockRequest extends FormRequest
{
    use ResolvesBlockSchemas;

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

    public function withValidator($validator): void
    {
        $schema = $this->resolveBlockSchema($this->input('type'));

        if (empty($schema)) {
            return;
        }

        $contentRules = $this->makeContentRules($schema);

        if (empty($contentRules)) {
            return;
        }

        $contentValidator = Validator::make($this->all(), $contentRules);

        if ($contentValidator->fails()) {
            foreach ($contentValidator->errors()->toArray() as $field => $messages) {
                foreach ($messages as $message) {
                    $validator->errors()->add($field, $message);
                }
            }
        }
    }
}
