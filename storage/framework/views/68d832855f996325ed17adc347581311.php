<?php $__env->startSection('title', 'Careers - LevelMinds'); ?>
<?php $__env->startSection('meta_title', 'Careers - LevelMinds'); ?>
<?php $__env->startSection('meta_description', 'Join the LevelMinds campus ambassador program and help teachers discover new opportunities while gaining leadership experience.'); ?>
<?php $__env->startSection('meta_keywords', 'LevelMinds careers, campus ambassador program, education jobs'); ?>
<?php $__env->startSection('og_type', 'website'); ?>

<?php echo $__env->make('components.marketing.styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
<?php
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

?>

<div class="lm-marketing">
    <section class="lm-section" aria-labelledby="careersHeroTitle">
        <div class="container">
            <div class="lm-split">
                <div class="lm-stack">
                    <span class="lm-badge">Careers at LevelMinds</span>
                    <h1 id="careersHeroTitle">Join a mission-first team building equitable hiring</h1>
                    <p class="lm-lead">We combine product craft, hiring expertise, and community partnerships to help teachers and Educational Institutes find the perfect match.</p>
                    <div class="lm-hero-actions" role="group" aria-label="Career actions">
                        <a class="btn btn-primary" href="#apply">Apply now</a>
                        <a class="btn btn-outline-primary" href="<?php echo e(url('/contact')); ?>">Talk to our team</a>
                    </div>
                </div>
                <div class="lm-product-frame">
                    <img src="<?php echo e(asset('images/marketing/careers/careers-hero.jpg')); ?>" alt="LevelMinds team collaborating in a modern workspace">
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
                <?php $__currentLoopData = $careerBenefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="lm-card">
                        <h3><?php echo e($benefit['title']); ?></h3>
                        <ul class="lm-list-check">
                            <?php $__currentLoopData = $benefit['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($item); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php $__currentLoopData = $careerPillars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pillar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="lm-value-card">
                        <div class="lm-icon-circle" aria-hidden="true"><?php echo e($loop->iteration); ?></div>
                        <h3><?php echo e($pillar['title']); ?></h3>
                        <p><?php echo e($pillar['copy']); ?></p>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
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
                    <?php echo $__env->make('components.flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <form method="post" action="<?php echo e(route('careers.submit')); ?>" class="lm-form" aria-label="Campus ambassador application form">
                        <?php echo csrf_field(); ?>
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
                                <label for="career-phone">Phone / WhatsApp</label>
                                <input id="career-phone" name="phone" type="text" value="<?php echo e(old('phone')); ?>">
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="lm-field">
                                <label for="college">College / University *</label>
                                <input id="college" name="college" type="text" required aria-required="true">
                            </div>
                        </div>
                        <div class="lm-field">
                            <label for="career-linkedin">LinkedIn Profile</label>
                            <input id="career-linkedin" name="linkedin" type="url" value="<?php echo e(old('linkedin')); ?>" placeholder="https://linkedin.com/in/you">
                            <?php $__errorArgs = ['linkedin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="lm-field">
                            <label for="career-plan">How will you help teachers find opportunities?</label>
                            <textarea id="career-plan" name="plan" rows="5" placeholder="Share your plan, student communities, or past experience"><?php echo e(old('plan')); ?></textarea>
                            <?php $__errorArgs = ['plan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit application</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u420143207/domains/levelminds.in/public_html/resources/views/pages/careers.blade.php ENDPATH**/ ?>