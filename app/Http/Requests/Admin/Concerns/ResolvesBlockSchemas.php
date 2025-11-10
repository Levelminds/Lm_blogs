<?php

namespace App\Http\Requests\Admin\Concerns;

trait ResolvesBlockSchemas
{
    protected function resolveBlockSchema(?string $type): ?array
    {
        if (! $type) {
            return null;
        }

        return config("page-builder.blocks.{$type}");
    }

    protected function makeContentRules(array $schema, string $prefix = 'content'): array
    {
        $rules = [];

        foreach ($schema['fields'] ?? [] as $field => $definition) {
            $path = sprintf('%s.%s', $prefix, $field);
            $rules = array_merge($rules, $this->buildSchemaRules($path, $definition));
        }

        return $rules;
    }

    protected function buildSchemaRules(string $path, array $definition): array
    {
        $rules = [];
        $required = (bool) ($definition['required'] ?? false);
        $type = $definition['type'] ?? 'string';

        switch ($type) {
            case 'media':
                $rules[$path] = [
                    $required ? 'required' : 'nullable',
                    'integer',
                    'exists:media,id',
                ];
                break;

            case 'url':
                $max = $definition['max'] ?? 2048;
                $rules[$path] = [
                    $required ? 'required' : 'nullable',
                    'url',
                    'max:' . $max,
                ];
                break;

            case 'integer':
                $fieldRules = [$required ? 'required' : 'nullable', 'integer'];
                if (array_key_exists('min', $definition)) {
                    $fieldRules[] = 'min:' . $definition['min'];
                }
                if (array_key_exists('max', $definition)) {
                    $fieldRules[] = 'max:' . $definition['max'];
                }
                $rules[$path] = $fieldRules;
                break;

            case 'boolean':
                $rules[$path] = [$required ? 'required' : 'nullable', 'boolean'];
                break;

            case 'collection':
                $collectionRules = [$required ? 'required' : 'nullable', 'array'];
                if ($required) {
                    $collectionRules[] = 'min:1';
                }
                $rules[$path] = $collectionRules;

                $itemFields = $definition['item_fields'] ?? [];
                foreach ($itemFields as $itemField => $itemDefinition) {
                    $nestedPath = $path . '.*.' . $itemField;
                    $rules = array_merge($rules, $this->buildSchemaRules($nestedPath, $itemDefinition));
                }
                break;

            case 'string':
            default:
                $fieldRules = [$required ? 'required' : 'nullable', 'string'];
                if (array_key_exists('max', $definition)) {
                    $fieldRules[] = 'max:' . $definition['max'];
                }
                if (array_key_exists('min', $definition)) {
                    $fieldRules[] = 'min:' . $definition['min'];
                }
                $rules[$path] = $fieldRules;
                break;
        }

        return $rules;
    }
}
