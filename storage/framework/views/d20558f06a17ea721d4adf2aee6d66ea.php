<?php $__env->startSection('title', 'Contact - LevelMinds'); ?>
<?php $__env->startSection('meta_title', 'Contact - LevelMinds'); ?>
<?php $__env->startSection('meta_description', 'Connect with LevelMinds to learn how we help Educational Institutions and teachers build transparent hiring journeys.'); ?>
<?php $__env->startSection('meta_keywords', 'LevelMinds contact, education hiring support, teacher recruitment help'); ?>
<?php $__env->startSection('og_type', 'website'); ?>

<?php echo $__env->make('components.marketing.styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $contactFaqs = [
        ['question' => 'How quickly does the LevelMinds team respond?', 'answer' => 'We reply to all messages within two business days. Urgent product questions can also be sent through the in-app chat for faster support.'],
        ['question' => 'Do you offer onboarding support for Educational Institutes?', 'answer' => 'Yes. Our team provides onboarding workshops, hiring playbooks, and administrator training for every new Educational Institute.'],
        ['question' => 'Can teachers request product walkthroughs?', 'answer' => 'Absolutely. We host weekly group demos and can schedule a 1:1 orientation for teachers preparing applications.'],
    ];

    $contactHighlights = [
        ['value' => '1:1', 'label' => 'Implementation partner for every Educational Institute'],
        ['value' => '150+', 'label' => 'Support conversations resolved each month'],
        ['value' => '4.9/5', 'label' => 'Average rating for our support experience'],
    ];
?>

<div class="lm-marketing">
    <section class="lm-section" aria-labelledby="contactHeroTitle">
        <div class="container">
            <div class="lm-stack lm-center">
                <span class="lm-badge">Contact</span>
                <h1 id="contactHeroTitle">We would love to hear from you</h1>
                <p class="lm-lead">Whether you are an Educational Institute, teacher, or partner, reach out and we will respond within two business days.</p>
            </div>
        </div>
    </section>

    <section class="lm-section" aria-labelledby="contactFormTitle">
        <div class="container">
            <div class="lm-contact-panels">
                <div class="lm-card">
                    <span class="lm-eyebrow">Send a message</span>
                    <h2 id="contactFormTitle">Tell us how we can help</h2>
                    <p class="lm-lead">Share as much context as possible so our team can tailor the next steps. Fields marked with * are required.</p>
                    <?php echo $__env->make('components.flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <form method="post" action="<?php echo e(route('contact.submit')); ?>" class="lm-form" aria-label="Contact form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="lm_contact" value="1" />
                        <div class="lm-field">
                            <label for="name">Full Name *</label>
                            <input id="name" name="name" type="text" required aria-required="true">
                        </div>
                        <div class="lm-field-group two">
                            <div class="lm-field">
                                <label for="email">Email *</label>
                                <input id="email" name="email" type="email" required aria-required="true" autocomplete="email">
                            </div>
                            <div class="lm-field">
                                <label for="contact-subject">Subject</label>
                                <input id="contact-subject" name="subject" type="text" value="<?php echo e(old('subject')); ?>" placeholder="General inquiry">
                                <?php $__errorArgs = ['subject'];
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
                        </div>
                        <div class="lm-field">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="6" required aria-required="true" placeholder="Share how we can support your hiring goals"></textarea>
                        </div>
                        <div class="lm-field-group two">
                            <div class="lm-field">
                                <label for="org">Educational Institute / Organisation</label>
                                <input id="org" name="organisation" type="text" placeholder="School, college, or company name">
                            </div>
                            <div class="lm-field">
                                <label for="phone">Phone</label>
                                <input id="phone" name="phone" type="tel" placeholder="Optional contact number">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Send message</button>
                    </form>
                </div>
                <aside class="lm-contact-side" aria-labelledby="contactInfoTitle">
                    <div class="lm-card">
                        <h3 id="contactInfoTitle">Reach us directly</h3>
                        <address class="mb-3 lm-stack">
                            <span>Delhi, India</span>
                            <a class="fw-semibold text-decoration-none text-reset" href="mailto:support@levelminds.in">support@levelminds.in</a>
                            <a class="d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none text-reset" href="tel:+917303835892">
                                <span class="lm-eyebrow">Phone</span>
                                <span>+91 73038 35892</span>
                            </a>
                            <span class="text-muted small">Support hours: 10 AM &ndash; 6 PM IST</span>
                        </address>
                    </div>
                    <div class="lm-card">
                        <h3>Program enquiries</h3>
                        <p>Interested in our campus ambassador program or collaborative pilots? Submit an application and our success team will reach out.</p>
                        <a class="btn btn-outline-primary btn-sm" href="<?php echo e(url('/careers')); ?>">Go to careers</a>
                    </div>
                    <div class="lm-card lm-card--outline">
                        <h3>Press and partnerships</h3>
                        <p>Write to <a href="mailto:support@levelminds.in">support@levelminds.in</a> for media, events, or collaboration opportunities.</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted" aria-labelledby="contactSocialProofTitle">
        <div class="container">
            <div class="lm-split">
                <div class="lm-stack">
                    <span class="lm-eyebrow">Support highlights</span>
                    <h2 id="contactSocialProofTitle">We stay close to every conversation</h2>
                    <p class="lm-lead">Our team provides personalised support, onboarding, and follow-up guidance so Educational Institutes and teachers feel confident using LevelMinds.</p>
                    <div class="lm-highlight-grid" role="list">
                        <?php $__currentLoopData = $contactHighlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="lm-highlight-card" role="listitem">
                                <strong><?php echo e($highlight['value']); ?></strong>
                                <span><?php echo e($highlight['label']); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="lm-testimonial-grid" aria-label="Testimonials about support">
                    <article class="lm-testimonial-card">
                        <blockquote>&ldquo;The LevelMinds team guided us through every step of onboarding and responded quickly whenever we needed clarity.&rdquo;</blockquote>
                        <cite>Shweta Kapoor &mdash; Academic Director</cite>
                    </article>
                    <article class="lm-testimonial-card">
                        <blockquote>&ldquo;Even as a first-time user, I felt confident navigating the dashboard. The support notes were detailed and friendly.&rdquo;</blockquote>
                        <cite>Rohit Jain &mdash; Science Educator</cite>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section" aria-labelledby="contactFaqTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">FAQs</span>
                <h2 id="contactFaqTitle">Answers to common questions</h2>
                <p class="lm-lead">Browse the questions below or reach out directly &mdash; we are always happy to help.</p>
            </div>
            <div class="lm-grid lm-grid-2">
                <?php $__currentLoopData = $contactFaqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <details class="lm-faq-item">
                        <summary><?php echo e($faq['question']); ?></summary>
                        <div class="lm-faq-content">
                            <p><?php echo e($faq['answer']); ?></p>
                        </div>
                    </details>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u420143207/domains/levelminds.in/public_html/resources/views/pages/contact.blade.php ENDPATH**/ ?>