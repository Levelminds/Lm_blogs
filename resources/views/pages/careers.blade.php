@extends('layouts.app')

@section('title', 'Careers - LevelMinds')
@section('meta_title', 'Careers - LevelMinds')
@section('meta_description', 'Join the LevelMinds campus ambassador program and help teachers discover new opportunities while gaining leadership experience.')
@section('meta_keywords', 'LevelMinds careers, campus ambassador program, education jobs')
@section('og_type', 'website')

@include('components.marketing.styles')

@section('content')
@php
    $careerBenefits = [
        ['title' => 'Hybrid-first collaboration', 'items' => ['Flexible schedules with async rituals', 'Quarterly in-person team weeks', 'Workspace stipend for remote setups']],
        ['title' => 'Grow with mentors', 'items' => ['Executive coaching budget', 'Access to education leaders network', 'Learning allowance for courses']],
        ['title' => 'Meaningful impact', 'items' => ['Shape equitable hiring journeys', 'Co-create with teachers and Educational Institutes', 'Build tools that celebrate classroom excellence']],
    ];

    $careerPillars = [
        ['title' => 'Mission obsessed', 'copy' => 'We prioritise transparent hiring outcomes for teachers and Educational Institutes in everything we ship.'],
        ['title' => 'Craft with empathy', 'copy' => 'We listen first, prototype fast, and make sure our decisions consider diverse classrooms.'],
        ['title' => 'Own the outcome', 'copy' => 'We celebrate autonomy, thoughtful experimentation, and accountability end to end.'],
    ];

    $jobOpenings = [
        [
            'title' => 'Growth Marketing Manager',
            'location' => 'Remote, India',
            'type' => 'Full-time',
            'summary' => 'Drive demand generation for Educational Institutes and teachers through campaigns, lifecycle journeys, and storytelling.',
            'responsibilities' => ['Build multi-channel campaigns that highlight LevelMinds success stories', 'Collaborate with product to craft launch narratives', 'Measure performance and optimise nurture programs'],
            'link' => 'mailto:support@levelminds.in?subject=Application%20-%20Growth%20Marketing%20Manager',
        ],
        [
            'title' => 'Product Designer',
            'location' => 'Delhi NCR / Remote',
            'type' => 'Full-time',
            'summary' => 'Design intuitive experiences for dashboards, scorecards, and communication tools that empower educators.',
            'responsibilities' => ['Lead research sessions with teachers and hiring teams', 'Prototype and ship end-to-end product flows', 'Advocate for accessibility and evidence-first storytelling'],
            'link' => 'mailto:support@levelminds.in?subject=Application%20-%20Product%20Designer',
        ],
    ];
@endphp

