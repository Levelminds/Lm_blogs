@extends('layouts.app')

@section('title', 'Home - LevelMinds')
@section('meta_title', 'LevelMinds | Skill-first hiring for educators')
@section('meta_description', 'LevelMinds helps schools discover, evaluate, and hire outstanding teachers through a transparent, skill-first platform.')
@section('meta_keywords', 'education hiring, teacher recruitment, levelminds platform')
@section('og_type', 'website')

@section('content')
<section class="text-center py-20">
  <h1 class="text-5xl font-bold text-blue-600 mb-6">Hiring that Celebrates Great Teaching</h1>
  <p class="text-lg text-gray-600 max-w-2xl mx-auto">
    LevelMinds connects schools and educators through transparent pipelines and collaborative workflows.
  </p>
  <a href="/tour" class="mt-8 inline-block bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">
    Explore the Platform
  </a>
</section>
@endsection
