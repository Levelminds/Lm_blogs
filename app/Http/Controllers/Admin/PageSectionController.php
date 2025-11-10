<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePageSectionRequest;
use App\Http\Requests\Admin\UpdatePageSectionRequest;
use App\Models\PageSection;
use App\Models\PageTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageSectionController extends Controller
{
    public function store(StorePageSectionRequest $request): JsonResponse
    {
        $section = PageSection::query()->create($request->validated());

        return response()->json($section->load(['blocks', 'backgroundMedia']), 201);
    }

    public function show(PageSection $section): JsonResponse
    {
        return response()->json($section->load(['blocks', 'backgroundMedia']));
    }

    public function update(UpdatePageSectionRequest $request, PageSection $section): JsonResponse
    {
        $section->fill($request->validated());
        $section->save();

        return response()->json($section->fresh(['blocks', 'backgroundMedia']));
    }

    public function destroy(PageSection $section): JsonResponse
    {
        $section->delete();

        return response()->json(status: 204);
    }

    public function reorder(Request $request, PageTemplate $template): JsonResponse
    {
        $request->validate([
            'order' => ['required', 'array'],
            'order.*.id' => ['required', 'exists:page_sections,id'],
            'order.*.position' => ['required', 'integer', 'min:0'],
        ]);

        foreach ($request->input('order') as $item) {
            PageSection::query()
                ->where('id', $item['id'])
                ->where('page_template_id', $template->id)
                ->update(['position' => $item['position']]);
        }

        $template->touch();

        return response()->json(
            $template->fresh(['sections' => fn ($query) => $query->with('blocks')->orderBy('position')])
        );
    }
}
