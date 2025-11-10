<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PageTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme_setting_id',
        'name',
        'slug',
        'status',
        'layout_variant',
        'description',
        'meta',
        'published_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'meta' => 'array',
        'published_at' => 'datetime',
    ];

    public function theme(): BelongsTo
    {
        return $this->belongsTo(ThemeSetting::class, 'theme_setting_id');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('position');
    }

    public function publishedSections(): HasMany
    {
        return $this->hasMany(PageSection::class)
            ->whereNull('settings->draft')
            ->orderBy('position');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
