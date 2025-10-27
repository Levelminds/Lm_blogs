@once
    @push('styles')
        <style>
            .lm-marketing {
                --lm-brand-950: #111c4d;
                --lm-brand-900: #182764;
                --lm-brand-800: #22317d;
                --lm-brand-700: #3248ad;
                --lm-brand-600: #3f97d5;
                --lm-accent-500: #fb7b4d;
                --lm-neutral-950: #0b142d;
                --lm-neutral-900: #121c36;
                --lm-neutral-700: #2c3852;
                --lm-neutral-600: #445068;
                --lm-neutral-500: #5a6780;
                --lm-neutral-400: #818ca3;
                --lm-neutral-300: #b1bcd3;
                --lm-neutral-200: #d7deef;
                --lm-neutral-150: #e6ebf7;
                --lm-neutral-100: #f5f7fc;
                --lm-surface: #ffffff;
                --lm-surface-muted: #f9fbff;
                --lm-border-subtle: rgba(17, 28, 77, 0.08);
                --lm-border-strong: rgba(17, 28, 77, 0.16);
                --lm-shadow-lg: 0 34px 68px -36px rgba(17, 28, 77, 0.48);
                --lm-shadow-md: 0 22px 44px -30px rgba(17, 28, 77, 0.25);
                --lm-shadow-sm: 0 14px 32px -24px rgba(17, 28, 77, 0.18);
                font-family: 'Manrope', sans-serif;
                color: var(--lm-neutral-900);
                background: var(--lm-neutral-100);
            }

            .lm-marketing h1,
            .lm-marketing h2,
            .lm-marketing h3,
            .lm-marketing h4,
            .lm-marketing h5,
            .lm-marketing h6 {
                color: var(--lm-neutral-950);
                font-weight: 700;
                line-height: 1.18;
                margin-bottom: 0.65rem;
            }

            .lm-marketing p {
                color: var(--lm-neutral-600);
                line-height: 1.7;
                margin-bottom: 1rem;
            }

            .lm-marketing a {
                color: var(--lm-brand-700);
                font-weight: 600;
                transition: color 0.2s ease;
            }

            .lm-marketing a:hover {
                color: var(--lm-brand-800);
                text-decoration: none;
            }

            .lm-marketing strong {
                color: var(--lm-neutral-900);
            }

            .lm-section {
                padding: clamp(3rem, 6vw, 5rem) 0;
                background: var(--lm-section-bg, transparent);
            }

            .lm-section + .lm-section {
                border-top: 1px solid var(--lm-border-subtle);
            }

            .lm-section--surface {
                --lm-section-bg: var(--lm-surface);
            }

            .lm-section--muted,
            .lm-section--light {
                --lm-section-bg: var(--lm-surface-muted);
            }

            .lm-section--dark,
            .lm-section--contrast {
                --lm-section-bg: var(--lm-brand-900);
                color: rgba(255, 255, 255, 0.9);
                border-top: none;
            }

            .lm-section--dark h1,
            .lm-section--dark h2,
            .lm-section--dark h3,
            .lm-section--dark h4,
            .lm-section--dark h5,
            .lm-section--dark h6,
            .lm-section--dark p,
            .lm-section--dark span,
            .lm-section--dark li,
            .lm-section--dark cite,
            .lm-section--dark a,
            .lm-section--dark dl,
            .lm-section--dark dt,
            .lm-section--dark dd {
                color: inherit;
            }

            .lm-stack {
                display: grid;
                gap: clamp(1.5rem, 3vw, 2.5rem);
            }

            .lm-section__header {
                display: grid;
                gap: 0.75rem;
                margin-bottom: clamp(2.25rem, 6vw, 3.5rem);
            }

            .lm-section__header.lm-center {
                text-align: center;
                justify-items: center;
            }

            .lm-center {
                text-align: center;
            }

            .lm-lead {
                font-size: clamp(1rem, 1.05vw + 0.9rem, 1.15rem);
                color: var(--lm-neutral-600);
                max-width: 65ch;
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
                background: rgba(50, 72, 173, 0.12);
                padding: 0.35rem 0.85rem;
                border-radius: 999px;
            }

            .lm-badge--light {
                background: rgba(255, 255, 255, 0.2);
                color: #fff;
            }

            .lm-eyebrow {
                color: var(--lm-brand-600);
            }

            .lm-hero-section {
                position: relative;
                --lm-section-bg: var(--lm-surface);
            }

            .lm-hero-section::after {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at top right, rgba(50, 72, 173, 0.12), transparent 55%);
                pointer-events: none;
            }

            .lm-hero {
                position: relative;
                z-index: 1;
                display: grid;
                gap: clamp(2rem, 4vw, 3.5rem);
            }

            @media (min-width: 992px) {
                .lm-hero.lm-hero-grid {
                    grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
                    align-items: center;
                }
            }

            .lm-hero-actions,
            .lm-cta-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
            }

            .lm-hero-actions .btn,
            .lm-cta-actions .btn {
                border-radius: 999px;
                padding-inline: 1.6rem;
                font-weight: 600;
            }

            .lm-metric-grid {
                display: grid;
                gap: 1rem;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                margin-top: 1.5rem;
            }

            .lm-metric {
                background: var(--lm-surface);
                border: 1px solid var(--lm-border-subtle);
                border-radius: 18px;
                padding: 1.5rem;
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-metric dt {
                font-size: 0.82rem;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                color: var(--lm-neutral-500);
                margin-bottom: 0.5rem;
            }

            .lm-metric dd {
                font-size: clamp(1.6rem, 2vw + 1rem, 2.2rem);
                font-weight: 700;
                color: var(--lm-brand-700);
                margin-bottom: 0;
            }

            .lm-hero-media {
                position: relative;
                display: grid;
                justify-items: center;
            }

            .lm-hero-ring {
                position: absolute;
                inset: 0;
                margin: auto;
                width: min(420px, 90%);
                aspect-ratio: 1;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(50, 72, 173, 0.25), transparent 65%);
                filter: blur(0.5px);
            }

            .lm-hero-slabs {
                position: relative;
                display: grid;
                gap: 1rem;
                width: min(440px, 100%);
            }

            .lm-hero-slab {
                background: var(--lm-surface);
                border-radius: 20px;
                padding: 1.75rem;
                border: 1px solid var(--lm-border-subtle);
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-hero-slab-dark {
                background: var(--lm-brand-900);
                color: #fff;
                border-color: rgba(255, 255, 255, 0.12);
                box-shadow: none;
            }

            .lm-hero-slab-dark h3,
            .lm-hero-slab-dark p,
            .lm-hero-slab-dark span {
                color: inherit;
            }

            .lm-feature-grid {
                display: grid;
                gap: 1.5rem;
            }

            @media (min-width: 992px) {
                .lm-feature-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }

            .lm-card {
                background: var(--lm-surface);
                border-radius: 20px;
                border: 1px solid var(--lm-border-subtle);
                padding: clamp(1.5rem, 3vw, 2rem);
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-card--outline {
                background: transparent;
                border: 1px dashed var(--lm-border-strong);
                box-shadow: none;
            }

            .lm-card--raised {
                box-shadow: var(--lm-shadow-md);
            }

            .lm-card--dark {
                background: linear-gradient(135deg, rgba(17, 28, 77, 0.95), rgba(24, 39, 100, 0.92));
                color: rgba(255, 255, 255, 0.9);
                border: 1px solid rgba(255, 255, 255, 0.12);
                box-shadow: none;
            }

            .lm-card--dark h3,
            .lm-card--dark p,
            .lm-card--dark ul,
            .lm-card--dark li {
                color: inherit;
            }

            .lm-list-check {
                list-style: none;
                padding: 0;
                margin: 1.25rem 0 0;
                display: grid;
                gap: 0.65rem;
            }

            .lm-list-check li {
                position: relative;
                padding-left: 1.5rem;
                color: var(--lm-neutral-600);
            }

            .lm-list-check li::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0.35rem;
                width: 0.85rem;
                height: 0.85rem;
                border-radius: 999px;
                background: var(--lm-brand-700);
                mask: url('data:image/svg+xml,%3Csvg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="white"%3E%3Cpath d="M6.173 12.414 2.1 8.34l1.414-1.414 2.66 2.66 6.313-6.313 1.414 1.414z"/%3E%3C/svg%3E') no-repeat center / 80%;
            }

            .lm-split {
                display: grid;
                gap: clamp(2rem, 4vw, 3rem);
            }

            @media (min-width: 992px) {
                .lm-split {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    align-items: center;
                }
            }

            .lm-list-steps {
                counter-reset: lm-steps;
                display: grid;
                gap: 1.25rem;
                padding-left: 0;
                margin-bottom: 0;
            }

            .lm-list-steps li {
                list-style: none;
                background: var(--lm-surface);
                border: 1px solid var(--lm-border-subtle);
                border-radius: 18px;
                padding: 1.5rem;
                box-shadow: var(--lm-shadow-sm);
                position: relative;
                padding-left: 4.5rem;
            }

            .lm-list-steps li::before {
                counter-increment: lm-steps;
                content: counter(lm-steps, decimal-leading-zero);
                position: absolute;
                left: 1.5rem;
                top: 1.5rem;
                font-weight: 700;
                font-size: 1.25rem;
                color: var(--lm-brand-700);
            }

            .lm-product-slider .carousel-indicators [data-bs-target] {
                width: 12px;
                height: 12px;
                border-radius: 999px;
                background-color: var(--lm-neutral-200);
                opacity: 1;
            }

            .lm-product-slider .carousel-indicators .active {
                background-color: var(--lm-brand-700);
            }

            .lm-product-caption {
                font-size: 0.95rem;
                color: var(--lm-neutral-600);
                margin-top: 1rem;
                text-align: center;
            }

            .lm-quote-card {
                background: var(--lm-surface);
                border-radius: 20px;
                border: 1px solid rgba(255, 255, 255, 0.25);
                padding: clamp(1.75rem, 3vw, 2.5rem);
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-section--dark .lm-quote-card {
                background: rgba(17, 28, 77, 0.4);
                border-color: rgba(255, 255, 255, 0.16);
                box-shadow: none;
            }

            .lm-quote-card blockquote {
                font-size: clamp(1.1rem, 1.4vw + 1rem, 1.35rem);
                font-weight: 600;
                margin: 0 0 1rem;
                color: inherit;
            }

            .lm-quote-card cite {
                display: block;
                font-style: normal;
                font-weight: 600;
                color: rgba(255, 255, 255, 0.75);
            }

            .lm-cta-banner {
                background: var(--lm-surface);
                border-radius: 24px;
                padding: clamp(2rem, 5vw, 3rem);
                display: grid;
                gap: 2rem;
                align-items: center;
                border: 1px solid var(--lm-border-subtle);
                box-shadow: var(--lm-shadow-md);
            }

            @media (min-width: 992px) {
                .lm-cta-banner {
                    grid-template-columns: minmax(0, 1.5fr) minmax(0, auto);
                }
            }

            .lm-product-frame {
                background: var(--lm-surface);
                border-radius: 22px;
                padding: clamp(1.75rem, 3vw, 2.75rem);
                border: 1px solid var(--lm-border-subtle);
                box-shadow: var(--lm-shadow-md);
            }

            .lm-contact-panels {
                display: grid;
                gap: clamp(2rem, 4vw, 3rem);
            }

            @media (min-width: 992px) {
                .lm-contact-panels {
                    grid-template-columns: 1.4fr 1fr;
                }
            }

            .lm-form {
                display: grid;
                gap: 1.25rem;
            }

            .lm-field-group {
                display: grid;
                gap: 1.25rem;
            }

            .lm-field-group.two {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            }

            .lm-field label {
                font-weight: 600;
                color: var(--lm-neutral-600);
                margin-bottom: 0.35rem;
                display: block;
            }

            .lm-field input,
            .lm-field textarea,
            .lm-field select {
                width: 100%;
                border-radius: 14px;
                border: 1px solid var(--lm-border-strong);
                padding: 0.75rem 1rem;
                font-size: 1rem;
                color: var(--lm-neutral-900);
                background: var(--lm-surface);
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .lm-field input:focus,
            .lm-field textarea:focus,
            .lm-field select:focus {
                outline: none;
                border-color: var(--lm-brand-700);
                box-shadow: 0 0 0 3px rgba(50, 72, 173, 0.18);
            }

            .lm-field textarea {
                min-height: 140px;
                resize: vertical;
            }

            .lm-team-grid {
                display: grid;
                gap: clamp(1.75rem, 3vw, 2.5rem);
            }

            @media (min-width: 992px) {
                .lm-team-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }

            .lm-team-card {
                background: var(--lm-surface);
                border: 1px solid var(--lm-border-subtle);
                border-radius: 22px;
                box-shadow: var(--lm-shadow-sm);
                overflow: hidden;
                display: grid;
                grid-template-rows: auto 1fr;
            }

            .lm-team-card img {
                width: 100%;
                aspect-ratio: 3 / 2;
                object-fit: cover;
            }

            .lm-team-card-body {
                padding: clamp(1.5rem, 3vw, 2rem);
                display: grid;
                gap: 0.75rem;
            }

            .lm-team-role {
                font-size: 0.85rem;
                font-weight: 600;
                color: var(--lm-brand-700);
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .lm-timeline {
                display: grid;
                gap: 1.25rem;
                position: relative;
                padding-left: 1.5rem;
            }

            .lm-timeline::before {
                content: '';
                position: absolute;
                left: 0.5rem;
                top: 0.2rem;
                bottom: 0.2rem;
                width: 2px;
                background: linear-gradient(var(--lm-brand-700), rgba(50, 72, 173, 0));
            }

            .lm-timeline-item {
                background: var(--lm-surface);
                border-radius: 18px;
                border: 1px solid var(--lm-border-subtle);
                padding: 1.5rem;
                box-shadow: var(--lm-shadow-sm);
                position: relative;
            }

            .lm-timeline-item::before {
                content: attr(data-year);
                position: absolute;
                left: -1.3rem;
                top: 1.5rem;
                transform: translateX(-100%);
                background: var(--lm-brand-700);
                color: #fff;
                font-weight: 700;
                font-size: 0.78rem;
                letter-spacing: 0.08em;
                padding: 0.35rem 0.65rem;
                border-radius: 999px;
            }

            .lm-contact-side {
                display: grid;
                gap: 1.25rem;
            }

            .lm-tab-group {
                display: grid;
                gap: 2rem;
            }

            .lm-tab-buttons {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
                justify-content: center;
            }

            .lm-tab-button {
                border: 1px solid var(--lm-border-strong);
                background: var(--lm-surface);
                color: var(--lm-neutral-600);
                border-radius: 999px;
                padding: 0.65rem 1.5rem;
                font-weight: 600;
                transition: all 0.2s ease;
            }

            .lm-tab-button:hover {
                border-color: var(--lm-brand-700);
                color: var(--lm-brand-700);
            }

            .lm-tab-button.active,
            .lm-tab-button[aria-selected="true"] {
                background: var(--lm-brand-700);
                color: #fff;
                border-color: var(--lm-brand-700);
                box-shadow: 0 8px 18px -12px rgba(50, 72, 173, 0.6);
            }

            .lm-tab-panel {
                display: none;
                background: var(--lm-surface);
                border: 1px solid var(--lm-border-subtle);
                border-radius: 20px;
                padding: clamp(1.75rem, 3vw, 2.5rem);
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-tab-panel.active {
                display: block;
            }

            .lm-tab-panel .lm-list-steps li {
                background: var(--lm-surface-muted);
            }

            .lm-tab-panel .lm-list-steps li::before {
                color: var(--lm-brand-700);
            }

            .lm-surface-note {
                color: rgba(255, 255, 255, 0.78);
            }

            .lm-contact-side .lm-card {
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-contact-side .lm-card.card-outline {
                border: 1px solid var(--lm-neutral-200);
                box-shadow: none;
            }

            @media (max-width: 767.98px) {
                .lm-hero-actions .btn,
                .lm-cta-actions .btn {
                    width: 100%;
                    justify-content: center;
                }
            }
        </style>
    @endpush
@endonce
