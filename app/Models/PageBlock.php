<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_section_id',
        'type',
        'title',
        'position',
        'content',
        'settings',
    ];

    protected $casts = [
        'content' => 'array',
        'settings' => 'array',
    ];

    protected $touches = ['section'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }
}
