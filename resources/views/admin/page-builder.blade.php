@extends('layouts.admin')

@section('title', 'Visual Builder')

@section('content')
<div class="space-y-10" id="builder-root" data-templates='@json($templates)' data-block-schemas='@json($blockSchemas)'>
    <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <p class="text-sm font-medium text-indigo-500 uppercase tracking-widest">Site Builder</p>
            <h1 class="text-3xl font-semibold text-slate-900">Craft and publish dynamic pages</h1>
            <p class="mt-2 text-slate-600 max-w-2xl">Design layouts, manage reusable sections, and control global theme tokens directly from the admin panel. All changes are version-aware and scoped to your draft until you publish.</p>
        </div>
        <div class="flex gap-3">
            <button id="builder-create-template" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New Template
            </button>
        </div>
    </header>

    <section class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div id="builder-feedback" class="hidden rounded-lg border px-4 py-3 text-sm font-medium" role="status" aria-live="assertive"></div>
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Templates</h2>
                        <p class="text-sm text-slate-600">Manage reusable layouts. Select one to inspect its sections and blocks.</p>
                    </div>
                    <span class="text-xs font-medium text-slate-500" id="builder-template-count">{{ $templates->count() }} templates</span>
                </div>
                <div class="divide-y divide-slate-100" id="builder-template-list">
                    @forelse($templates as $template)
                        <article class="px-6 py-4 hover:bg-slate-50 transition flex items-start justify-between rounded-xl cursor-pointer" data-template-id="{{ $template->id }}">
                            <div>
                                <h3 class="text-base font-semibold text-slate-900 flex items-center gap-2">
                                    {{ $template->name }}
                                    <span class="text-xs font-medium rounded-full px-2 py-0.5 {{ $template->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ ucfirst($template->status) }}
                                    </span>
                                </h3>
                                <p class="text-sm text-slate-600 mt-1">/{{ $template->slug }}</p>
                                <p class="text-sm text-slate-500 mt-2">{{ $template->description ?? 'No description yet.' }}</p>
                            </div>
                            <div class="flex flex-col gap-2 items-end">
                                <button class="text-xs font-medium text-indigo-600 hover:text-indigo-700" data-action="publish">Publish</button>
                                <button class="text-xs font-medium text-rose-600 hover:text-rose-700" data-action="delete">Delete</button>
                            </div>
                        </article>
                    @empty
                        <p class="px-6 py-10 text-center text-sm text-slate-500">No templates yet. Create your first layout to get started.</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm hidden" id="builder-canvas" aria-live="polite">
                <div class="border-b border-slate-200 px-6 py-4 flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900" id="builder-active-template-name"></h2>
                        <p class="text-sm text-slate-500" id="builder-active-template-meta"></p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600" id="builder-active-template-status"></span>
                </div>
                <div class="grid lg:grid-cols-[260px_minmax(0,1fr)]">
                    <aside class="border-b lg:border-b-0 lg:border-r border-slate-200 bg-slate-50/60">
                        <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200">
                            <h3 class="text-sm font-semibold text-slate-700">Sections</h3>
                            <span class="text-xs text-slate-500" id="builder-section-count"></span>
                        </div>
                        <div id="builder-sections-list" class="divide-y divide-slate-200 max-h-[420px] overflow-y-auto"></div>
                    </aside>
                    <div class="flex flex-col">
                        <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-slate-700">Blocks</h3>
                                <p class="text-xs text-slate-500" id="builder-selected-section-label"></p>
                            </div>
                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                                <label class="sr-only" for="builder-new-block-type">Choose block type</label>
                                <select id="builder-new-block-type" class="rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-700">
                                    <option value="">Select block type</option>
                                    @foreach($blockSchemas as $type => $schema)
                                        <option value="{{ $type }}">{{ $schema['label'] ?? ucfirst($type) }}</option>
                                    @endforeach
                                </select>
                                <button id="builder-add-block" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add block</button>
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-[minmax(0,0.45fr)_minmax(0,1fr)] min-h-[360px]">
                            <div id="builder-blocks-list" class="border-b lg:border-b-0 lg:border-r border-slate-200 overflow-y-auto"></div>
                            <div id="builder-block-editor" class="p-6 overflow-y-auto">
                                <p class="text-sm text-slate-500">Select a block to edit its content.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center" id="builder-canvas-empty-state">
                <svg class="mx-auto h-12 w-12 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.5l16.5 0M3.75 9.75l16.5 0M3.75 15l16.5 0M3.75 20.25l16.5 0" />
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-slate-800">Select a template to begin editing</h3>
                <p class="mt-2 text-sm text-slate-600">Sections and blocks will appear here once a template is active. Drag, reorder, and customise each block directly from the builder sidebar.</p>
            </div>
            <div id="builder-canvas" class="hidden space-y-5" aria-live="polite"></div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-4">
                    <h2 class="text-lg font-semibold text-slate-900">Theme Controls</h2>
                    <p class="text-sm text-slate-600">Update global colours and typography tokens.</p>
                </div>
                <div class="px-6 py-4 space-y-4" id="builder-theme-panel" data-theme='@json($activeTheme)'>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Primary Colour</label>
                        <div class="mt-2 flex items-center gap-3">
                            <input type="color" id="theme-primary-color" value="{{ $activeTheme->primary_color ?? '#1f2937' }}" class="h-10 w-16 rounded border border-slate-300">
                            <input type="text" value="{{ $activeTheme->primary_color ?? '#1f2937' }}" class="flex-1 rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Accent Colour</label>
                        <div class="mt-2 flex items-center gap-3">
                            <input type="color" id="theme-accent-color" value="{{ $activeTheme->accent_color ?? '#f97316' }}" class="h-10 w-16 rounded border border-slate-300">
                            <input type="text" value="{{ $activeTheme->accent_color ?? '#f97316' }}" class="flex-1 rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Heading Typeface</label>
                        <input type="text" value="{{ $activeTheme->heading_font ?? 'Poppins' }}" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Body Typeface</label>
                        <input type="text" value="{{ $activeTheme->body_font ?? 'Inter' }}" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    </div>
                    <button class="mt-4 inline-flex w-full items-center justify-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800" id="builder-save-theme">Save Theme</button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-4">
                    <h2 class="text-lg font-semibold text-slate-900">Media Library</h2>
                    <p class="text-sm text-slate-600">Upload section background imagery and reuse it across templates.</p>
                </div>
                <div class="px-6 py-4 space-y-3">
                    <input type="file" id="builder-media-upload" accept="image/*" class="w-full text-sm text-slate-600">
                    <div id="builder-media-grid" class="grid grid-cols-3 gap-3" aria-live="polite"></div>
                    <button type="button" id="builder-media-load-more" class="hidden w-full rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100">Load more</button>
                </div>
            </div>
        </aside>
    </section>
