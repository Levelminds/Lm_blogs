@extends('layouts.app')

@section('title', 'Team - LevelMinds')
@section('meta_title', 'Team - LevelMinds')
@section('meta_description', 'Meet the LevelMinds leadership team building transparent, skill-first hiring journeys for educators and Educational Institutions.')
@section('meta_keywords', 'LevelMinds team, leadership, founders, advisors')
@section('og_type', 'website')

@include('components.marketing.styles')

@section('content')
<div class="lm-marketing">
    <section class="lm-section lm-section--dark">
        <div class="container">
            <div class="lm-stack">
                <span class="lm-badge lm-badge--light">Team</span>
                <h1>Meet the minds building LevelMinds</h1>
                <p class="lm-lead lm-surface-note">Based in Delhi, we are educators, operators, and technologists shaping transparent hiring journeys that honour great teaching.</p>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--light">
        <div class="container">
            <div class="lm-split align-items-start">
                <div class="lm-stack text-start">
                    <span class="lm-eyebrow">Our story</span>
                    <h2>We started with a classroom problem</h2>
                    <p class="lm-lead">LevelMinds began when Company leaders and teachers told us that hiring felt complicated and opaque. We built a system that keeps context, trust, and collaboration at the centre of every step.</p>
                </div>
                <div class="lm-timeline text-start">
                    <div class="lm-timeline-item" data-year="2024">
                        <h3>Idea sparks in Delhi</h3>
                        <p>Varun Chamoli and Amrit Raj Verma partnered with educators to map the hiring frustrations they faced across Educational Institutes.</p>
                    </div>
                    <div class="lm-timeline-item" data-year="2024">
                        <h3>Co-designing the journey</h3>
                        <p>Together they shadowed Company administrators and teachers, defining a transparent workflow that keeps both sides aligned.</p>
                    </div>
                    <div class="lm-timeline-item" data-year="2025">
                        <h3>Product leadership joins</h3>
                        <p>Rahul Sharma led the engineering roadmap, turning playbooks into a secure, collaborative platform for hiring teams.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Leadership</span>
                <h2>The people growing LevelMinds</h2>
                <p class="lm-lead">We blend Companies leadership, technology, and experience design to help every teacher find the right classroom.</p>
            </div>
            <div class="lm-team-grid">
                <article class="lm-team-card">
                    <img src="https://levelminds.in/assets/img/varun.jpeg" alt="Varun Chamoli, Founder and CEO">
                    <div class="lm-team-card-body">
                        <span class="lm-team-role">Founder &amp; Chief Executive Officer</span>
                        <h3>Varun Chamoli</h3>
                        <p>Varun sets the strategic direction for LevelMinds, partnering with Educational Institutes and investors to scale a hiring platform built for impact.</p>
                        <a class="btn btn-outline-primary btn-sm" href="https://www.linkedin.com/in/varun-chamoli-429518ba/" target="_blank" rel="noopener">LinkedIn</a>
                    </div>
                </article>
                <article class="lm-team-card">
                    <img src="https://levelminds.in/assets/img/amrit.jpeg" alt="Amrit Raj Verma, Co-founder and COO">
                    <div class="lm-team-card-body">
                        <span class="lm-team-role">Co-founder &amp; Chief Operating Officer</span>
                        <h3>Amrit Raj Verma</h3>
                        <p>Amrit designs the operating playbooks that keep Educational Institutes and teachers in sync, leading delivery, customer success, and partnerships.</p>
                        <a class="btn btn-outline-primary btn-sm" href="https://www.linkedin.com/in/amrit-verma-a3777b202/" target="_blank" rel="noopener">LinkedIn</a>
                    </div>
                </article>
                <article class="lm-team-card">
                    <img src="https://levelminds.in/assets/img/rahul.jpeg" alt="Rahul Sharma, Chief Technology Officer">
                    <div class="lm-team-card-body">
                        <span class="lm-team-role">Chief Technology Officer</span>
                        <h3>Rahul Sharma</h3>
                        <p>Rahul leads engineering and product, architecting secure, scalable systems and AI-assisted workflows for the LevelMinds platform.</p>
                        <a class="btn btn-outline-primary btn-sm" href="https://www.linkedin.com/in/knownfreak/" target="_blank" rel="noopener">LinkedIn</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted">
        <div class="container">
            <div class="lm-cta-banner">
                <div class="lm-stack">
                    <h2>Work with the team shaping skill-first hiring</h2>
                    <p class="lm-lead">Whether you are a Educational Institute leader or an educator, we would love to co-create the next chapter of LevelMinds with you.</p>
                </div>
                <div class="lm-cta-actions">
                    <a class="btn btn-primary" href="{{ url('/contact') }}">Start a conversation</a>
                    <a class="btn btn-outline-primary" href="{{ url('/careers') }}">Join our programs</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
