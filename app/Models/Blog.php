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
        if (! $this->thumbnail) {
            return null;
        }

        if (str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }

        $path = ltrim($this->thumbnail, '/');

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        if (str_starts_with($path, 'public/')) {
            return Storage::url(substr($path, strlen('public/')));
        }

        if (str_starts_with($path, 'app/public/')) {
            return Storage::url(substr($path, strlen('app/public/')));
        }

        return Storage::url($path);
    }

    public function getVideoStreamUrlAttribute(): ?string
    {
        if ($this->external_video_url) {
            return $this->external_video_url;
        }

        if ($this->video_path) {
            return Storage::url($this->video_path);
        }

        return null;
    }

    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (! $this->external_video_url) {
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
        if (! $this->og_image) {
            return $this->thumbnail_url;
        }

        if (str_starts_with($this->og_image, 'http')) {
            return $this->og_image;
        }

        $path = ltrim($this->og_image, '/');

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        if (str_starts_with($path, 'public/')) {
            return Storage::url(substr($path, strlen('public/')));
        }

        if (str_starts_with($path, 'app/public/')) {
            return Storage::url(substr($path, strlen('app/public/')));
        }

        return Storage::url($path);
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
}
