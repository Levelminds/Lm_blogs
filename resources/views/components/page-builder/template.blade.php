@props(['template'])

@php
    $sections = $template?->sections ?? collect();
@endphp

@if($sections->isNotEmpty())
    <div class="builder-template">
        @foreach($sections as $section)
            <x-page-builder.section :section="$section" />
        @endforeach
    </div>
@endif
