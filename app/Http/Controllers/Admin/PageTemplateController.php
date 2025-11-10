<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePageTemplateRequest;
use App\Http\Requests\Admin\UpdatePageTemplateRequest;
use App\Models\PageTemplate;
use Illuminate\Http\JsonResponse;

class PageTemplateController extends Controller
{
    public function index(): JsonResponse
    {
        $templates = PageTemplate::query()
            ->with([
                'theme:id,name',
                'sections.blocks',
                'sections.backgroundMedia',
            ])
            ->orderByDesc('updated_at')
            ->get();

        return response()->json($templates);
    }

    public function store(StorePageTemplateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['created_by'] = auth('admin')->id();
        $data['updated_by'] = auth('admin')->id();

        $template = PageTemplate::query()->create($data);

        return response()->json(
            $template->load([
                'theme:id,name',
                'sections.blocks',
                'sections.backgroundMedia',
            ]),
            201
        );
    }

    public function show(PageTemplate $template): JsonResponse
    {
        $template->load(['theme', 'sections.blocks', 'sections.backgroundMedia']);

        return response()->json($template);
    }

    public function update(UpdatePageTemplateRequest $request, PageTemplate $template): JsonResponse
    {
        $data = $request->validated();
        $data['updated_by'] = auth('admin')->id();

        if (isset($data['status']) && $data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $template->fill($data);
        $template->save();

        return response()->json(
            $template->fresh(['theme', 'sections.blocks', 'sections.backgroundMedia'])
        );
    }

    public function destroy(PageTemplate $template): JsonResponse
    {
        $template->delete();

        return response()->json(status: 204);
    }

    public function publish(PageTemplate $template): JsonResponse
    {
        $template->update([
            'status' => 'published',
            'published_at' => now(),
            'updated_by' => auth('admin')->id(),
        ]);

        return response()->json(
            $template->fresh(['theme', 'sections.blocks', 'sections.backgroundMedia'])
        );
    }
}
