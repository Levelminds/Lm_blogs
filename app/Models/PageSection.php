<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_template_id',
        'background_media_id',
        'title',
        'handle',
        'type',
        'position',
        'settings',
        'content',
    ];

    protected $casts = [
        'settings' => 'array',
        'content' => 'array',
    ];

    protected $touches = ['template'];

    public function template(): BelongsTo
    {
        return $this->belongsTo(PageTemplate::class, 'page_template_id');
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(PageBlock::class)->orderBy('position');
    }

    public function backgroundMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'background_media_id');
    }
}
