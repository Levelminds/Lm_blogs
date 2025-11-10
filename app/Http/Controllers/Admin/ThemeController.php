<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateThemeSettingRequest;
use App\Models\ThemeSetting;
use Illuminate\Http\JsonResponse;

class ThemeController extends Controller
{
    public function show(): JsonResponse
    {
        $theme = ThemeSetting::query()->first();

        return response()->json($theme);
    }

    public function update(UpdateThemeSettingRequest $request): JsonResponse
    {
        $theme = ThemeSetting::query()->first();

        if (! $theme) {
            $theme = ThemeSetting::query()->create($request->validated());
        } else {
            $theme->fill($request->validated());
            $theme->save();
        }

        return response()->json($theme);
    }
}