<div class="lm-marketing">
    <section class="lm-section" aria-labelledby="careersHeroTitle">
        <div class="container">
            <div class="lm-split">
                <div class="lm-stack">
                    <span class="lm-badge">Careers at LevelMinds</span>
                    <h1 id="careersHeroTitle">Join a mission-first team building equitable hiring</h1>
                    <p class="lm-lead">We combine product craft, hiring expertise, and community partnerships to help teachers and Educational Institutes find the perfect match.</p>
                    <div class="lm-hero-actions" role="group" aria-label="Career actions">
                        <a class="btn btn-primary" href="#open-roles">View open roles</a>
                        <a class="btn btn-outline-primary" href="{{ url('/contact') }}">Talk to our team</a>
                    </div>
                </div>
                <div class="lm-product-frame">
                    <img src="https://levelminds.in/assets/img/careers1.png" alt="LevelMinds team collaborating in a modern workspace">
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--light" aria-labelledby="careersBenefitsTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Why LevelMinds</span>
                <h2 id="careersBenefitsTitle">Benefits designed for impact</h2>
                <p class="lm-lead">We invest in growth, wellbeing, and community so you can do your best work supporting educators.</p>
            </div>
            <div class="lm-grid lm-grid-3">
                @foreach ($careerBenefits as $benefit)
                    <article class="lm-card">
                        <h3>{{ $benefit['title'] }}</h3>
                        <ul class="lm-list-check">
                            @foreach ($benefit['items'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lm-section" aria-labelledby="careersPillarsTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">How we work</span>
                <h2 id="careersPillarsTitle">Our hiring pillars</h2>
                <p class="lm-lead">We look for team members who share our commitment to transparency, empathy, and action.</p>
            </div>
            <div class="lm-grid lm-grid-3">
                @foreach ($careerPillars as $pillar)
                    <article class="lm-value-card">
                        <div class="lm-icon-circle" aria-hidden="true">{{ $loop->iteration }}</div>
                        <h3>{{ $pillar['title'] }}</h3>
                        <p>{{ $pillar['copy'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lm-section" id="open-roles" aria-labelledby="careersRolesTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Open roles</span>
                <h2 id="careersRolesTitle">Current opportunities</h2>
                <p class="lm-lead">Explore roles across product, operations, and community. Don&rsquo;t see what you&rsquo;re looking for? Reach out anyway!</p>
            </div>
            @if (empty($jobOpenings))
                <div class="lm-job-empty">
                    <p class="mb-1">We don&rsquo;t have open roles right now.</p>
                    <p class="mb-0">Leave your details at <a href="mailto:support@levelminds.in">support@levelminds.in</a> and we&rsquo;ll reach out when the next opportunity opens.</p>
                </div>
            @else
                <div class="lm-grid lm-grid-2 lm-job-list">
                    @foreach ($jobOpenings as $job)
                        <details class="lm-job-card">
                            <summary>
                                <div>
                                    <h3 class="mb-1">{{ $job['title'] }}</h3>
                                    <div class="lm-job-meta">
                                        <span class="lm-tag">{{ $job['type'] }}</span>
                                        <span class="lm-tag">{{ $job['location'] }}</span>
                                    </div>
                                </div>
                                <span aria-hidden="true">+</span>
                            </summary>
                            <div class="lm-job-card-content">
                                <p>{{ $job['summary'] }}</p>
                                <strong>Responsibilities</strong>
                                <ul class="lm-list-check">
                                    @foreach ($job['responsibilities'] as $responsibility)
                                        <li>{{ $responsibility }}</li>
                                    @endforeach
                                </ul>
                                <a class="btn btn-primary btn-sm align-self-start" href="{{ $job['link'] }}">Apply via email</a>
                            </div>
                        </details>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="lm-section lm-section--muted" id="apply" aria-labelledby="careersApplyTitle">
        <div class="container">
            <div class="lm-contact-panels">
                <div class="lm-card lm-card--raised">
                    <span class="lm-eyebrow">Campus ambassador snapshot</span>
                    <h2 id="careersApplyTitle">Champion LevelMinds on your campus</h2>
                    <p class="lm-lead">Help teachers discover opportunities while gaining leadership experience and building a network across Educational Institutes.</p>
                    <ul class="lm-list-check">
                        <li>Applications reviewed weekly</li>
                        <li>Support from the LevelMinds team</li>
                        <li>Opportunities to co-host future programs</li>
                    </ul>
                </div>
                <div class="lm-card">
                    <form method="post" action="#" class="lm-form" onsubmit="return false;" aria-label="Campus ambassador application form">
                        <input type="hidden" name="lm_career" value="1" />
                        <div class="lm-field-group two">
                            <div class="lm-field">
                                <label for="fullname">Full Name *</label>
                                <input id="fullname" name="fullname" type="text" required aria-required="true">
                            </div>
                            <div class="lm-field">
                                <label for="email">Email *</label>
                                <input id="email" name="email" type="email" required aria-required="true">
                            </div>
                        </div>
                        <div class="lm-field-group two">
                            <div class="lm-field">
                                <label for="phone">Phone / WhatsApp</label>
                                <input id="phone" name="phone" type="text">
                            </div>
                            <div class="lm-field">
                                <label for="college">College / University *</label>
                                <input id="college" name="college" type="text" required aria-required="true">
                            </div>
                        </div>
                        <div class="lm-field">
                            <label for="linkedin">LinkedIn Profile</label>
                            <input id="linkedin" name="linkedin" type="url" placeholder="https://linkedin.com/in/you">
                        </div>
                        <div class="lm-field">
                            <label for="plan">How will you help teachers find opportunities?</label>
                            <textarea id="plan" name="plan" rows="5" placeholder="Share your plan, student communities, or past experience"></textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit application</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
