<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category_id',
        'thumbnail',
        'views',
        'likes',
        'published_at',
        'is_featured',
        'reading_time',
        'metadata',
        'media_type',
        'video_path',
        'external_video_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'metadata' => 'array',
        'media_type' => 'string',
    ];

    protected $appends = [
        'thumbnail_url',
        'video_stream_url',
        'video_embed_url',
        'og_image_url',
        'is_video',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->resolvePublicAssetUrl($this->thumbnail);
    }

    public function getVideoStreamUrlAttribute(): ?string
    {
        if ($this->external_video_url) {
            return $this->isStreamableFileUrl($this->external_video_url)
                ? $this->external_video_url
                : null;
        }

        return $this->resolvePublicAssetUrl($this->video_path);
    }

    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (! $this->external_video_url || $this->isStreamableFileUrl($this->external_video_url)) {
            return null;
        }

        $url = $this->external_video_url;

        if (Str::contains($url, ['youtube.com', 'youtu.be'])) {
            if (preg_match('/(youtu\.be\/|v=)([^&]+)/', $url, $matches)) {
                $videoId = $matches[2];
            } elseif (preg_match('/embed\/([^?]+)/', $url, $matches)) {
                $videoId = $matches[1];
            } else {
                $videoId = null;
            }

            return $videoId ? 'https://www.youtube.com/embed/'.$videoId : $url;
        }

        if (Str::contains($url, 'vimeo.com')) {
            if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
                return 'https://player.vimeo.com/video/'.$matches[1];
            }
        }

        return $url;
    }

    public function getOgImageUrlAttribute(): ?string
    {
        return $this->resolvePublicAssetUrl($this->og_image, $this->thumbnail_url);
    }

    public function getIsVideoAttribute(): bool
    {
        return $this->media_type === 'video';
    }

    public function isVideo(): bool
    {
        return $this->getIsVideoAttribute();
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePublished($query)
    {
        return $query->where(function ($query) {
            $query->whereNull('published_at')
                ->orWhere('published_at', '<=', now());
        });
    }

    protected function resolvePublicAssetUrl(?string $value, ?string $fallback = null): ?string
    {
        if (! $value) {
            return $fallback;
        }

        if (Str::startsWith($value, ['http://', 'https://', '//'])) {
            return $value;
        }

        $path = $this->normalizePublicDiskPath($value);

        if ($path === null) {
            return $fallback;
        }

        $disk = Storage::disk('public');
        $url = $disk->url($path);

        if (! Str::startsWith($url, ['http://', 'https://'])) {
            $segments = [];

            if (app()->bound('request')) {
                $baseUrl = app('request')->getBaseUrl();

                if ($baseUrl !== '') {
                    $segments[] = trim($baseUrl, '/');
                }
            }

            if (empty($segments)) {
                $configured = config('app.url');

                if ($configured) {
                    $configuredPath = trim(parse_url($configured, PHP_URL_PATH) ?? '', '/');

                    if ($configuredPath !== '') {
                        $segments[] = $configuredPath;
                    }
                }
            }

            $segments[] = ltrim($url, '/');

            $url = '/'.ltrim(implode('/', array_filter($segments)), '/');
        } else {
            $url = $this->normalizeAbsoluteUrl($url);
        }

        if ($disk->exists($path) && $this->shouldServeFromRoute($path)) {
            return route('storage.asset', ['path' => $path], false);
        }

        return $url;
    }

    protected function normalizePublicDiskPath(string $value): ?string
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
            $originalPath = $path;

            foreach ($prefixes as $prefix) {
                if (Str::startsWith($path, $prefix)) {
                    $path = ltrim(substr($path, strlen($prefix)), '/');
                }
            }
        } while ($path !== $originalPath);

        return $path === '' ? null : $path;
    }

    protected function normalizeAbsoluteUrl(string $url): string
    {
        $appUrl = config('app.url');

        if ($appUrl) {
            $appUrl = rtrim($appUrl, '/');

            if (Str::startsWith($url, $appUrl.'/')) {
                return Str::start(substr($url, strlen($appUrl)), '/');
            }
        }

        $pathComponent = parse_url($url, PHP_URL_PATH) ?? '';
        $queryComponent = parse_url($url, PHP_URL_QUERY);

        if ($pathComponent !== '') {
            return $pathComponent.($queryComponent ? '?'.$queryComponent : '');
        }

        return $url;
    }

    protected function shouldServeFromRoute(string $path): bool
    {
        $publicStorage = public_path('storage');

        if (! app()->bound('router') || ! app('router')->has('storage.asset')) {
            return false;
        }

        if (! is_link($publicStorage) && ! is_dir($publicStorage)) {
            return true;
        }

        $publicAssetPath = public_path('storage/'.ltrim($path, '/'));

        if (! $this->isReadableFile($publicAssetPath)) {
            return true;
        }

        return false;
    }

    protected function isReadableFile(string $path): bool
    {
        if (! file_exists($path)) {
            return false;
        }

        if (! is_file($path)) {
            return false;
        }

        return is_readable($path);
    }

    protected function isStreamableFileUrl(string $url): bool
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        $path = parse_url($url, PHP_URL_PATH) ?? '';

        if (! $path) {
            return false;
        }

        $extensions = ['.mp4', '.webm', '.ogg', '.ogv', '.mov', '.m4v', '.m3u8'];

        $path = strtolower($path);

        foreach ($extensions as $extension) {
            if (str_ends_with($path, $extension)) {
                return true;
            }
        }

        return false;
    }
}
