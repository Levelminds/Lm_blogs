<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMediaRequest;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $collection = $request->get('collection');

        $media = Media::query()
            ->when($collection, fn ($query) => $query->where('collection', $collection))
            ->orderByDesc('created_at')
            ->paginate(24);

        return response()->json($media);
    }

    public function store(StoreMediaRequest $request): JsonResponse
    {
        $file = $request->file('file');
        $disk = 'public';
        $collection = $request->input('collection', 'page-builder');
        $path = $file->store("media/{$collection}", $disk);

        $dimensions = @getimagesize($file->getPathname());

        $media = Media::query()->create([
            'collection' => $collection,
            'disk' => $disk,
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'meta' => [
                'width' => $dimensions[0] ?? null,
                'height' => $dimensions[1] ?? null,
            ],
        ]);

        return response()->json($media, 201);
    }

    public function destroy(Media $media): JsonResponse
    {
        if (Storage::disk($media->disk)->exists($media->path)) {
            Storage::disk($media->disk)->delete($media->path);
        }

        $media->delete();

        return response()->json(status: 204);
    }
}
