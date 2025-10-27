@extends('layouts.app')

@section('title', 'Home - LevelMinds')
@section('meta_title', 'LevelMinds - Skill-first hiring for Educational Institutions and teachers')
@section('meta_description', 'LevelMinds is a skill-first hiring platform connecting schools and teachers with transparent workflows and digital profiles.')
@section('meta_keywords', 'levelminds, teacher hiring, school recruitment, skill-first hiring platform')
@section('og_type', 'website')

@include('components.marketing.styles')

@section('content')
<div class="lm-marketing">
    <section class="lm-section lm-section--dark">
        <div class="container">
            <div class="lm-hero lm-hero-grid">
                <div class="lm-stack text-white">
                    <span class="lm-badge lm-badge--light">Skill-first hiring platform</span>
                    <h1>Hiring that celebrates great teaching.</h1>
                    <p class="lm-lead text-white-50">LevelMinds connects Educational Institutions &amp; Companies and educators through transparent pipelines, collaborative workflows, and digital profiles that highlight classroom impact.</p>
                    <div class="lm-hero-actions">
                        <a class="btn btn-primary" href="https://lmap.in/signup" target="_blank" rel="noopener">Sign Up as Educational Institute</a>
                        <a class="btn btn-outline-primary" href="https://lmap.in/signup" target="_blank" rel="noopener">Sign Up as Teacher</a>
                    </div>
                    <dl class="lm-metric-grid">
                        <div class="lm-metric">
                            <dt>Partner Educational Institutions</dt>
                            <dd>30+</dd>
                        </div>
                        <div class="lm-metric">
                            <dt>Teacher profiles</dt>
                            <dd>50+</dd>
                        </div>
                        <div class="lm-metric">
                            <dt>Interviews scheduled</dt>
                            <dd>10+</dd>
                        </div>
                    </dl>
                </div>
                <div class="lm-hero-media">
                    <div class="lm-hero-ring"></div>
                    <div class="lm-hero-slabs">
                        <article class="lm-hero-slab">
                            <span class="lm-badge">Teacher view</span>
                            <h3>Track every application</h3>
                            <p>Follow each stage from shortlist to offer with nudges, notes, and reminders.</p>
                        </article>
                        <article class="lm-hero-slab lm-hero-slab-dark">
                            <span class="lm-badge lm-badge--light">Educational Institutions dashboard</span>
                            <h3>Guide every hiring step</h3>
                            <p>Insights, reminders, and candidate notes stay together so Educational Institutions teams move quickly with clarity.</p>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted">
        <div class="container">
            <div class="lm-stack lm-center">
                <div class="lm-section__header lm-center">
                    <span class="lm-eyebrow">Why Educational Institutions and teachers choose us</span>
                    <h2>Every workflow matches the classroom reality</h2>
                    <p class="lm-lead">Built with Educational Institutions leaders and educators, LevelMinds organises hiring around skills, collaboration, and trust.</p>
                </div>
                <div class="lm-feature-grid">
                    <article class="lm-card">
                        <h3>Digital portfolios</h3>
                        <p>Showcase lesson plans, classroom videos, and certifications in a profile that travels with every application.</p>
                        <ul class="lm-list-check">
                            <li>Shareable profile link</li>
                            <li>Verified credentials</li>
                            <li>Rich media uploads</li>
                        </ul>
                    </article>
                    <article class="lm-card">
                        <h3>Educational Institutions &amp; teacher dashboards</h3>
                        <p>Give leadership teams and educators a focused dashboard with the stages, filters, and reminders they need to stay in sync.</p>
                        <ul class="lm-list-check">
                            <li>Role-ready pipelines</li>
                            <li>Progress tracking for teachers</li>
                            <li>Automated nudges and alerts</li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section">
        <div class="container">
            <div class="lm-split">
                <div class="lm-stack">
                    <span class="lm-eyebrow">How it works</span>
                    <h2>Dashboards that keep every hire on track</h2>
                    <p class="lm-lead">Launch a Company dashboard, connect teacher profiles, and follow each application with transparent updates.</p>
                    <a class="btn btn-primary btn-sm align-self-start" href="{{ url('/tour') }}">Explore the product tour</a>
                </div>
                <ol class="lm-list-steps">
                    <li>
                        <h3>Activate your Company dashboard</h3>
                        <p>Tailor hiring stages, focus areas, and intake forms so your pipeline mirrors the way your Company recruits.</p>
                    </li>
                    <li>
                        <h3>Share roles with teachers</h3>
                        <p>Invite educators to dedicated teacher dashboards where they can submit profiles and track their status.</p>
                    </li>
                    <li>
                        <h3>Review progress in real time</h3>
                        <p>Filter candidates, capture evidence, and collaborate on feedback without losing history or context.</p>
                    </li>
                    <li>
                        <h3>Hire with full visibility</h3>
                        <p>Send offers, trigger reminders, and keep every stakeholder aligned from shortlist to acceptance.</p>
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--light">
        <div class="container">
            <div class="lm-stack lm-center mb-5">
                <div class="lm-section__header lm-center">
                    <span class="lm-eyebrow">Product spotlight</span>
                    <h2>Dashboards built for Educational Institutions and teachers</h2>
                    <p class="lm-lead">See how LevelMinds keeps hiring data visible with dedicated views for leadership and educators.</p>
                </div>
            </div>
            <div class="lm-product-slider carousel slide" id="homeSpotlight" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @for ($i = 0; $i < 7; $i++)
                        <button type="button" data-bs-target="#homeSpotlight" data-bs-slide-to="{{ $i }}" @if($i === 0) class="active" aria-current="true" @endif aria-label="Slide {{ $i + 1 }}"></button>
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
                <button class="carousel-control-prev" type="button" data-bs-target="#homeSpotlight" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#homeSpotlight" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--dark">
        <div class="container">
            <div class="lm-split">
                <div class="lm-quote-card">
                    <span class="lm-badge lm-badge--light">Founder insight</span>
                    <blockquote>&ldquo;We designed LevelMinds so that every teacher knows where they stand and every Company can hire with confidence.&rdquo;</blockquote>
                    <cite>Varun Chamoli, Founder</cite>
                </div>
                <div class="lm-card lm-card--dark">
                    <h3>Built for the classroom</h3>
                    <p>We partner with forward-thinking Educational Institutions across India to co-create playbooks that highlight teaching excellence.</p>
                    <ul class="lm-list-check">
                        <li>Context-rich candidate profiles</li>
                        <li>Evidence-backed evaluations</li>
                        <li>Support from the LevelMinds team</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted">
        <div class="container">
            <div class="lm-cta-banner">
                <div class="lm-stack">
                    <h2>Ready to match great teachers with the right Educational Institutions?</h2>
                    <p class="lm-lead">Create your LevelMinds dashboard and start connecting teachers with the right Educational Institutions.</p>
                </div>
                <div class="lm-cta-actions">
                    <a class="btn btn-primary" href="{{ url('/contact') }}">Talk to our team</a>
                    <a class="btn btn-outline-primary" href="https://lmap.in/signup" target="_blank" rel="noopener">Sign Up</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
