<?php $__env->startSection('title', 'Home - LevelMinds'); ?>
<?php $__env->startSection('meta_title', 'LevelMinds - Skill-first hiring for Educational Institutions and teachers'); ?>
<?php $__env->startSection('meta_description', 'LevelMinds is a skill-first hiring platform connecting schools and teachers with transparent workflows and digital profiles.'); ?>
<?php $__env->startSection('meta_keywords', 'levelminds, teacher hiring, school recruitment, skill-first hiring platform'); ?>
<?php $__env->startSection('og_type', 'website'); ?>

<?php echo $__env->make('components.marketing.styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $homeMetrics = [
        ['value' => '30+', 'label' => 'Partner Educational Institutions'],
        ['value' => '50+', 'label' => 'Verified teacher profiles'],
        ['value' => '10+', 'label' => 'Interviews scheduled each month'],
    ];

    $homeFeatures = [
        [
            'title' => 'Digital evidence portfolios',
            'description' => 'Showcase lesson plans, classroom walkthroughs, and certifications in a profile that travels with every application.',
            'bullets' => ['Shareable profile link', 'Verified credentials &amp; artefacts', 'Rich media uploads'],
        ],
        [
            'title' => 'Guided hiring workspaces',
            'description' => 'Give leadership teams and educators a focused dashboard with the stages, filters, and reminders they need to stay in sync.',
            'bullets' => ['Role-ready pipelines', 'Progress tracking for teachers', 'Automated nudges and alerts'],
        ],
        [
            'title' => 'Analytics that drive decisions',
            'description' => 'Understand pipeline health, equity metrics, and response times to keep every hire on track.',
            'bullets' => ['Time-to-hire insights', 'Source performance dashboards', 'Diversity and inclusion views'],
        ],
    ];

    $homeWorkflow = [
        ['title' => 'Activate your hiring hub', 'copy' => 'Set up scorecards, intake forms, and interview panels that mirror the way your Educational Institute recruits.'],
        ['title' => 'Invite teachers to apply', 'copy' => 'Share curated roles and allow educators to upload evidence-rich portfolios in minutes.'],
        ['title' => 'Collaborate on evaluations', 'copy' => 'Collect rubric-aligned feedback, compare notes, and keep an audit trail without spreadsheets.'],
        ['title' => 'Make confident offers', 'copy' => 'Trigger reminders, send offers, and capture acceptance with transparent communication.'],
    ];

    $homeTestimonials = [
        [
            'quote' => 'LevelMinds keeps every stakeholder aligned. We can see classroom evidence, schedule interviews, and move quickly with confidence.',
            'name' => 'Anita Sharma',
            'role' => 'Principal, Delhi Public School',
        ],
        [
            'quote' => 'As a teacher I always know what is next. The dashboard gives me clarity and the team celebrates my strengths.',
            'name' => 'Ritu Verma',
            'role' => 'Math Educator',
        ],
    ];

    $homeHighlights = [
        ['value' => '96%', 'label' => 'Educators report smoother interview coordination'],
        ['value' => '4.8/5', 'label' => 'Average satisfaction from leadership teams'],
        ['value' => '2x', 'label' => 'Faster shortlist-to-offer timeline'],
    ];
?>

