@extends('layouts.app')

@section('title', $blog->title . ' | LevelMinds Blog')
@php
    $computedDescription = $blog->meta_description
        ?? \Illuminate\Support\Str::limit(strip_tags($blog->excerpt ?: $blog->content), 160);
@endphp
@section('meta_title', $blog->meta_title ?? $blog->title)
@section('meta_description', $computedDescription)
@section('meta_keywords', $blog->meta_keywords)
@section('canonical_url', $blog->canonical_url ?? route('blog.show', $blog->slug))
@section('og_title', $blog->og_title ?? $blog->meta_title ?? $blog->title)
@section('og_description', $blog->og_description ?? $computedDescription)
@section('og_type', 'article')
@section('og_image', $blog->og_image_url ?? $blog->thumbnail_url ?? asset('images/branding/logo.svg'))
@push('meta')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('blog.show', $blog->slug),
            ],
            'headline' => $blog->meta_title ?? $blog->title,
            'description' => $computedDescription,
            'image' => array_filter([$blog->og_image_url ?? $blog->thumbnail_url ?? asset('images/branding/logo.svg')]),
            'datePublished' => optional($blog->published_at)->toIso8601String(),
            'dateModified' => optional($blog->updated_at)->toIso8601String(),
            'author' => [
                '@type' => 'Organization',
                'name' => config('app.name', 'LevelMinds'),
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name', 'LevelMinds'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/branding/logo.svg'),
                ],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@push('styles')
    <style>
        .article-hero {
            border-radius: 32px;
            background: var(--surface);
            box-shadow: 0 24px 48px rgba(17, 28, 77, 0.08);
            overflow: hidden;
        }
        .article-meta span {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            background-color: rgba(50, 72, 173, 0.1);
            color: var(--brand-700);
            font-weight: 600;
            border-radius: 999px;
            padding: 6px 14px;
            margin-right: 0.45rem;
        }
        .article-body {
            font-size: 1.05rem;
            line-height: 1.85;
            color: var(--neutral-900);
        }
        .article-body h2,
        .article-body h3 {
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        .insight-card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 12px 32px rgba(17, 28, 77, 0.08);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .insight-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(17, 28, 77, 0.12);
        }
        .subscribe-banner {
            background: linear-gradient(135deg, rgba(50, 72, 173, 0.95), rgba(63, 151, 213, 0.95));
            border-radius: 28px;
            padding: 3rem;
            color: #fff;
        }
        .subscribe-banner .form-check-input {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .subscribe-banner .form-check-input:checked {
            background-color: #fff;
            border-color: #fff;
        }
        .subscribe-banner .form-check-label {
            color: #fff;
            font-weight: 600;
        }
        .like-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 999px;
            border: 1px solid rgba(50, 72, 173, 0.35);
            color: var(--brand-700);
            text-decoration: none;
            background-color: rgba(50, 72, 173, 0.08);
        }
        .like-button:hover {
            background-color: rgba(50, 72, 173, 0.18);
            color: var(--brand-800);
        }
        .hero-media {
            position: relative;
            height: 100%;
        }
        .hero-media img,
        .hero-media video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .video-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: rgba(17, 28, 77, 0.85);
            color: #fff;
            border-radius: 999px;
            padding: 6px 14px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .video-icon-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: currentColor;
        }
        .video-player-wrapper {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(17, 28, 77, 0.12);
        }
        .video-player-wrapper iframe,
        .video-player-wrapper video {
            display: block;
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <section class="container py-5">
        <article class="article-hero mb-5">
            <div class="row g-0">
                <div class="col-lg-6 hero-media">
                    @if ($blog->thumbnail_url)
                        <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}">
                    @elseif ($blog->is_video && $blog->video_path)
                        <video src="{{ $blog->video_stream_url }}" muted playsinline loop></video>
                    @else
                        <img src="https://via.placeholder.com/900x600?text=LevelMinds+Blog" alt="{{ $blog->title }}">
                    @endif
                    @if ($blog->is_video)
                        <span class="video-badge">
                            <span class="video-icon-dot"></span> Video
                        </span>
                    @endif
                </div>
                <div class="col-lg-6 p-5 d-flex flex-column justify-content-center">
                    <span class="badge bg-light text-uppercase text-dark fw-semibold mb-3">
                        {{ $blog->category->name ?? 'General' }}
                    </span>
                    <h1 class="fw-bold display-6 mb-3">{{ $blog->title }}</h1>
                    <p class="text-muted mb-4">{{ $blog->excerpt }}</p>

                    <div class="article-meta mb-4">
                        <span>{{ optional($blog->published_at)->format('d M Y') }}</span>
                        <span>{{ $blog->reading_time }}</span>
                        <span>{{ number_format($blog->views) }} views</span>
                        <span>{{ number_format($blog->likes) }} likes</span>
                    </div>

                    <form action="{{ route('blog.like', $blog) }}" method="POST">
                        @csrf
                        <button type="submit" class="like-button border-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                 class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                            </svg>
                            Appreciate this article
                        </button>
                    </form>
                    @if(session('success'))
                        <div class="alert alert-success mt-3 mb-0">{{ session('success') }}</div>
                    @endif
                </div>
            </div>
        </article>

        @if($blog->is_video && ($blog->video_embed_url || $blog->video_path || $blog->video_stream_url))
            <div class="video-player-wrapper mb-5">
                @if($blog->video_embed_url && filter_var($blog->video_embed_url, FILTER_VALIDATE_URL))
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $blog->video_embed_url }}" title="Video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                @elseif($blog->video_stream_url)
                    <video controls preload="metadata" poster="{{ $blog->thumbnail_url }}">
                        <source src="{{ $blog->video_stream_url }}">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        @endif

        <section class="row justify-content-center">
            <div class="col-lg-10">
                <div class="article-body mb-5">
                    {!! $blog->content !!}
                </div>
            </div>
        </section>

        <section class="subscribe-banner mb-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-2">Get LevelMinds articles in your inbox</h2>
                    <p class="mb-0">The smartest insights for school leaders and educators, delivered weekly.</p>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('blog.subscribe') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-7">
                            <input type="email" name="email" class="form-control form-control-lg"
                                   placeholder="you@example.com" required>
                        </div>
                        <div class="col-md-5">
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($categories as $category)
                                    <div class="form-check text-white">
                                        <input class="form-check-input" type="checkbox" name="categories[]"
                                               value="{{ $category->id }}" id="cat-{{ $category->id }}">
                                        <label class="form-check-label" for="cat-{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-light text-primary fw-semibold px-4">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        @if($related->isNotEmpty())
            <section class="mb-5">
                <h3 class="fw-bold mb-4">You might also enjoy</h3>
                <div class="row g-4">
                    @foreach($related as $item)
                        <div class="col-md-6 col-xl-3">
                            <div class="card insight-card h-100">
                                <div class="position-relative">
                                    @if ($item->thumbnail_url)
                                        <img src="{{ $item->thumbnail_url }}" class="card-img-top" alt="{{ $item->title }}">
                                    @elseif ($item->is_video && $item->video_path)
                                        <video src="{{ $item->video_stream_url }}" muted playsinline loop class="w-100 rounded-top"></video>
                                    @else
                                        <img src="https://via.placeholder.com/480x320?text=LevelMinds" class="card-img-top" alt="{{ $item->title }}">
                                    @endif
                                    @if ($item->is_video)
                                        <span class="video-badge" style="top:12px;left:12px;">
                                            <span class="video-icon-dot"></span> Video
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <span class="badge rounded-pill text-bg-light text-uppercase fw-semibold mb-2">
                                        {{ $item->category->name ?? 'General' }}
                                    </span>
                                    <h5 class="card-title">
                                        <a href="{{ route('blog.show', $item->slug) }}" class="stretched-link text-decoration-none text-dark">
                                            {{ \Illuminate\Support\Str::limit($item->title, 60) }}
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-footer bg-white border-0 text-muted small">
                                    {{ optional($item->published_at)->format('d M Y') }} &middot; {{ $item->reading_time }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </section>
@endsection
