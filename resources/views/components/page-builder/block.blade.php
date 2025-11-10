@props(['block'])

@php
    $type = $block->type;
    $content = $block->content ?? [];
@endphp

@if($type === 'image')
    @php
        $mediaId = $content['image_id'] ?? null;
        $media = $mediaId ? \App\Models\Media::query()->find($mediaId) : null;
        $link = $content['link_url'] ?? null;
    @endphp
    @if($media)
        <figure class="builder-block builder-block--image">
            @if($link)
                <a href="{{ $link }}" class="block" target="_blank" rel="noopener">
                    <img src="{{ $media->url }}" alt="{{ $content['alt_text'] ?? $media->original_name }}" class="w-full object-cover">
                </a>
            @else
                <img src="{{ $media->url }}" alt="{{ $content['alt_text'] ?? $media->original_name }}" class="w-full object-cover">
            @endif
            @if(!empty($content['caption']))
                <figcaption>{{ $content['caption'] }}</figcaption>
            @endif
        </figure>
    @endif
@elseif($type === 'gallery')
    @php
        $items = collect($content['items'] ?? [])->filter(fn ($item) => !empty($item['image_id']))->sortBy('order')->values();
        $mediaIds = $items->pluck('image_id')->unique()->all();
        $mediaMap = !empty($mediaIds)
            ? \App\Models\Media::query()->whereIn('id', $mediaIds)->get()->keyBy('id')
            : collect();
        $columns = max(1, min(6, (int) ($content['columns'] ?? 3)));
    @endphp
    @if($items->isNotEmpty())
        <div class="builder-block builder-block--gallery" style="--builder-gallery-columns: {{ $columns }};">
            @foreach($items as $item)
                @php $media = $mediaMap[$item['image_id']] ?? null; @endphp
                @if($media)
                    <figure class="builder-gallery-item">
                        <img src="{{ $media->url }}" alt="{{ $item['caption'] ?? $media->original_name }}" class="h-full w-full object-cover">
                        @if(!empty($item['caption']))
                            <figcaption>{{ $item['caption'] }}</figcaption>
                        @endif
                    </figure>
                @endif
            @endforeach
        </div>
    @endif
@elseif($type === 'slider')
    @php
        $slides = collect($content['slides'] ?? [])->filter(fn ($item) => !empty($item['image_id']))->sortBy('order')->values();
        $mediaIds = $slides->pluck('image_id')->unique()->all();
        $mediaMap = !empty($mediaIds)
            ? \App\Models\Media::query()->whereIn('id', $mediaIds)->get()->keyBy('id')
            : collect();
    @endphp
    @if($slides->isNotEmpty())
        <div class="builder-block builder-block--slider" data-autoplay="{{ !empty($content['autoplay']) ? 'true' : 'false' }}" data-interval="{{ $content['interval'] ?? 5000 }}">
            <div class="builder-slider-track">
                @foreach($slides as $item)
                    @php $media = $mediaMap[$item['image_id']] ?? null; @endphp
                    @if($media)
                        <figure class="builder-slider-slide">
                            <img src="{{ $media->url }}" alt="{{ $item['caption'] ?? $media->original_name }}" class="h-full w-full object-cover">
                            @if(!empty($item['caption']))
                                <figcaption>{{ $item['caption'] }}</figcaption>
                            @endif
                        </figure>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
@else
    <div class="builder-block builder-block--fallback">
        <p class="text-sm font-medium text-slate-600">Unsupported block type: <span class="font-mono text-xs">{{ $type }}</span></p>
        @if(!empty($content))
            <pre class="mt-3 rounded-lg bg-slate-900/90 p-4 text-xs text-white overflow-auto">{{ json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
        @endif
    </div>
@endif
