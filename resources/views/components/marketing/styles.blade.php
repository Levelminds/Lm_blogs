@once
    @push('styles')
        <style>
            .lm-marketing {
                --lm-brand-900: #182764;
                --lm-brand-800: #22317d;
                --lm-brand-700: #3248ad;
                --lm-brand-600: #3f97d5;
                --lm-brand-400: rgba(63, 151, 213, 0.18);
                --lm-neutral-950: #0b142d;
                --lm-neutral-900: #121c36;
                --lm-neutral-700: #2c3852;
                --lm-neutral-600: #445068;
                --lm-neutral-400: #818ca3;
                --lm-neutral-200: #d7deef;
                --lm-neutral-150: #e6ebf7;
                --lm-neutral-100: #f5f7fc;
                --lm-surface: #ffffff;
                --lm-radius-lg: 24px;
                --lm-radius-md: 16px;
                --lm-radius-sm: 12px;
                --lm-shadow-lg: 0 32px 80px -46px rgba(13, 20, 36, 0.35);
                --lm-shadow-md: 0 18px 48px -32px rgba(13, 20, 36, 0.28);
                --lm-shadow-sm: 0 10px 28px -18px rgba(13, 20, 36, 0.22);
                font-family: 'Manrope', 'Public Sans', 'Segoe UI', Tahoma, sans-serif;
                color: var(--lm-neutral-900);
            }

            .lm-marketing h1,
            .lm-marketing h2,
            .lm-marketing h3,
            .lm-marketing h4,
            .lm-marketing h5,
            .lm-marketing h6 {
                font-weight: 700;
                color: var(--lm-neutral-900);
            }

            .lm-marketing p {
                color: var(--lm-neutral-600);
                margin-bottom: 1rem;
            }

            .lm-section {
                padding: clamp(3.5rem, 8vw, 5.5rem) 0;
            }

            .lm-section--muted {
                background-color: var(--lm-neutral-100);
            }

            .lm-section--light {
                background-color: var(--lm-neutral-150);
            }

            .lm-section--dark {
                background: linear-gradient(135deg, var(--lm-brand-900), var(--lm-brand-700));
                color: #fff;
            }

            .lm-section--dark h2,
            .lm-section--dark h3,
            .lm-section--dark p,
            .lm-section--dark span,
            .lm-section--dark li,
            .lm-section--dark blockquote,
            .lm-section--dark cite {
                color: #fff;
            }

            .lm-stack {
                display: grid;
                gap: clamp(1.5rem, 4vw, 2.75rem);
            }

            .lm-section__header {
                display: grid;
                gap: 0.8rem;
                margin-bottom: clamp(2rem, 5vw, 3rem);
            }

            .lm-section__header.lm-center {
                text-align: center;
                justify-items: center;
            }

            .lm-center {
                text-align: center;
            }

            .lm-lead {
                font-size: 1.05rem;
                color: var(--lm-neutral-600);
                max-width: 62ch;
            }

            .lm-badge,
            .lm-eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
                font-size: 0.78rem;
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--lm-brand-700);
            }

            .lm-badge {
                background: var(--lm-brand-400);
                padding: 0.4rem 0.85rem;
                border-radius: 999px;
                color: var(--lm-brand-700);
            }

            .lm-badge--light {
                background: rgba(255, 255, 255, 0.28);
                color: #fff;
            }

            .lm-eyebrow {
                color: var(--lm-brand-600);
            }

            .lm-hero {
                display: grid;
                gap: clamp(2rem, 5vw, 3rem);
            }

            @media (min-width: 992px) {
                .lm-hero.lm-hero-grid {
                    grid-template-columns: minmax(0, 1fr) minmax(0, 0.95fr);
                    align-items: center;
                }
            }

            .lm-hero-actions,
            .lm-cta-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
            }

            .lm-metric-grid {
                display: grid;
                gap: 1rem;
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                margin-top: 2.5rem;
            }

            .lm-metric {
                background: rgba(255, 255, 255, 0.12);
                border: 1px solid rgba(255, 255, 255, 0.18);
                border-radius: var(--lm-radius-md);
                padding: 1.25rem 1.5rem;
                backdrop-filter: blur(6px);
                color: #fff;
            }

            .lm-metric dt {
                font-size: 0.85rem;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                margin-bottom: 0.5rem;
                color: rgba(255, 255, 255, 0.8);
            }

            .lm-metric dd {
                font-size: 1.9rem;
                font-weight: 700;
                margin: 0;
                color: #fff;
            }

            .lm-card {
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                padding: 2rem;
                box-shadow: var(--lm-shadow-sm);
                height: 100%;
            }

            .lm-card--dark {
                background: rgba(255, 255, 255, 0.08);
                border: 1px solid rgba(255, 255, 255, 0.18);
                color: #fff;
                box-shadow: none;
            }

            .lm-card--outline {
                border: 1px solid var(--lm-neutral-200);
                box-shadow: none;
            }

            .lm-card--raised {
                box-shadow: var(--lm-shadow-lg);
            }

            .lm-feature-grid,
            .lm-team-grid {
                display: grid;
                gap: 1.75rem;
            }

            @media (min-width: 992px) {
                .lm-feature-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
                .lm-team-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }

            .lm-team-card {
                display: grid;
                gap: 1.25rem;
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                overflow: hidden;
                box-shadow: var(--lm-shadow-sm);
                height: 100%;
            }

            .lm-team-card img {
                width: 100%;
                height: 280px;
                object-fit: cover;
            }

            .lm-team-card-body {
                padding: 1.5rem;
                display: grid;
                gap: 0.75rem;
            }

            .lm-team-role {
                font-size: 0.85rem;
                font-weight: 600;
                letter-spacing: 0.04em;
                text-transform: uppercase;
                color: var(--lm-brand-600);
            }

            .lm-list-check {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                gap: 0.65rem;
            }

            .lm-list-check li {
                display: flex;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .lm-list-check li::before {
                content: '✔';
                color: var(--lm-brand-600);
                font-weight: 700;
                line-height: 1.2;
                flex-shrink: 0;
            }

            .lm-list-steps {
                list-style: none;
                padding: 0;
                margin: 0;
                counter-reset: step;
                display: grid;
                gap: 1.75rem;
            }

            .lm-list-steps li {
                counter-increment: step;
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                padding: 1.5rem;
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-list-steps li::before {
                content: counter(step, decimal-leading-zero);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 2.25rem;
                height: 2.25rem;
                margin-bottom: 0.75rem;
                border-radius: 999px;
                background: var(--lm-brand-700);
                color: #fff;
                font-weight: 700;
                font-size: 0.95rem;
            }

            .lm-split {
                display: grid;
                gap: 2.5rem;
            }

            @media (min-width: 992px) {
                .lm-split {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    align-items: center;
                }
            }

            .lm-product-slider {
                position: relative;
                overflow: hidden;
                border-radius: var(--lm-radius-md);
                box-shadow: var(--lm-shadow-lg);
            }

            .lm-product-slider .carousel-inner {
                border-radius: inherit;
            }

            .lm-product-caption {
                background: rgba(17, 28, 77, 0.72);
                color: #fff;
                padding: 1rem 1.25rem;
                font-size: 0.95rem;
            }

            .lm-product-slider .carousel-indicators [data-bs-target] {
                background-color: rgba(255, 255, 255, 0.65);
            }

            .lm-product-slider .carousel-indicators .active {
                background-color: #fff;
            }

            .lm-quote-card {
                background: rgba(255, 255, 255, 0.12);
                border-radius: var(--lm-radius-md);
                padding: 2.25rem;
                color: #fff;
                box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.22);
            }

            .lm-quote-card blockquote {
                font-size: 1.4rem;
                font-weight: 600;
                margin-bottom: 1.25rem;
            }

            .lm-timeline {
                display: grid;
                gap: 1.5rem;
            }

            .lm-timeline-item {
                position: relative;
                padding-left: 2.75rem;
            }

            .lm-timeline-item::before {
                content: '';
                position: absolute;
                left: 1rem;
                top: 0.4rem;
                bottom: 0.4rem;
                width: 2px;
                background: var(--lm-neutral-200);
            }

            .lm-timeline-item::after {
                content: attr(data-year);
                position: absolute;
                left: 0;
                top: 0;
                background: var(--lm-brand-700);
                color: #fff;
                font-weight: 700;
                font-size: 0.85rem;
                padding: 0.35rem 0.75rem;
                border-radius: 999px;
                transform: translateY(-40%);
            }

            .lm-cta-banner {
                display: grid;
                gap: 1.5rem;
                background: var(--lm-surface);
                border-radius: var(--lm-radius-lg);
                padding: clamp(2rem, 4vw, 3rem);
                align-items: center;
                box-shadow: var(--lm-shadow-md);
            }

            @media (min-width: 992px) {
                .lm-cta-banner {
                    grid-template-columns: minmax(0, 1.75fr) minmax(0, 1fr);
                }
            }

            .lm-tab-group {
                display: grid;
                gap: 2.5rem;
            }

            .lm-tab-buttons {
                display: inline-flex;
                background: var(--lm-surface);
                border-radius: 999px;
                padding: 0.35rem;
                box-shadow: var(--lm-shadow-sm);
                gap: 0.35rem;
                justify-self: center;
            }

            .lm-tab-button {
                border: none;
                background: transparent;
                padding: 0.65rem 1.4rem;
                border-radius: 999px;
                font-weight: 600;
                color: var(--lm-neutral-600);
                cursor: pointer;
                transition: all 0.25s ease;
            }

            .lm-tab-button.active {
                background: var(--lm-brand-700);
                color: #fff;
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-tab-panel {
                display: none;
            }

            .lm-tab-panel.active {
                display: block;
            }

            .lm-product-frame {
                border-radius: var(--lm-radius-lg);
                overflow: hidden;
                box-shadow: var(--lm-shadow-lg);
                background: var(--lm-surface);
            }

            .lm-product-frame img {
                width: 100%;
                height: auto;
                display: block;
            }

            .lm-contact-panels {
                display: grid;
                gap: 2rem;
            }

            @media (min-width: 992px) {
                .lm-contact-panels {
                    grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
                }
            }

            .lm-form .lm-field {
                display: grid;
                gap: 0.75rem;
            }

            .lm-field-group {
                display: grid;
                gap: 1rem;
            }

            @media (min-width: 768px) {
                .lm-field-group.two {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            .lm-form label {
                font-weight: 600;
                color: var(--lm-neutral-700);
            }

            .lm-form input,
            .lm-form textarea,
            .lm-form select {
                width: 100%;
                border-radius: 12px;
                border: 1px solid var(--lm-neutral-200);
                padding: 0.75rem 1rem;
                font-size: 1rem;
                color: var(--lm-neutral-900);
                background-color: #fff;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .lm-form input:focus,
            .lm-form textarea:focus,
            .lm-form select:focus {
                outline: none;
                border-color: var(--lm-brand-600);
                box-shadow: 0 0 0 0.25rem rgba(50, 72, 173, 0.15);
            }

            .lm-form textarea {
                resize: vertical;
            }

            .lm-hero-slabs {
                display: grid;
                gap: 1.25rem;
            }

            .lm-hero-slab {
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                padding: 1.6rem;
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-hero-slab.lm-hero-slab-dark {
                background: rgba(255, 255, 255, 0.1);
                color: #fff;
                box-shadow: none;
                border: 1px solid rgba(255, 255, 255, 0.18);
            }

            .lm-hero-media {
                position: relative;
            }

            .lm-hero-ring {
                position: absolute;
                inset: -12%;
                border-radius: 50%;
                background: radial-gradient(circle at center, rgba(255, 255, 255, 0.12), transparent 70%);
                z-index: 0;
            }

            .lm-hero-media > * {
                position: relative;
                z-index: 1;
            }

            .lm-quote-card cite {
                font-weight: 600;
                opacity: 0.8;
            }

            .lm-card h3 {
                margin-bottom: 0.5rem;
            }

            .lm-card p:last-child,
            .lm-team-card-body p:last-child {
                margin-bottom: 0;
            }

            .lm-badge + h1,
            .lm-badge + h2,
            .lm-badge + h3 {
                margin-top: 1rem;
            }

            .lm-hero-actions .btn,
            .lm-cta-actions .btn {
                border-radius: 999px;
                padding-inline: 1.6rem;
            }

            .lm-tab-panel .lm-list-steps li {
                background: var(--lm-surface);
            }

            .lm-contact-side {
                display: grid;
                gap: 1.5rem;
            }

            .lm-contact-side .lm-card {
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-contact-side .lm-card.card-outline {
                border: 1px solid var(--lm-neutral-200);
                box-shadow: none;
            }

            .lm-surface-note {
                color: rgba(255, 255, 255, 0.7);
            }
        </style>
    @endpush
@endonce
