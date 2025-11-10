<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageTemplate;
use App\Models\ThemeSetting;

class PageBuilderController extends Controller
{
    public function index()
    {
        $templates = PageTemplate::query()
            ->with([
                'theme:id,name',
                'sections.blocks',
                'sections.backgroundMedia',
            ])
            ->orderBy('name')
            ->get();

        $activeTheme = ThemeSetting::query()->first();

        return view('admin.page-builder', [
            'templates' => $templates,
            'activeTheme' => $activeTheme,
            'blockSchemas' => config('page-builder.blocks'),
        ]);
    }
}
