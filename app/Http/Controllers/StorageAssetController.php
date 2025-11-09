<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class StorageAssetController extends Controller
{
    public function __invoke(Request $request, string $path)
    {
        $normalizedPath = $this->normalizePath($path);

        if ($normalizedPath === null) {
            abort(404);
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($normalizedPath)) {
            abort(404);
        }

        $lastModified = $this->safeRetrieve(function () use ($disk, $normalizedPath) {
            return $disk->lastModified($normalizedPath);
        });

        if ($lastModified && $request->headers->has('If-Modified-Since')) {
            $ifModifiedSince = strtotime($request->header('If-Modified-Since'));

            if ($ifModifiedSince !== false && $lastModified <= $ifModifiedSince) {
                return response()
                    ->noContent(304)
                    ->withHeaders(['Cache-Control' => 'public, max-age=31536000']);
            }
        }

        $mimeType = $this->safeRetrieve(function () use ($disk, $normalizedPath) {
            return $disk->mimeType($normalizedPath);
        }) ?: 'application/octet-stream';

        $size = $this->safeRetrieve(function () use ($disk, $normalizedPath) {
            return $disk->size($normalizedPath);
        });

        $headers = [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=31536000',
        ];

        if (is_numeric($size)) {
            $headers['Content-Length'] = (string) $size;
        }

        if ($lastModified) {
            $headers['Last-Modified'] = gmdate('D, d M Y H:i:s', $lastModified).' GMT';
        }

        if ($request->isMethod('head')) {
            return response()->noContent(200)->withHeaders($headers);
        }

        $stream = $this->safeRetrieve(function () use ($disk, $normalizedPath) {
            return $disk->readStream($normalizedPath);
        });

        if (! is_resource($stream)) {
            abort(404);
        }

        return response()->stream(function () use ($stream) {
            try {
                fpassthru($stream);
            } finally {
                if (is_resource($stream)) {
                    fclose($stream);
                }
            }
        }, 200, $headers);
    }

    protected function normalizePath(string $value): ?string
    {
        $value = trim(str_replace('\\', '/', $value));

        if ($value === '') {
            return null;
        }

        $value = ltrim($value, '/');

        $segments = [];

        foreach (explode('/', $value) as $segment) {
            $segment = trim($segment);

            if ($segment === '' || $segment === '.') {
                continue;
            }

            if ($segment === '..') {
                return null;
            }

            $segments[] = $segment;
        }

        if (empty($segments)) {
            return null;
        }

        $path = implode('/', $segments);

        $prefixes = [
            'storage/',
            'public/',
            'app/public/',
            'public/storage/',
            'storage/app/public/',
        ];

        do {
            $original = $path;

            foreach ($prefixes as $prefix) {
                if (Str::startsWith($path, $prefix)) {
                    $path = ltrim(substr($path, strlen($prefix)), '/');
                }
            }
        } while ($path !== $original);

        return $path === '' ? null : $path;
    }

    /**
     * @template TValue
     *
     * @param  callable():TValue  $callback
     * @return TValue|null
     */
    protected function safeRetrieve(callable $callback): mixed
    {
        try {
            return $callback();
        } catch (Throwable $exception) {
            return null;
        }
    }
}