<div class="lm-marketing">
    <section class="lm-section lm-section--dark" aria-labelledby="homeHeroTitle">
        <div class="container">
            <div class="lm-hero lm-hero-grid">
                <div class="lm-stack text-white">
                    <span class="lm-badge lm-badge--light">Skill-first hiring platform</span>
                    <h1 id="homeHeroTitle">Hiring that celebrates great teaching.</h1>
                    <p class="lm-lead text-white-50">LevelMinds connects Educational Institutes &amp; Companies and educators through transparent pipelines, collaborative workflows, and digital profiles that highlight classroom impact.</p>
                    <div class="lm-hero-actions" role="group" aria-label="Primary actions">
                        <a class="btn btn-primary" href="https://lmap.in/signup" target="_blank" rel="noopener">Sign up as Educational Institute</a>
                        <a class="btn btn-outline-primary" href="https://lmap.in/signup" target="_blank" rel="noopener">Sign up as teacher</a>
                        <a class="btn btn-outline-light" href="<?php echo e(url('/tour')); ?>">View product tour</a>
                    </div>
                    <div class="lm-hero-stats" role="list">
                        <?php $__currentLoopData = $homeMetrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="lm-hero-stat" role="listitem">
                                <strong><?php echo e($metric['value']); ?></strong>
                                <span><?php echo e($metric['label']); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="lm-hero-media">
                    <div class="lm-hero-ring" aria-hidden="true"></div>
                    <div class="lm-stack">
                        <article class="lm-hero-slab lm-hero-slab-dark" aria-label="Educational Institute dashboard highlight">
                            <span class="lm-badge lm-badge--light">Educational Institute dashboard</span>
                            <h3>Guide every hiring step</h3>
                            <p>Insights, reminders, and candidate notes stay together so leadership teams move quickly with clarity.</p>
                        </article>
                        <article class="lm-card bg-white text-dark" aria-label="Hero testimonial">
                            <span class="lm-badge lm-badge--light">In their words</span>
                            <blockquote class="mb-2 text-dark">&ldquo;LevelMinds brings visibility to every conversation and gives us the confidence to make the right hire.&rdquo;</blockquote>
                            <cite class="text-dark">Varun Chamoli, Founder</cite>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted" aria-labelledby="homeWhyTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Why Educational Institutes and teachers choose us</span>
                <h2 id="homeWhyTitle">Every workflow matches the classroom reality</h2>
                <p class="lm-lead">Built with Educational Institute leaders and educators, LevelMinds organises hiring around skills, collaboration, and trust.</p>
            </div>
            <div class="lm-grid lm-grid-3">
                <?php $__currentLoopData = $homeFeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="lm-card" aria-label="<?php echo e($feature['title']); ?>">
                        <div class="lm-icon-circle" aria-hidden="true"><?php echo e($loop->iteration); ?></div>
                        <h3><?php echo e($feature['title']); ?></h3>
                        <p><?php echo e($feature['description']); ?></p>
                        <ul class="lm-list-check">
                            <?php $__currentLoopData = $feature['bullets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bullet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($bullet); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="lm-section" aria-labelledby="homeWorkflowTitle">
        <div class="container">
            <div class="lm-media-block">
                <div class="lm-stack">
                    <span class="lm-eyebrow">How it works</span>
                    <h2 id="homeWorkflowTitle">Dashboards that keep every hire on track</h2>
                    <p class="lm-lead">Launch a shared workspace, connect teacher profiles, and follow each application with transparent updates.</p>
                    <div class="lm-step-grid" role="list">
                        <?php $__currentLoopData = $homeWorkflow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="lm-step-card" role="listitem">
                                <h3><?php echo e($step['title']); ?></h3>
                                <p><?php echo e($step['copy']); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="lm-hero-actions" role="group" aria-label="Workflow actions">
                        <a class="btn btn-primary" href="<?php echo e(url('/tour')); ?>">Explore the product tour</a>
                        <a class="btn btn-outline-primary" href="https://lmap.in/signup" target="_blank" rel="noopener">Create your account</a>
                    </div>
                </div>
                <figure>
                    <img src="<?php echo e(asset('images/marketing/tour/tour-3.jpg')); ?>" alt="Screenshot of the LevelMinds pipeline dashboard">
                    <figcaption class="visually-hidden">Pipeline dashboard showcasing hiring stages and candidate progress.</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--light" aria-labelledby="homeSpotlightTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Product spotlight</span>
                <h2 id="homeSpotlightTitle">Dashboards built for leadership and educators</h2>
                <p class="lm-lead">See how LevelMinds keeps hiring data visible with dedicated views for decision-makers and teachers.</p>
            </div>
            <div class="lm-product-slider carousel slide" id="homeSpotlight" data-bs-ride="carousel" aria-label="Platform screenshots">
                <div class="carousel-indicators">
                    <?php for($i = 0; $i < 7; $i++): ?>
                        <button type="button" data-bs-target="#homeSpotlight" data-bs-slide-to="<?php echo e($i); ?>" <?php if($i === 0): ?> class="active" aria-current="true" <?php endif; ?> aria-label="Slide <?php echo e($i + 1); ?>"></button>
                    <?php endfor; ?>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo e(asset('images/marketing/tour/tour-1.jpg')); ?>" class="d-block w-100" alt="Applicant pipeline dashboard overview">
                        <div class="lm-product-caption">Applicant pipeline: monitor every stage in one unified dashboard.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo e(asset('images/marketing/tour/tour-2.jpg')); ?>" class="d-block w-100" alt="Teacher dashboard tracking applications">
                        <div class="lm-product-caption">Teacher dashboard: keep educators updated with real-time status changes.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo e(asset('images/marketing/tour/tour-3.jpg')); ?>" class="d-block w-100" alt="Interview scheduling interface">
                        <div class="lm-product-caption">Scheduling: align interview panels and reminders without leaving LevelMinds.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo e(asset('images/marketing/tour/tour-4.jpg')); ?>" class="d-block w-100" alt="Candidate profile with teaching evidence">
                        <div class="lm-product-caption">Candidate profile: review teaching evidence, lesson plans, and credentials.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo e(asset('images/marketing/tour/tour-5.jpg')); ?>" class="d-block w-100" alt="Scorecard review and feedback screen">
                        <div class="lm-product-caption">Scorecards: capture rubric-aligned feedback from every panelist.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo e(asset('images/marketing/tour/tour-6.jpg')); ?>" class="d-block w-100" alt="Hiring analytics snapshot">
                        <div class="lm-product-caption">Analytics: understand pipeline health and the sources bringing great teachers.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo e(asset('images/marketing/tour/tour-7.jpg')); ?>" class="d-block w-100" alt="Team tasks and follow-up checklist">
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

    <section class="lm-section" aria-labelledby="homeTestimonialsTitle">
        <div class="container">
            <div class="lm-split">
                <div class="lm-stack">
                    <span class="lm-eyebrow">Proof in the classroom</span>
                    <h2 id="homeTestimonialsTitle">Communities growing with LevelMinds</h2>
                    <p class="lm-lead">Hiring teams and educators use LevelMinds to align on expectations, capture classroom impact, and reduce time-to-offer.</p>
                    <div class="lm-highlight-grid" role="list">
                        <?php $__currentLoopData = $homeHighlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="lm-highlight-card" role="listitem">
                                <strong><?php echo e($highlight['value']); ?></strong>
                                <span><?php echo e($highlight['label']); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="lm-testimonial-grid" aria-label="Testimonials">
                    <?php $__currentLoopData = $homeTestimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="lm-testimonial-card">
                            <blockquote>&ldquo;<?php echo e($testimonial['quote']); ?>&rdquo;</blockquote>
                            <cite><?php echo e($testimonial['name']); ?> &mdash; <?php echo e($testimonial['role']); ?></cite>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--dark" aria-labelledby="homeSupportTitle">
        <div class="container">
            <div class="lm-split">
                <div class="lm-quote-card">
                    <span class="lm-badge lm-badge--light">Founder insight</span>
                    <blockquote>&ldquo;We designed LevelMinds so that every teacher knows where they stand and every Educational Institute can hire with confidence.&rdquo;</blockquote>
                    <cite>Varun Chamoli, Founder</cite>
                </div>
                <div class="lm-card lm-card--dark">
                    <h3 id="homeSupportTitle">Built for the classroom</h3>
                    <p>We partner with forward-thinking Educational Institutes across India to co-create playbooks that highlight teaching excellence.</p>
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
                    <h2>Ready to match great teachers with the right Educational Institutes?</h2>
                    <p class="lm-lead">Create your LevelMinds dashboard and start connecting teachers with the right Educational Institutes.</p>
                </div>
                <div class="lm-cta-actions" role="group" aria-label="Final call to action">
                    <a class="btn btn-primary" href="<?php echo e(url('/contact')); ?>">Talk to our team</a>
                    <a class="btn btn-outline-primary" href="https://lmap.in/signup" target="_blank" rel="noopener">Sign up</a>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u420143207/domains/levelminds.in/public_html/resources/views/pages/home.blade.php ENDPATH**/ ?>