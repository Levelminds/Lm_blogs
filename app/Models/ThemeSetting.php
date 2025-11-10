<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'primary_color',
        'secondary_color',
        'accent_color',
        'text_color',
        'heading_font',
        'body_font',
        'palette',
        'global_styles',
    ];

    protected $casts = [
        'palette' => 'array',
        'global_styles' => 'array',
    ];

    public function templates()
    {
        return $this->hasMany(PageTemplate::class);
    }
}
