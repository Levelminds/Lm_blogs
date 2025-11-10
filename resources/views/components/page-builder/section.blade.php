@props(['section'])

@php
    $settings = $section->settings ?? [];
    $background = $settings['background'] ?? [];
    $padding = $settings['padding'] ?? 'py-20';
    $backgroundStyle = [];

    if (!empty($background['color'])) {
        $backgroundStyle[] = 'background-color: ' . $background['color'];
    }

    $overlayOpacity = $background['overlay'] ?? null;
    $blocks = $section->blocks ?? collect();
@endphp

<section class="builder-section relative overflow-hidden {{ $padding }}" @if($backgroundStyle) style="{{ implode('; ', $backgroundStyle) }}" @endif>
    @if($section->backgroundMedia && $section->backgroundMedia->url)
        <div class="absolute inset-0">
            <img src="{{ $section->backgroundMedia->url }}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="absolute inset-0 bg-slate-900" style="opacity: {{ $overlayOpacity !== null ? $overlayOpacity : 0.25 }}"></div>
    @endif

    <div class="relative z-10 mx-auto flex max-w-6xl flex-col gap-8 px-6">
        @if($section->title || !empty($section->content['description']))
            <header class="space-y-2">
                @if($section->title)
                    <h2 class="text-3xl font-semibold text-slate-900">{{ $section->title }}</h2>
                @endif
                @if(!empty($section->content['description']))
                    <p class="text-lg text-slate-600">{{ $section->content['description'] }}</p>
                @endif
            </header>
        @endif

        <div class="flex flex-col gap-8">
            @forelse($blocks as $block)
                <x-page-builder.block :block="$block" />
            @empty
                <p class="text-sm text-slate-500">No blocks configured for this section yet.</p>
            @endforelse
        </div>
    </div>
</section>
