@extends('layouts.app')

@section('title', 'Contact - LevelMinds')
@section('meta_title', 'Contact - LevelMinds')
@section('meta_description', 'Connect with LevelMinds to learn how we help Educational Institutions and teachers build transparent hiring journeys.')
@section('meta_keywords', 'LevelMinds contact, education hiring support, teacher recruitment help')
@section('og_type', 'website')

@include('components.marketing.styles')

@section('content')
<div class="lm-marketing">
    <section class="lm-section">
        <div class="container">
            <div class="lm-stack lm-center">
                <span class="lm-badge">Contact</span>
                <h1>We would love to hear from you</h1>
                <p class="lm-lead">Whether you are a Educational Institute, teacher, or partner, reach out and we will respond within two business days.</p>
            </div>
        </div>
    </section>

    <section class="lm-section">
        <div class="container">
            <div class="lm-contact-panels">
                <div class="lm-card">
                    <h2>Send us a message</h2>
                    <p class="lm-lead">Let us know how we can help. Share as much context as possible so our team can tailor the next steps.</p>
                    <form method="post" action="#" class="lm-form" onsubmit="return false;">
                        <input type="hidden" name="lm_contact" value="1" />
                        <div class="lm-field">
                            <label for="name">Full Name *</label>
                            <input id="name" name="name" type="text" required>
                        </div>
                        <div class="lm-field-group two">
                            <div class="lm-field">
                                <label for="email">Email *</label>
                                <input id="email" name="email" type="email" required>
                            </div>
                            <div class="lm-field">
                                <label for="subject">Subject</label>
                                <input id="subject" name="subject" type="text" placeholder="General inquiry">
                            </div>
                        </div>
                        <div class="lm-field">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="6" required placeholder="Share how we can support your hiring goals"></textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Send message</button>
                    </form>
                </div>
                <aside class="lm-contact-side">
                    <div class="lm-card">
                        <h3>Head office</h3>
                        <p>Delhi, India</p>
                        <ul class="lm-list-check">
                            <li>Email: <a href="mailto:support@levelminds.in">support@levelminds.in</a></li>
                            <li>Support hours: 10 AM - 6 PM IST</li>
                        </ul>
                    </div>
                    <div class="lm-card">
                        <h3>Campus ambassador</h3>
                        <p>Interested in our campus programs? Submit an application and our ambassador success team will reach out.</p>
                        <a class="btn btn-outline-primary btn-sm" href="{{ url('/careers') }}">Go to careers</a>
                    </div>
                    <div class="lm-card lm-card--outline">
                        <h3>Press and partnerships</h3>
                        <p>Write to <a href="mailto:support@levelminds.in">support@levelminds.in</a> for media, events, or collaboration opportunities.</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</div>
@endsection
