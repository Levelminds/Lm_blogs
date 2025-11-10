const templateListEl = document.querySelector('#builder-template-list');
const templateCountEl = document.querySelector('#builder-template-count');
const canvasEmptyStateEl = document.querySelector('#builder-canvas-empty-state');
const canvasEl = document.querySelector('#builder-canvas');
const feedbackEl = document.querySelector('#builder-feedback');
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

const state = {
    templates: [],
    activeTemplateId: null,
    feedbackTimeout: null,
};

const feedbackClassMap = {
    success: ['border-emerald-200', 'bg-emerald-50', 'text-emerald-800'],
    error: ['border-rose-200', 'bg-rose-50', 'text-rose-800'],
};

const baseFetchHeaders = {
    Accept: 'application/json',
    'X-CSRF-TOKEN': csrfToken,
};

function escapeHtml(value) {
    if (value === null || value === undefined) {
        return '';
    }

    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function formatStatusLabel(status) {
    if (!status) {
        return 'Draft';
    }

    return `${status.charAt(0).toUpperCase()}${status.slice(1)}`;
}

function sortTemplates() {
    state.templates.sort((a, b) => {
        const aDate = a.updated_at ? new Date(a.updated_at).getTime() : 0;
        const bDate = b.updated_at ? new Date(b.updated_at).getTime() : 0;

        return bDate - aDate;
    });
}

function updateTemplateCount() {
    if (!templateCountEl) {
        return;
    }

    const count = state.templates.length;
    const label = `${count} template${count === 1 ? '' : 's'}`;

    templateCountEl.textContent = label;
}

function hideFeedback() {
    if (!feedbackEl) {
        return;
    }

    feedbackEl.classList.add('hidden');
    feedbackEl.textContent = '';

    Object.values(feedbackClassMap).forEach((classes) => {
        feedbackEl.classList.remove(...classes);
    });
}

function showFeedback(message, tone = 'success') {
    if (!feedbackEl) {
        return;
    }

    clearTimeout(state.feedbackTimeout);

    hideFeedback();
    const classes = feedbackClassMap[tone] ?? feedbackClassMap.success;
    feedbackEl.classList.remove('hidden');
    feedbackEl.classList.add(...classes);
    feedbackEl.textContent = message;

    state.feedbackTimeout = setTimeout(hideFeedback, 4000);
}

function templateStatusBadge(template) {
    const isPublished = template.status === 'published';
    const badgeClasses = isPublished
        ? 'bg-emerald-100 text-emerald-700'
        : 'bg-amber-100 text-amber-700';

    return `<span class="text-xs font-medium rounded-full px-2 py-0.5 ${badgeClasses}">${escapeHtml(formatStatusLabel(template.status))}</span>`;
}

function renderTemplates() {
    if (!templateListEl) {
        return;
    }

    if (!state.templates.length) {
        templateListEl.innerHTML = '<p class="px-6 py-10 text-center text-sm text-slate-500">No templates yet. Create your first layout to get started.</p>';
        updateTemplateCount();
        return;
    }

    const html = state.templates
        .map((template) => {
            const isActive = Number(state.activeTemplateId) === Number(template.id);
            const isPublished = template.status === 'published';
            const articleClasses = [
                'px-6',
                'py-4',
                'hover:bg-slate-50',
                'transition',
                'flex',
                'items-start',
                'justify-between',
                'cursor-pointer',
            ];

            if (isActive) {
                articleClasses.push('bg-indigo-50/70', 'ring-1', 'ring-indigo-200');
            }

            const publishButtonClasses = ['text-xs', 'font-medium'];

            if (isPublished) {
                publishButtonClasses.push('text-slate-400', 'cursor-not-allowed');
            } else {
                publishButtonClasses.push('text-indigo-600', 'hover:text-indigo-700');
            }

            return `
                <article class="${articleClasses.join(' ')}" data-template-id="${template.id}" aria-selected="${isActive}">
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 flex items-center gap-2">
                            ${escapeHtml(template.name)}
                            ${templateStatusBadge(template)}
                        </h3>
                        <p class="text-sm text-slate-600 mt-1">/${escapeHtml(template.slug)}</p>
                        <p class="text-sm text-slate-500 mt-2">${escapeHtml(template.description ?? 'No description yet.')}</p>
                    </div>
                    <div class="flex flex-col gap-2 items-end">
                        <button class="${publishButtonClasses.join(' ')}" data-action="publish" ${isPublished ? 'disabled' : ''}>${isPublished ? 'Published' : 'Publish'}</button>
                        <button class="text-xs font-medium text-rose-600 hover:text-rose-700" data-action="delete">Delete</button>
                    </div>
                </article>
            `;
        })
        .join('');

    templateListEl.innerHTML = html;
    updateTemplateCount();
}

function renderCanvas(template) {
    if (!canvasEl || !canvasEmptyStateEl) {
        return;
    }

    if (!template) {
        canvasEl.innerHTML = '';
        canvasEl.classList.add('hidden');
        canvasEmptyStateEl.classList.remove('hidden');
        return;
    }

    const sections = Array.isArray(template.sections) ? template.sections : [];

    const sectionsHtml = sections.length
        ? sections
              .map((section) => {
                  const blocks = Array.isArray(section.blocks) ? section.blocks : [];
                  const blocksHtml = blocks.length
                      ? `<ul class="mt-4 space-y-2">${blocks
                            .map((block) => {
                                const title = block.title || block.type || 'Block';
                                return `<li class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm flex items-center justify-between">
                                            <span class="font-medium text-slate-800">${escapeHtml(title)}</span>
                                            <span class="text-xs uppercase tracking-wide text-slate-500">${escapeHtml(block.type ?? 'custom')}</span>
                                        </li>`;
                            })
                            .join('')}</ul>`
                      : '<p class="text-sm text-slate-500 mt-3">No blocks in this section yet.</p>';

                  return `
                        <div class="rounded-xl border border-slate-200 bg-white px-5 py-4 shadow-sm">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">${escapeHtml(section.title ?? 'Untitled section')}</p>
                                    <p class="text-xs uppercase tracking-wide text-slate-500">${escapeHtml(section.type ?? 'custom')}</p>
                                </div>
                                ${section.handle ? `<span class="text-xs text-slate-400">#${escapeHtml(section.handle)}</span>` : ''}
                            </div>
                            ${blocksHtml}
                        </div>
                    `;
              })
              .join('')
        : `
            <div class="rounded-xl border border-dashed border-slate-300 bg-white p-10 text-center">
                <h3 class="text-base font-semibold text-slate-800">No sections yet</h3>
                <p class="mt-2 text-sm text-slate-600">Use the builder tools to add sections and blocks to this template.</p>
            </div>
        `;

    const themeName = template.theme?.name ? `<p class="text-xs text-slate-500">Theme: ${escapeHtml(template.theme.name)}</p>` : '';

    canvasEl.innerHTML = `
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">${escapeHtml(template.name)}</h2>
                        <p class="text-sm text-slate-500 mt-1">/${escapeHtml(template.slug)}</p>
                        ${template.description ? `<p class="mt-2 text-sm text-slate-600 max-w-2xl">${escapeHtml(template.description)}</p>` : ''}
                        ${themeName}
                    </div>
                    <div class="flex items-center gap-2">
                        ${templateStatusBadge(template)}
                        ${template.updated_at ? `<span class="text-xs text-slate-400">Updated ${new Date(template.updated_at).toLocaleString()}</span>` : ''}
                    </div>
                </div>
            </div>
            <div class="px-6 py-5 space-y-4">
                ${sectionsHtml}
            </div>
        </div>
    `;

    canvasEmptyStateEl.classList.add('hidden');
    canvasEl.classList.remove('hidden');
}

function normaliseTemplate(template) {
    return {
        ...template,
        id: Number(template.id),
    };
}

async function fetchTemplates() {
    if (!templateListEl) {
        return;
    }

    templateListEl.innerHTML = '<p class="px-6 py-4 text-sm text-slate-500">Loading templates…</p>';

    try {
        const response = await fetch('/admin/page-templates', {
            headers: { Accept: 'application/json' },
        });

        if (!response.ok) {
            throw new Error('Failed to fetch templates');
        }

        const data = await response.json();
        state.templates = Array.isArray(data) ? data.map(normaliseTemplate) : [];
        sortTemplates();

        if (!state.templates.length) {
            state.activeTemplateId = null;
        } else if (!state.activeTemplateId || !state.templates.find((template) => Number(template.id) === Number(state.activeTemplateId))) {
            state.activeTemplateId = state.templates[0].id;
        }

        renderTemplates();
        renderCanvas(state.templates.find((template) => Number(template.id) === Number(state.activeTemplateId)) ?? null);
    } catch (error) {
        console.error(error);
        templateListEl.innerHTML = '<p class="px-6 py-10 text-center text-sm text-rose-600">We could not load the templates. Please refresh the page to try again.</p>';
        showFeedback('Unable to load templates. Please try again.', 'error');
    }
}

function getTemplateById(id) {
    return state.templates.find((template) => Number(template.id) === Number(id));
}

function setActiveTemplate(id) {
    if (!id || Number(id) === Number(state.activeTemplateId)) {
        return;
    }

    state.activeTemplateId = Number(id);
    renderTemplates();
    renderCanvas(getTemplateById(id) ?? null);
}

function updateTemplate(updatedTemplate) {
    const nextTemplates = state.templates.map((template) =>
        Number(template.id) === Number(updatedTemplate.id) ? normaliseTemplate(updatedTemplate) : template,
    );

    state.templates = nextTemplates;
    sortTemplates();
    renderTemplates();
    if (Number(state.activeTemplateId) === Number(updatedTemplate.id)) {
        renderCanvas(getTemplateById(updatedTemplate.id));
    }
}

function removeTemplate(templateId) {
    state.templates = state.templates.filter((template) => Number(template.id) !== Number(templateId));
    if (!state.templates.length) {
        state.activeTemplateId = null;
    } else if (Number(state.activeTemplateId) === Number(templateId)) {
        state.activeTemplateId = state.templates[0].id;
    }

    renderTemplates();
    renderCanvas(getTemplateById(state.activeTemplateId));
}

async function publishTemplate(templateId, button) {
    if (!templateId) {
        return;
    }

    const targetTemplate = getTemplateById(templateId);
    if (!targetTemplate || targetTemplate.status === 'published') {
        return;
    }

    const originalText = button?.textContent;
    if (button) {
        button.disabled = true;
        button.textContent = 'Publishing…';
    }

    try {
        const response = await fetch(`/admin/page-templates/${templateId}/publish`, {
            method: 'POST',
            headers: baseFetchHeaders,
        });

        if (!response.ok) {
            throw new Error('Failed to publish template');
        }

        const updatedTemplate = await response.json();
        updateTemplate(updatedTemplate);
        showFeedback('Template published successfully.');
    } catch (error) {
        console.error(error);
        showFeedback('Publishing failed. Please try again.', 'error');
        if (button) {
            button.disabled = false;
            button.textContent = originalText ?? 'Publish';
        }
        return;
    }
}

async function deleteTemplate(templateId, button) {
    if (!templateId) {
        return;
    }

    if (!window.confirm('Delete this template? This action cannot be undone.')) {
        return;
    }

    const originalText = button?.textContent;
    if (button) {
        button.disabled = true;
        button.textContent = 'Deleting…';
    }

    try {
        const response = await fetch(`/admin/page-templates/${templateId}`, {
            method: 'DELETE',
            headers: baseFetchHeaders,
        });

        if (!response.ok && response.status !== 204) {
            throw new Error('Failed to delete template');
        }

        removeTemplate(templateId);
        showFeedback('Template deleted.');
    } catch (error) {
        console.error(error);
        showFeedback('Deletion failed. Please try again.', 'error');
        if (button) {
            button.disabled = false;
            button.textContent = originalText ?? 'Delete';
        }
    }
}

function handleTemplateListClick(event) {
    const actionButton = event.target.closest('button[data-action]');
    if (actionButton) {
        event.preventDefault();
        event.stopPropagation();
        const templateId = Number(actionButton.closest('[data-template-id]')?.dataset.templateId);

        if (actionButton.dataset.action === 'publish') {
            publishTemplate(templateId, actionButton);
        }

        if (actionButton.dataset.action === 'delete') {
            deleteTemplate(templateId, actionButton);
        }

        return;
    }

    const templateRow = event.target.closest('[data-template-id]');
    if (!templateRow) {
        return;
    }

    const templateId = Number(templateRow.dataset.templateId);
    setActiveTemplate(templateId);
}

function initBuilder() {
    if (!templateListEl) {
        return;
    }

    fetchTemplates();
    templateListEl.addEventListener('click', handleTemplateListClick);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initBuilder);
} else {
    initBuilder();
}
