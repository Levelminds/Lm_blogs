@extends('layouts.app')

@section('title', 'Careers - LevelMinds')
@section('meta_title', 'Careers - LevelMinds')
@section('meta_description', 'Join the LevelMinds campus ambassador program and help teachers discover new opportunities while gaining leadership experience.')
@section('meta_keywords', 'LevelMinds careers, campus ambassador program, education jobs')
@section('og_type', 'website')

@include('components.marketing.styles')

@section('content')
<div class="lm-marketing">
    <section class="lm-section">
        <div class="container">
            <div class="lm-split">
                <div class="lm-stack">
                    <span class="lm-badge">Campus ambassador program</span>
                    <h1>Bring LevelMinds to your campus</h1>
                    <p class="lm-lead">Help teachers discover new opportunities while gaining leadership experience and building a network across Educational Institutes.</p>
                    <div class="lm-hero-actions">
                        <a class="btn btn-primary" href="#apply">Apply now</a>
                        <a class="btn btn-outline-primary" href="{{ url('/contact') }}">Talk to our team</a>
                    </div>
                </div>
                <div class="lm-product-frame">
                    <img src="https://levelminds.in/assets/img/careers1.png" alt="LevelMinds ambassadors collaborating in a modern workspace">
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--light">
        <div class="container">
            <div class="lm-feature-grid">
                <article class="lm-card">
                    <h3>What you will do</h3>
                    <ul class="lm-list-check">
                        <li>Host micro sessions, webinars, and meetups on campus</li>
                        <li>Identify teachers and alumni exploring new Companies roles</li>
                        <li>Share LevelMinds updates across student communities</li>
                    </ul>
                </article>
                <article class="lm-card">
                    <h3>Why it matters</h3>
                    <ul class="lm-list-check">
                        <li>Shape how teachers find verified Companies opportunities</li>
                        <li>Earn leadership certificates and LevelMinds merch</li>
                        <li>Join product workshops with our founding team</li>
                    </ul>
                </article>
                <article class="lm-card">
                    <h3>Perks you will love</h3>
                    <ul class="lm-list-check">
                        <li>Letter of recommendation on completion</li>
                        <li>Priority access to internships and events</li>
                        <li>Monthly recognition for standout ambassadors</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section class="lm-section" id="apply">
        <div class="container">
            <div class="lm-contact-panels">
                <div class="lm-card lm-card--raised">
                    <span class="lm-eyebrow">Application snapshot</span>
                    <h2>Apply to become a campus ambassador</h2>
                    <p class="lm-lead">Tell us about your campus, communities, and how you plan to support teachers. Our ambassador success team reviews every application and reaches out with next steps.</p>
                    <ul class="lm-list-check">
                        <li>Applications reviewed weekly</li>
                        <li>Support from the LevelMinds team</li>
                        <li>Opportunities to co-host future programs</li>
                    </ul>
                </div>
                <div class="lm-card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <p class="mb-1 fw-semibold">Please fix the following:</p>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('careers.submit') }}" class="lm-form">
                        @csrf
                        <div class="lm-field-group two">
                            <div class="lm-field">
                                <label for="career-fullname">Full Name *</label>
                                <input id="career-fullname" name="fullname" type="text" value="{{ old('fullname') }}" required>
                                @error('fullname')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="lm-field">
                                <label for="career-email">Email *</label>
                                <input id="career-email" name="email" type="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="lm-field-group two">
                            <div class="lm-field">
                                <label for="career-phone">Phone / WhatsApp</label>
                                <input id="career-phone" name="phone" type="text" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="lm-field">
                                <label for="career-college">College / University *</label>
                                <input id="career-college" name="college" type="text" value="{{ old('college') }}" required>
                                @error('college')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="lm-field">
                            <label for="career-linkedin">LinkedIn Profile</label>
                            <input id="career-linkedin" name="linkedin" type="url" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/in/you">
                            @error('linkedin')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="lm-field">
                            <label for="career-plan">How will you help teachers find opportunities?</label>
                            <textarea id="career-plan" name="plan" rows="5" placeholder="Share your plan, student communities, or past experience">{{ old('plan') }}</textarea>
                            @error('plan')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Submit application</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