</div>
@endsection

@push('scripts')
<script type="module">
    const builderRoot = document.querySelector('#builder-root');
    if (!builderRoot) {
        return;
    }

    const templateList = document.querySelector('#builder-template-list');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const canvas = document.querySelector('#builder-canvas');
    const emptyState = document.querySelector('#builder-canvas-empty-state');
    const sectionsList = document.querySelector('#builder-sections-list');
    const sectionCount = document.querySelector('#builder-section-count');
    const blocksList = document.querySelector('#builder-blocks-list');
    const blockEditor = document.querySelector('#builder-block-editor');
    const activeTemplateName = document.querySelector('#builder-active-template-name');
    const activeTemplateMeta = document.querySelector('#builder-active-template-meta');
    const activeTemplateStatus = document.querySelector('#builder-active-template-status');
    const selectedSectionLabel = document.querySelector('#builder-selected-section-label');
    const newBlockTypeSelect = document.querySelector('#builder-new-block-type');
    const addBlockButton = document.querySelector('#builder-add-block');
    const mediaGrid = document.querySelector('#builder-media-grid');
    const mediaUploadInput = document.querySelector('#builder-media-upload');
    const mediaLoadMoreButton = document.querySelector('#builder-media-load-more');

    const initialTemplates = parseDataset(builderRoot.dataset.templates, []);
    const blockSchemas = parseDataset(builderRoot.dataset.blockSchemas, {});

    const state = {
        templates: normaliseTemplates(initialTemplates),
        blockSchemas,
        selectedTemplateId: null,
        selectedSectionId: null,
        selectedBlockId: null,
        mediaItems: [],
        mediaPagination: {
            currentPage: 1,
            nextPageUrl: null,
        },
        mediaSelection: [],
        isSavingBlock: false,
    };

    function parseDataset(value, fallback) {
        if (!value) {
            return fallback;
        }

        try {
            return JSON.parse(value);
        } catch (error) {
            console.warn('Failed to parse builder dataset', error);
            return fallback;
        }
    }

    function safeClone(value, fallback) {
        try {
            return JSON.parse(JSON.stringify(value));
        } catch (error) {
            return fallback;
        }
    }

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, (char) => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;',
        }[char] ?? char));
    }

    function escapeAttribute(value) {
        return escapeHtml(value).replace(/`/g, '&#x60;');
    }

    function normaliseBlock(block) {
        if (!block) {
            return null;
        }

        return {
            ...block,
            content: safeClone(block.content ?? {}, {}),
            settings: safeClone(block.settings ?? {}, {}),
        };
    }

    function normaliseSection(section) {
        if (!section) {
            return null;
        }

        return {
            ...section,
            blocks: Array.isArray(section.blocks) ? section.blocks.map(normaliseBlock) : [],
        };
    }

    function normaliseTemplates(templates) {
        if (!Array.isArray(templates)) {
            return [];
        }

        return templates.map((template) => ({
            ...template,
            sections: Array.isArray(template.sections) ? template.sections.map(normaliseSection) : [],
        }));
    }

    function getCurrentTemplate() {
        if (!state.selectedTemplateId) {
            return null;
        }

        return state.templates.find((template) => Number(template.id) === Number(state.selectedTemplateId)) ?? null;
    }

    function getCurrentSection() {
        const template = getCurrentTemplate();
        if (!template || !state.selectedSectionId) {
            return null;
        }

        return template.sections.find((section) => Number(section.id) === Number(state.selectedSectionId)) ?? null;
    }

    function getCurrentBlock() {
        const section = getCurrentSection();
        if (!section || !state.selectedBlockId) {
            return null;
        }

        return section.blocks.find((block) => Number(block.id) === Number(state.selectedBlockId)) ?? null;
    }

    function ensureBlockContent(block) {
        if (!block.content || typeof block.content !== 'object') {
            block.content = {};
        }

        return block.content;
    }

    function findMediaItem(id) {
        if (!id) {
            return null;
        }

        const numericId = Number(id);
        return state.mediaItems.find((item) => Number(item.id) === numericId) ?? null;
    }

    function ensureMediaInState(mediaId) {
        if (!mediaId) {
            return;
        }

        const numericId = Number(mediaId);
        if (!state.mediaItems.some((item) => Number(item.id) === numericId)) {
            state.mediaItems.push({ id: numericId, url: null, original_name: null });
        }
    }

    async function publishTemplate(id) {
        await fetch(`/admin/page-templates/${id}/publish`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
        });
    }

    async function deleteTemplate(id) {
        await fetch(`/admin/page-templates/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
        });
    }

    function updateTemplateSelectionUI() {
        if (!templateList) {
            return;
        }

        templateList.querySelectorAll('[data-template-id]').forEach((row) => {
            const isActive = Number(row.dataset.templateId) === Number(state.selectedTemplateId);
            row.classList.toggle('ring-2', isActive);
            row.classList.toggle('ring-indigo-400', isActive);
            row.classList.toggle('bg-indigo-50/70', isActive);

            if (isActive) {
                row.setAttribute('aria-current', 'true');
            } else {
                row.removeAttribute('aria-current');
            }
        });
    }

    function renderTemplateDetails() {
        if (!canvas || !emptyState) {
            return;
        }

        const template = getCurrentTemplate();

        if (!template) {
            canvas.classList.add('hidden');
            emptyState.classList.remove('hidden');
            if (activeTemplateName) activeTemplateName.textContent = '';
            if (activeTemplateMeta) activeTemplateMeta.textContent = '';
            if (activeTemplateStatus) activeTemplateStatus.textContent = '';
            if (sectionCount) sectionCount.textContent = '';
            if (selectedSectionLabel) selectedSectionLabel.textContent = '';
            return;
        }

        canvas.classList.remove('hidden');
        emptyState.classList.add('hidden');

        if (activeTemplateName) {
            activeTemplateName.textContent = template.name ?? 'Untitled template';
        }

        if (activeTemplateMeta) {
            const slug = template.slug ? `/${template.slug}` : '';
            const updatedAt = template.updated_at ? new Date(template.updated_at).toLocaleString() : '';
            activeTemplateMeta.textContent = [slug, updatedAt].filter(Boolean).join(' • ');
        }

        if (activeTemplateStatus) {
            activeTemplateStatus.textContent = template.status ? template.status.toUpperCase() : 'DRAFT';
        }

        if (sectionCount) {
            sectionCount.textContent = `${template.sections.length} ${template.sections.length === 1 ? 'section' : 'sections'}`;
        }
    }

    function renderSections() {
        if (!sectionsList) {
            return;
        }

        const template = getCurrentTemplate();
        if (!template || !template.sections.length) {
            sectionsList.innerHTML = '<p class="px-5 py-4 text-sm text-slate-500">No sections yet. Add one from the templates panel.</p>';
            if (selectedSectionLabel) {
                selectedSectionLabel.textContent = '';
            }
            return;
        }

        sectionsList.innerHTML = template.sections.map((section) => {
            const isActive = Number(section.id) === Number(state.selectedSectionId);
            const blockCount = Array.isArray(section.blocks) ? section.blocks.length : 0;
            return `
                <button type="button" data-section-id="${section.id}" class="w-full text-left px-5 py-3 flex flex-col gap-1 transition ${isActive ? 'bg-white shadow-sm' : 'hover:bg-indigo-50'}">
                    <span class="text-sm font-semibold text-slate-700">${escapeHtml(section.title ?? 'Untitled section')}</span>
                    <span class="text-xs text-slate-500">${blockCount} ${blockCount === 1 ? 'block' : 'blocks'}</span>
                </button>
            `;
        }).join('');
    }

    function renderBlocks() {
        if (!blocksList) {
            return;
        }

        const section = getCurrentSection();

        if (!section) {
            blocksList.innerHTML = '<p class="px-4 py-4 text-sm text-slate-500">Select a section to view its blocks.</p>';
            if (selectedSectionLabel) {
                selectedSectionLabel.textContent = '';
            }
            return;
        }

        if (selectedSectionLabel) {
            selectedSectionLabel.textContent = section.title ? `Editing “${section.title}”` : `Section #${section.id}`;
        }

        if (!section.blocks.length) {
            blocksList.innerHTML = '<p class="px-4 py-6 text-sm text-slate-500">No blocks yet. Choose a type and add one.</p>';
            return;
        }

        blocksList.innerHTML = section.blocks.map((block) => {
            const isActive = Number(block.id) === Number(state.selectedBlockId);
            const label = block.title || state.blockSchemas[block.type]?.label || block.type;
            return `
                <button type="button" data-block-id="${block.id}" class="w-full text-left px-4 py-3 border-b border-slate-200 transition ${isActive ? 'bg-indigo-50/70' : 'hover:bg-slate-50'}">
                    <span class="block text-sm font-medium text-slate-800">${escapeHtml(label)}</span>
                    <span class="block text-xs uppercase tracking-wide text-slate-500">${escapeHtml(block.type)}</span>
                </button>
            `;
        }).join('');
    }

    function renderCollectionItems(items, collectionKey) {
        if (!Array.isArray(items) || !items.length) {
            return '';
        }

        return items.map((item, index) => {
            const media = findMediaItem(item.image_id);
            const preview = media && media.url
                ? `<img src="${escapeAttribute(media.url)}" alt="${escapeAttribute(media.original_name ?? '')}" class="h-16 w-16 rounded-lg object-cover">`
                : `<div class="flex h-16 w-16 items-center justify-center rounded-lg bg-slate-200 text-xs text-slate-500">#${escapeHtml(item.image_id ?? '')}</div>`;

            return `
                <div class="flex items-start gap-3 rounded-lg border border-slate-200 bg-white p-3 shadow-sm" data-collection-key="${collectionKey}" data-index="${index}">
                    ${preview}
                    <div class="flex-1 space-y-2">
                        <p class="text-xs font-medium text-slate-500">Media #${escapeHtml(item.image_id ?? '')}</p>
                        <label class="block text-xs font-medium text-slate-600">
                            Caption
                            <input type="text" data-collection-field="caption" data-index="${index}" data-collection-key="${collectionKey}" class="mt-1 w-full rounded border border-slate-300 px-2 py-1 text-sm text-slate-700" value="${escapeAttribute(item.caption ?? '')}">
                        </label>
                        <label class="block text-xs font-medium text-slate-600">
                            Order
                            <input type="number" data-collection-field="order" data-index="${index}" data-collection-key="${collectionKey}" class="mt-1 w-20 rounded border border-slate-300 px-2 py-1 text-sm text-slate-700" value="${escapeAttribute(String(item.order ?? index))}">
                        </label>
                    </div>
                    <button type="button" data-action="remove-item" data-collection-key="${collectionKey}" data-index="${index}" class="text-xs font-semibold text-rose-600 hover:text-rose-700">Remove</button>
                </div>
            `;
        }).join('');
    }

    function renderImageFields(block) {
        const content = ensureBlockContent(block);
        return `
            <div class="space-y-4">
                <p class="text-sm text-slate-500">Select an image from the media library to attach it to this block.</p>
                <div class="grid gap-4">
                    <label class="block text-sm font-medium text-slate-700">
                        Caption
                        <input type="text" data-content-field="caption" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-700" value="${escapeAttribute(content.caption ?? '')}" placeholder="Optional caption displayed beneath the image">
                    </label>
                    <label class="block text-sm font-medium text-slate-700">
                        Alt text
                        <input type="text" data-content-field="alt_text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-700" value="${escapeAttribute(content.alt_text ?? '')}" placeholder="Describe the image for screen readers">
                    </label>
                    <label class="block text-sm font-medium text-slate-700">
                        Link URL
                        <input type="url" data-content-field="link_url" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-700" value="${escapeAttribute(content.link_url ?? '')}" placeholder="https://example.com">
                    </label>
                </div>
            </div>
        `;
    }

    function renderGalleryFields(block) {
        const schema = state.blockSchemas[block.type];
        const content = ensureBlockContent(block);
        const items = Array.isArray(content.items) ? content.items : [];
        const columns = content.columns ?? schema?.defaults?.content?.columns ?? 3;
        const itemsMarkup = renderCollectionItems(items, 'items');

        return `
            <div class="space-y-4">
                <p class="text-sm text-slate-500">Select multiple assets from the media library to build a gallery grid.</p>
                <label class="block text-sm font-medium text-slate-700">
                    Columns
                    <input type="number" min="1" max="6" data-content-field="columns" class="mt-1 w-24 rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-700" value="${escapeAttribute(String(columns))}">
                </label>
                <div class="space-y-3" data-collection-wrapper="items">
                    ${items.length ? itemsMarkup : '<p class="rounded-lg border border-dashed border-slate-300 bg-slate-50 px-4 py-6 text-sm text-slate-500 text-center">Select one or more images from the media library to build this gallery.</p>'}
                </div>
            </div>
        `;
    }

    function renderSliderFields(block) {
        const schema = state.blockSchemas[block.type];
        const content = ensureBlockContent(block);
        const slides = Array.isArray(content.slides) ? content.slides : [];
        const autoplay = content.autoplay ?? schema?.defaults?.content?.autoplay ?? false;
        const interval = content.interval ?? schema?.defaults?.content?.interval ?? 5000;
        const slideMarkup = renderCollectionItems(slides, 'slides');

        return `
            <div class="space-y-4">
                <p class="text-sm text-slate-500">Select multiple assets from the media library to create a slider. Slides appear in the order you choose them.</p>
                <div class="flex flex-wrap items-center gap-4">
                    <label class="flex items-center gap-2 text-sm font-medium text-slate-700">
                        <input type="checkbox" data-content-field="autoplay" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" ${autoplay ? 'checked' : ''}>
                        Autoplay
                    </label>
                    <label class="text-sm font-medium text-slate-700">
                        Interval (ms)
                        <input type="number" min="1000" max="15000" step="500" data-content-field="interval" class="ml-2 w-28 rounded border border-slate-300 px-3 py-2 text-sm text-slate-700" value="${escapeAttribute(String(interval))}">
                    </label>
                </div>
                <div class="space-y-3" data-collection-wrapper="slides">
                    ${slides.length ? slideMarkup : '<p class="rounded-lg border border-dashed border-slate-300 bg-slate-50 px-4 py-6 text-sm text-slate-500 text-center">Select images to populate this slider.</p>'}
                </div>
            </div>
        `;
    }

    function renderBlockEditor() {
        if (!blockEditor) {
            return;
        }

        const block = getCurrentBlock();

        if (!block) {
            blockEditor.innerHTML = '<p class="text-sm text-slate-500">Select a block to edit its content.</p>';
            return;
        }

        const schema = state.blockSchemas[block.type];

        if (!schema) {
            blockEditor.innerHTML = `
                <div class="space-y-4">
                    <div>
                        <h4 class="text-base font-semibold text-slate-800">${escapeHtml(block.title ?? block.type)}</h4>
                        <p class="text-sm text-slate-500">This block type is not yet editable in the visual builder.</p>
                    </div>
                    <pre class="rounded-lg bg-slate-900/90 p-4 text-xs text-white overflow-auto">${escapeHtml(JSON.stringify(block.content ?? {}, null, 2))}</pre>
                </div>
            `;
            syncMediaSelection(null);
            return;
        }

        ensureBlockContent(block);

        const fields = [];

        fields.push(`
            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-700" for="builder-block-title">Internal title</label>
                <input id="builder-block-title" data-field="title" type="text" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-700" value="${escapeAttribute(block.title ?? '')}" placeholder="Optional label for this block">
            </div>
        `);

        if (block.type === 'image') {
            fields.push(renderImageFields(block));
        } else if (block.type === 'gallery') {
            fields.push(renderGalleryFields(block));
        } else if (block.type === 'slider') {
            fields.push(renderSliderFields(block));
        } else {
            fields.push('<p class="text-sm text-slate-500">No editor defined for this block type.</p>');
        }

        fields.push(`
            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Save block
                </button>
                <button type="button" data-action="reset-media-selection" class="text-sm font-medium text-slate-600 hover:text-slate-800">Clear media selection</button>
            </div>
        `);

        blockEditor.innerHTML = `
            <form id="builder-block-form" class="space-y-6">
                ${fields.join('')}
            </form>
        `;

        syncMediaSelection(block);
    }

    function syncMediaSelection(block) {
        if (!block) {
            state.mediaSelection = [];
            renderMediaGrid();
            return;
        }

        const schema = state.blockSchemas[block.type];
        if (!schema || !schema.media) {
            state.mediaSelection = [];
            renderMediaGrid();
            return;
        }

        if (schema.media.mode === 'single') {
            const mediaId = block.content?.[schema.media.field] ?? null;
            state.mediaSelection = mediaId ? [Number(mediaId)] : [];
            if (mediaId) {
                ensureMediaInState(mediaId);
            }
        } else if (schema.media.mode === 'collection') {
            const collectionKey = schema.media.field;
            const itemField = schema.media.item_field ?? 'image_id';
            const items = Array.isArray(block.content?.[collectionKey]) ? block.content[collectionKey] : [];
            state.mediaSelection = items
                .map((item) => Number(item?.[itemField] ?? item?.id))
                .filter((value) => Number.isInteger(value));
            state.mediaSelection.forEach(ensureMediaInState);
        } else {
            state.mediaSelection = [];
        }

        renderMediaGrid();
    }

    function renderMediaGrid() {
        if (!mediaGrid) {
            return;
        }

        if (!state.mediaItems.length) {
            mediaGrid.innerHTML = '<p class="col-span-3 text-sm text-slate-500">Upload an image to get started.</p>';
        } else {
            mediaGrid.innerHTML = state.mediaItems.map((media) => {
                const isActive = state.mediaSelection.includes(Number(media.id));
                const label = media.original_name ?? `Asset #${media.id}`;
                return `
                    <button type="button" data-media-id="${media.id}" class="relative aspect-square overflow-hidden rounded-lg border ${isActive ? 'border-indigo-500 ring-2 ring-indigo-400' : 'border-slate-200'} focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        ${media.url ? `<img src="${escapeAttribute(media.url)}" alt="${escapeAttribute(label)}" class="h-full w-full object-cover">` : `<div class="flex h-full w-full items-center justify-center bg-slate-100 text-xs font-medium text-slate-500">#${escapeHtml(media.id)}</div>`}
                    </button>
                `;
            }).join('');
        }

        if (mediaLoadMoreButton) {
            if (state.mediaPagination.nextPageUrl) {
                mediaLoadMoreButton.classList.remove('hidden');
            } else {
                mediaLoadMoreButton.classList.add('hidden');
            }
        }
    }

    function selectTemplate(templateId) {
        const template = state.templates.find((item) => Number(item.id) === Number(templateId));
        if (!template) {
            return;
        }

        state.selectedTemplateId = Number(template.id);
        const firstSection = template.sections?.[0] ?? null;
        state.selectedSectionId = firstSection ? Number(firstSection.id) : null;
        const firstBlock = firstSection?.blocks?.[0] ?? null;
        state.selectedBlockId = firstBlock ? Number(firstBlock.id) : null;

        updateTemplateSelectionUI();
        renderTemplateDetails();
        renderSections();
        renderBlocks();
        renderBlockEditor();
    }

    function selectSection(sectionId) {
        state.selectedSectionId = Number(sectionId);
        const section = getCurrentSection();
        const firstBlock = section?.blocks?.[0] ?? null;
        state.selectedBlockId = firstBlock ? Number(firstBlock.id) : null;

        renderSections();
        renderBlocks();
        renderBlockEditor();
    }

    function selectBlock(blockId) {
        state.selectedBlockId = Number(blockId);
        renderBlocks();
        renderBlockEditor();
    }

    function integrateBlockResponse(payload) {
        if (!payload) {
            return;
        }

        const block = normaliseBlock(payload);
        const sectionId = payload.page_section_id ?? payload.section?.id ?? null;
        if (!sectionId) {
            return;
        }

        const template = state.templates.find((tmpl) => tmpl.sections.some((section) => Number(section.id) === Number(sectionId)));
        if (!template) {
            return;
        }

        const section = template.sections.find((item) => Number(item.id) === Number(sectionId));
        if (!section) {
            return;
        }

        if (!Array.isArray(section.blocks)) {
            section.blocks = [];
        }

        const index = section.blocks.findIndex((existing) => Number(existing.id) === Number(block.id));
        if (index !== -1) {
            section.blocks[index] = block;
        } else {
            section.blocks.push(block);
            section.blocks.sort((a, b) => (a.position ?? 0) - (b.position ?? 0));
        }
    }

    async function saveCurrentBlock() {
        const block = getCurrentBlock();
        if (!block || state.isSavingBlock) {
            return;
        }

        state.isSavingBlock = true;
        try {
            const response = await fetch(`/admin/page-blocks/${block.id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    title: block.title ?? null,
                    content: block.content ?? null,
                    settings: block.settings ?? null,
                }),
            });

            if (!response.ok) {
                throw new Error('Failed to save block');
            }

            const data = await response.json();
            integrateBlockResponse(data);
            renderBlocks();
            renderBlockEditor();
        } catch (error) {
            console.error(error);
            alert('Unable to save block. Please try again.');
        } finally {
            state.isSavingBlock = false;
        }
    }

    async function createBlock() {
        const section = getCurrentSection();
        const type = newBlockTypeSelect?.value;

        if (!section || !type) {
            alert('Select a section and block type before adding a block.');
            return;
        }

        const schema = state.blockSchemas[type];
        if (!schema) {
            alert('Unsupported block type.');
            return;
        }

        try {
            const response = await fetch('/admin/page-blocks', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    page_section_id: section.id,
                    type,
                    position: Array.isArray(section.blocks) ? section.blocks.length : 0,
                    title: null,
                    content: safeClone(schema.defaults?.content ?? {}, {}),
                    settings: safeClone(schema.defaults?.settings ?? {}, {}),
                }),
            });

            if (!response.ok) {
                throw new Error('Failed to create block');
            }

            const data = await response.json();
            integrateBlockResponse(data);
            state.selectedSectionId = Number(data.page_section_id ?? section.id);
            state.selectedBlockId = Number(data.id);
            renderSections();
            renderBlocks();
            renderBlockEditor();
            newBlockTypeSelect.value = '';
        } catch (error) {
            console.error(error);
            alert('Unable to create block. Please try again.');
        }
    }

    function handleTitleInput(value) {
        const block = getCurrentBlock();
        if (!block) {
            return;
        }

        block.title = value;
        renderBlocks();
    }

    function handleContentInput(target) {
        const block = getCurrentBlock();
        if (!block) {
            return;
        }

        const field = target.dataset.contentField;
        if (!field) {
            return;
        }

        ensureBlockContent(block);

        if (target.type === 'checkbox') {
            block.content[field] = target.checked;
        } else if (target.type === 'number') {
            block.content[field] = target.value === '' ? null : Number(target.value);
        } else {
            block.content[field] = target.value;
        }
    }

    function handleCollectionInput(target) {
        const block = getCurrentBlock();
        if (!block) {
            return;
        }

        const collectionKey = target.dataset.collectionKey;
        const index = Number(target.dataset.index);
        const field = target.dataset.collectionField;
        if (!collectionKey || field === undefined || Number.isNaN(index)) {
            return;
        }

        const schema = state.blockSchemas[block.type];
        if (!schema?.media || schema.media.field !== collectionKey) {
            return;
        }

        const collection = Array.isArray(block.content?.[collectionKey]) ? block.content[collectionKey] : [];
        if (!collection[index]) {
            return;
        }

        if (target.type === 'number') {
            collection[index][field] = target.value === '' ? null : Number(target.value);
        } else {
            collection[index][field] = target.value;
        }
    }

    function removeCollectionItem(collectionKey, index) {
        const block = getCurrentBlock();
        if (!block) {
            return;
        }

        const schema = state.blockSchemas[block.type];
        if (!schema?.media || schema.media.field !== collectionKey) {
            return;
        }

        const collection = Array.isArray(block.content?.[collectionKey]) ? block.content[collectionKey] : [];
        if (!collection[index]) {
            return;
        }

        const itemField = schema.media.item_field ?? 'image_id';
        const removed = collection.splice(index, 1)[0];
        if (removed) {
            const id = Number(removed[itemField]);
            const selectionIndex = state.mediaSelection.indexOf(id);
            if (selectionIndex !== -1) {
                state.mediaSelection.splice(selectionIndex, 1);
            }
        }

        renderMediaGrid();
        renderBlockEditor();
    }

    function resetMediaSelection() {
        const block = getCurrentBlock();
        if (!block) {
            return;
        }

        const schema = state.blockSchemas[block.type];
        if (!schema?.media) {
            return;
        }

        if (schema.media.mode === 'single') {
            if (block.content) {
                block.content[schema.media.field] = null;
            }
            state.mediaSelection = [];
        } else if (schema.media.mode === 'collection') {
            if (block.content) {
                block.content[schema.media.field] = [];
            }
            state.mediaSelection = [];
        }

        renderMediaGrid();
        renderBlockEditor();
    }

    function handleMediaToggle(mediaId) {
        const block = getCurrentBlock();
        if (!block) {
            return;
        }

        const schema = state.blockSchemas[block.type];
        if (!schema?.media) {
            return;
        }

        const numericId = Number(mediaId);
        ensureBlockContent(block);

        if (schema.media.mode === 'single') {
            state.mediaSelection = [numericId];
            block.content[schema.media.field] = numericId;
        } else if (schema.media.mode === 'collection') {
            const collectionKey = schema.media.field;
            const itemField = schema.media.item_field ?? 'image_id';
            const existingIndex = state.mediaSelection.indexOf(numericId);

            if (existingIndex === -1) {
                state.mediaSelection.push(numericId);
            } else {
                state.mediaSelection.splice(existingIndex, 1);
            }

            const existingItems = Array.isArray(block.content[collectionKey]) ? block.content[collectionKey] : [];
            const map = new Map();
            existingItems.forEach((item) => {
                const id = Number(item[itemField] ?? item.id);
                if (id) {
                    map.set(id, { ...item });
                }
            });

            block.content[collectionKey] = state.mediaSelection.map((id, order) => {
                const existing = map.get(id) ?? {};
                return {
                    ...existing,
                    [itemField]: id,
                    order: existing.order ?? order,
                    caption: existing.caption ?? '',
                };
            });
        }

        renderMediaGrid();
        renderBlockEditor();
    }

    async function fetchMedia(page = 1) {
        try {
            const response = await fetch(`/admin/media?collection=page-builder&page=${page}`, {
                headers: { 'Accept': 'application/json' },
            });

            if (!response.ok) {
                throw new Error('Failed to load media');
            }

            const payload = await response.json();
            const items = Array.isArray(payload.data) ? payload.data : [];
            if (page === 1) {
                state.mediaItems = items;
            } else {
                const existingIds = new Set(state.mediaItems.map((item) => Number(item.id)));
                items.forEach((item) => {
                    if (!existingIds.has(Number(item.id))) {
                        state.mediaItems.push(item);
                    }
                });
            }

            state.mediaPagination.currentPage = payload.current_page ?? page;
            state.mediaPagination.nextPageUrl = payload.next_page_url ?? null;
            renderMediaGrid();
        } catch (error) {
            console.error(error);
            mediaGrid.innerHTML = '<p class="col-span-3 text-sm text-rose-600">Unable to load media library.</p>';
        }
    }

    async function uploadMedia(file) {
        const formData = new FormData();
        formData.append('file', file);
        formData.append('collection', 'page-builder');

        try {
            const response = await fetch('/admin/media', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            if (!response.ok) {
                throw new Error('Upload failed');
            }

            const media = await response.json();
            state.mediaItems.unshift(media);
            renderMediaGrid();
            mediaUploadInput.value = '';
        } catch (error) {
            console.error(error);
            alert('Media upload failed. Please try again.');
        }
    }

    function loadMoreMedia() {
        if (!state.mediaPagination.nextPageUrl) {
            return;
        }

        const url = new URL(state.mediaPagination.nextPageUrl, window.location.origin);
        const page = Number(url.searchParams.get('page')) || state.mediaPagination.currentPage + 1;
        fetchMedia(page);
    }

    templateList?.addEventListener('click', async (event) => {
        const actionButton = event.target.closest('button[data-action]');
        if (actionButton) {
            event.preventDefault();
            const row = actionButton.closest('[data-template-id]');
            const templateId = row?.dataset.templateId;
            if (!templateId) {
                return;
            }

            if (actionButton.dataset.action === 'publish') {
                await publishTemplate(templateId);
                window.location.reload();
            }

            if (actionButton.dataset.action === 'delete') {
                if (confirm('Delete this template? This action cannot be undone.')) {
                    await deleteTemplate(templateId);
                    window.location.reload();
                }
            }

            return;
        }

        const row = event.target.closest('[data-template-id]');
        if (!row) {
            return;
        }

        selectTemplate(row.dataset.templateId);
    });

    sectionsList?.addEventListener('click', (event) => {
        const button = event.target.closest('[data-section-id]');
        if (!button) {
            return;
        }

        selectSection(button.dataset.sectionId);
    });

    blocksList?.addEventListener('click', (event) => {
        const button = event.target.closest('[data-block-id]');
        if (!button) {
            return;
        }

        selectBlock(button.dataset.blockId);
    });

    blockEditor?.addEventListener('input', (event) => {
        const target = event.target;
        if (target.matches('[data-field="title"]')) {
            handleTitleInput(target.value);
            return;
        }

        if (target.matches('[data-content-field]')) {
            handleContentInput(target);
            return;
        }

        if (target.matches('[data-collection-field]')) {
            handleCollectionInput(target);
        }
    });

    blockEditor?.addEventListener('change', (event) => {
        const target = event.target;
        if (target.matches('[data-content-field]')) {
            handleContentInput(target);
        }
        if (target.matches('[data-collection-field]')) {
            handleCollectionInput(target);
        }
    });

    blockEditor?.addEventListener('click', (event) => {
        const button = event.target.closest('button[data-action]');
        if (!button) {
            return;
        }

        if (button.dataset.action === 'remove-item') {
            removeCollectionItem(button.dataset.collectionKey, Number(button.dataset.index));
        }

        if (button.dataset.action === 'reset-media-selection') {
            event.preventDefault();
            resetMediaSelection();
        }
    });

    blockEditor?.addEventListener('submit', (event) => {
        event.preventDefault();
        saveCurrentBlock();
    });

    addBlockButton?.addEventListener('click', (event) => {
        event.preventDefault();
        createBlock();
    });

    mediaGrid?.addEventListener('click', (event) => {
        const tile = event.target.closest('[data-media-id]');
        if (!tile) {
            return;
        }

        handleMediaToggle(tile.dataset.mediaId);
    });

    mediaUploadInput?.addEventListener('change', (event) => {
        const [file] = event.target.files ?? [];
        if (!file) {
            return;
        }

        uploadMedia(file);
    });

    mediaLoadMoreButton?.addEventListener('click', () => {
        loadMoreMedia();
    });

    renderTemplateDetails();
    renderSections();
    renderBlocks();
    renderBlockEditor();
    fetchMedia();
    renderMediaGrid();
</script>

@endpush
