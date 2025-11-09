<?php $__env->startSection('title', 'Team - LevelMinds'); ?>
<?php $__env->startSection('meta_title', 'Team - LevelMinds'); ?>
<?php $__env->startSection('meta_description', 'Meet the LevelMinds leadership team building transparent, skill-first hiring journeys for educators and Educational Institutions.'); ?>
<?php $__env->startSection('meta_keywords', 'LevelMinds team, leadership, founders, advisors'); ?>
<?php $__env->startSection('og_type', 'website'); ?>

<?php echo $__env->make('components.marketing.styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $timeline = [
        ['year' => '2024', 'title' => 'Idea sparks in Delhi', 'copy' => 'Varun Chamoli and Amrit Raj Verma mapped hiring frustrations with principals and teachers across Educational Institutes.'],
        ['year' => '2024', 'title' => 'Co-designing the journey', 'copy' => 'Shadowing administrators and educators, we shaped transparent workflows that keep both sides aligned.'],
        ['year' => '2025', 'title' => 'Product leadership joins', 'copy' => 'Rahul Sharma turned playbooks into a secure, collaborative platform for hiring teams.'],
    ];

    $leadership = [
        [
            'name' => 'Varun Chamoli',
            'role' => 'Founder &amp; Chief Executive Officer',
            'bio' => 'Varun sets the strategic direction for LevelMinds, partnering with Educational Institutes and investors to scale a hiring platform built for impact.',
            'image' => asset('images/marketing/team/varun.jpeg'),
            'link' => 'https://www.linkedin.com/in/varun-chamoli-429518ba/',
        ],
        [
            'name' => 'Amrit Raj Verma',
            'role' => 'Co-founder &amp; Chief Operating Officer',
            'bio' => 'Amrit designs operating playbooks that keep Educational Institutes and teachers in sync, leading delivery, customer success, and partnerships.',
            'image' => asset('images/marketing/team/amrit.jpeg'),
            'link' => 'https://www.linkedin.com/in/amrit-verma-a3777b202/',
        ],
        [
            'name' => 'Rahul Sharma',
            'role' => 'Chief Technology Officer',
            'bio' => 'Rahul leads engineering and product, architecting secure, scalable systems and AI-assisted workflows for the LevelMinds platform.',
            'image' => asset('images/marketing/team/rahul.jpeg'),
            'link' => 'https://www.linkedin.com/in/knownfreak/',
        ],
    ];

    $values = [
        ['title' => 'Celebrate teachers', 'copy' => 'We amplify authentic classroom stories and create hiring journeys that honour educators.'],
        ['title' => 'Build with empathy', 'copy' => 'We co-create every feature with Educational Institutes and teachers, ensuring clarity and trust.'],
        ['title' => 'Move with integrity', 'copy' => 'We champion transparent communication, equitable evaluation, and data stewardship.'],
        ['title' => 'Learn in public', 'copy' => 'We measure impact, share learnings with our community, and adapt quickly together.'],
    ];
?>

<div class="lm-marketing">
    <section class="lm-section lm-section--dark" aria-labelledby="teamHeroTitle">
        <div class="container">
            <div class="lm-hero">
                <div class="lm-stack">
                    <span class="lm-badge lm-badge--light">Team</span>
                    <h1 id="teamHeroTitle">Meet the minds building LevelMinds</h1>
                    <p class="lm-lead lm-surface-note">Based in Delhi, we are educators, operators, and technologists shaping transparent hiring journeys that honour great teaching.</p>
                    <div class="lm-hero-actions" role="group" aria-label="Team actions">
                        <a class="btn btn-primary" href="<?php echo e(url('/careers')); ?>">Explore careers</a>
                        <a class="btn btn-outline-light" href="<?php echo e(url('/contact')); ?>">Partner with us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--light" aria-labelledby="teamStoryTitle">
        <div class="container">
            <div class="lm-media-block lm-media-block--align-start">
                <div class="lm-stack">
                    <span class="lm-eyebrow">Our story</span>
                    <h2 id="teamStoryTitle">We started with a classroom problem</h2>
                    <p class="lm-lead">LevelMinds began when Educational Institute leaders and teachers shared how opaque hiring slowed down great matches. We built a system that keeps context, trust, and collaboration at the centre of every step.</p>
                    <ul class="lm-list-check">
                        <li>Designing equitable evaluations with principals</li>
                        <li>Supporting teachers with transparent status updates</li>
                        <li>Helping hiring teams move quickly with clarity</li>
                    </ul>
                </div>
                <div class="lm-timeline" aria-label="LevelMinds milestones">
                    <?php $__currentLoopData = $timeline; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="lm-timeline-item">
                            <span class="lm-timeline-year"><?php echo e($item['year']); ?></span>
                            <div class="lm-timeline-body">
                                <h3><?php echo e($item['title']); ?></h3>
                                <p><?php echo e($item['copy']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section" aria-labelledby="teamLeadershipTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Leadership</span>
                <h2 id="teamLeadershipTitle">The people growing LevelMinds</h2>
                <p class="lm-lead">We blend Educational Institute leadership, technology, and experience design to help every teacher find the right classroom.</p>
            </div>
            <div class="lm-grid lm-grid-3" aria-label="Leadership profiles">
                <?php $__currentLoopData = $leadership; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="lm-profile-card">
                        <div class="lm-avatar" aria-hidden="true">
                            <img src="<?php echo e($person['image']); ?>" alt="Portrait of <?php echo e(strip_tags($person['name'])); ?>">
                        </div>
                        <div class="lm-profile-meta">
                            <span class="lm-team-role"><?php echo e($person['role']); ?></span>
                        </div>
                        <h3><?php echo e($person['name']); ?></h3>
                        <p><?php echo e($person['bio']); ?></p>
                        <a class="btn btn-outline-primary btn-sm align-self-start" href="<?php echo e($person['link']); ?>" target="_blank" rel="noopener">LinkedIn</a>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted" aria-labelledby="teamValuesTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Culture</span>
                <h2 id="teamValuesTitle">Values that guide our work</h2>
                <p class="lm-lead">We believe great classrooms start with empowered teachers, supportive Educational Institutes, and hiring journeys built on trust.</p>
            </div>
            <div class="lm-value-grid">
                <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="lm-value-card">
                        <div class="lm-icon-circle" aria-hidden="true"><?php echo e($loop->iteration); ?></div>
                        <h3><?php echo e($value['title']); ?></h3>
                        <p><?php echo e($value['copy']); ?></p>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted">
        <div class="container">
            <div class="lm-cta-banner">
                <div class="lm-stack">
                    <h2>Work with the team shaping skill-first hiring</h2>
                    <p class="lm-lead">Whether you are an Educational Institute leader or an educator, we would love to co-create the next chapter of LevelMinds with you.</p>
                </div>
                <div class="lm-cta-actions">
                    <a class="btn btn-primary" href="<?php echo e(url('/contact')); ?>">Start a conversation</a>
                    <a class="btn btn-outline-primary" href="<?php echo e(url('/careers')); ?>">Join our programs</a>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u420143207/domains/levelminds.in/public_html/resources/views/pages/team.blade.php ENDPATH**/ ?>