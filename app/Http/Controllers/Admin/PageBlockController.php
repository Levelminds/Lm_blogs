<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePageBlockRequest;
use App\Http\Requests\Admin\UpdatePageBlockRequest;
use App\Models\PageBlock;
use App\Models\PageSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageBlockController extends Controller
{
    public function store(StorePageBlockRequest $request): JsonResponse
    {
        $block = PageBlock::query()->create($request->validated());

        return response()->json($block->load('section'), 201);
    }

    public function show(PageBlock $block): JsonResponse
    {
        return response()->json($block->load('section'));
    }

    public function update(UpdatePageBlockRequest $request, PageBlock $block): JsonResponse
    {
        $block->fill($request->validated());
        $block->save();

        return response()->json($block->fresh('section'));
    }

    public function destroy(PageBlock $block): JsonResponse
    {
        $block->delete();

        return response()->json(status: 204);
    }

    public function reorder(Request $request, PageSection $section): JsonResponse
    {
        $request->validate([
            'order' => ['required', 'array'],
            'order.*.id' => ['required', 'exists:page_blocks,id'],
            'order.*.position' => ['required', 'integer', 'min:0'],
        ]);

        foreach ($request->input('order') as $item) {
            PageBlock::query()
                ->where('id', $item['id'])
                ->where('page_section_id', $section->id)
                ->update(['position' => $item['position']]);
        }

        $section->touch();

        return response()->json($section->fresh(['blocks' => fn ($query) => $query->orderBy('position')]));
    }
}
