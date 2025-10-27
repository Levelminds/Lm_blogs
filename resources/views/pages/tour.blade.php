@extends('layouts.app')

@section('title', 'Tour - LevelMinds')
@section('meta_title', 'Tour - LevelMinds')
@section('meta_description', 'Explore the LevelMinds platform that helps Educational Institutions and teachers move from application to offer without friction.')
@section('meta_keywords', 'LevelMinds tour, product walkthrough, hiring platform features')
@section('og_type', 'website')

@include('components.marketing.styles')

@section('content')
<div class="lm-marketing">
    <section class="lm-section">
        <div class="container">
            <div class="lm-stack lm-center">
                <span class="lm-badge">Product tour</span>
                <h1>See LevelMinds in action</h1>
                <p class="lm-lead">Walk through the spaces teachers and Educational Institutes teams share to move from application to offer without friction.</p>
                <div class="lm-hero-actions justify-content-center">
                    <a class="btn btn-primary" href="{{ url('/contact') }}">Request a live demo</a>
                    <a class="btn btn-outline-primary" href="{{ url('/') }}">Return to home</a>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--light">
        <div class="container">
            <div class="lm-split">
                <div class="lm-product-slider carousel slide" id="tourSpotlight" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @for ($i = 0; $i < 7; $i++)
                            <button type="button" data-bs-target="#tourSpotlight" data-bs-slide-to="{{ $i }}" @if($i === 0) class="active" aria-current="true" @endif aria-label="Slide {{ $i + 1 }}"></button>
                        @endfor
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://levelminds.in/assets/img/tour-1.jpg" class="d-block w-100" alt="Applicant pipeline dashboard overview">
                            <div class="lm-product-caption">Applicant pipeline: monitor every stage in one unified dashboard.</div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://levelminds.in/assets/img/tour-2.jpg" class="d-block w-100" alt="Teacher dashboard tracking applications">
                            <div class="lm-product-caption">Teacher dashboard: keep educators updated with real-time status changes.</div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://levelminds.in/assets/img/tour-3.jpg" class="d-block w-100" alt="Interview scheduling interface">
                            <div class="lm-product-caption">Scheduling: align interview panels and reminders without leaving LevelMinds.</div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://levelminds.in/assets/img/tour-4.jpg" class="d-block w-100" alt="Candidate profile with teaching evidence">
                            <div class="lm-product-caption">Candidate profile: review teaching evidence, lesson plans, and credentials.</div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://levelminds.in/assets/img/tour-5.jpg" class="d-block w-100" alt="Scorecard review and feedback screen">
                            <div class="lm-product-caption">Scorecards: capture rubric-aligned feedback from every panelist.</div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://levelminds.in/assets/img/tour-6.jpg" class="d-block w-100" alt="Hiring analytics snapshot">
                            <div class="lm-product-caption">Analytics: understand pipeline health and the sources bringing great teachers.</div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://levelminds.in/assets/img/tour-7.jpg" class="d-block w-100" alt="Team tasks and follow-up checklist">
                            <div class="lm-product-caption">Tasks: keep hiring teams aligned with task lists and follow-up nudges.</div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#tourSpotlight" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#tourSpotlight" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="lm-card lm-card--raised">
                    <span class="lm-eyebrow">Pipeline without the guesswork</span>
                    <h2>Everything you need to guide hiring decisions</h2>
                    <p class="lm-lead">Shortlist, interview, and hire with crisp visibility. Keep notes, documents, and chat in one shared workspace designed for educators.</p>
                    <ul class="lm-list-check">
                        <li>Configurable stages per role</li>
                        <li>Scorecards mapped to teaching skills</li>
                        <li>Team collaboration with activity logs</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted">
        <div class="container">
            <div class="lm-tab-group" data-lm-tabs>
                <div class="lm-section__header lm-center">
                    <span class="lm-eyebrow">Built for everyone involved</span>
                    <h2>Choose your journey</h2>
                    <p class="lm-lead">Switch between the Educational Institutes and Teacher flow to see how LevelMinds keeps both sides aligned.</p>
                </div>
                <div class="lm-tab-buttons" role="tablist">
                    <button type="button" class="lm-tab-button active" role="tab" aria-selected="true" data-tab="schools">For Educational Institutes</button>
                    <button type="button" class="lm-tab-button" role="tab" aria-selected="false" data-tab="teachers">For teachers</button>
                </div>
                <div class="lm-tab-panel active" id="tab-schools" role="tabpanel">
                    <ol class="lm-list-steps">
                        <li>
                            <h3>Launch your hiring workspace</h3>
                            <p>Invite your leadership team, import open roles, and define scorecards rooted in classroom impact.</p>
                        </li>
                        <li>
                            <h3>Review with real evidence</h3>
                            <p>Compare portfolios, lesson videos, and credentials side by side to shortlist candidates with confidence.</p>
                        </li>
                        <li>
                            <h3>Collaborate on interviews</h3>
                            <p>Assign panelists, schedule online or on-campus interviews, and capture structured feedback instantly.</p>
                        </li>
                        <li>
                            <h3>Close the loop</h3>
                            <p>Send offers, share outcomes, and move new hires into onboarding while keeping an audit trail.</p>
                        </li>
                    </ol>
                </div>
                <div class="lm-tab-panel" id="tab-teachers" role="tabpanel">
                    <ol class="lm-list-steps">
                        <li>
                            <h3>Create a standout profile</h3>
                            <p>Curate your teaching philosophy, classroom projects, and credentials in a sharable digital resume.</p>
                        </li>
                        <li>
                            <h3>Discover the right roles</h3>
                            <p>Filter by Educational Institutes type, subject, and preferred location while receiving recommendations aligned to your skills.</p>
                        </li>
                        <li>
                            <h3>Track every stage</h3>
                            <p>See where you stand across applications with automated updates, reminders, and next-step guidance.</p>
                        </li>
                        <li>
                            <h3>Connect directly with Educational Institutes</h3>
                            <p>Chat with hiring teams as soon as you are shortlisted and keep every conversation in one place.</p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted">
        <div class="container">
            <div class="lm-cta-banner">
                <div class="lm-stack">
                    <h2>See how LevelMinds fits your hiring workflow</h2>
                    <p class="lm-lead">Share your goals and we will tailor a walkthrough for your Educational Institutes or Teacher network.</p>
                </div>
                <div class="lm-cta-actions">
                    <a class="btn btn-primary" href="{{ url('/contact') }}">Book a demo</a>
                    <a class="btn btn-outline-primary" href="{{ url('/careers') }}">Join our ambassador program</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-lm-tabs]').forEach(function (group) {
            const buttons = group.querySelectorAll('.lm-tab-button');
            const panels = group.querySelectorAll('.lm-tab-panel');

            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const target = button.getAttribute('data-tab');
                    buttons.forEach(function (btn) {
                        btn.classList.toggle('active', btn === button);
                        btn.setAttribute('aria-selected', btn === button ? 'true' : 'false');
                    });
                    panels.forEach(function (panel) {
                        panel.classList.toggle('active', panel.id === 'tab-' + target);
                    });
                });
            });
        });
    });
</script>
@endpush
