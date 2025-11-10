@extends('layouts.admin')

@section('title', 'Visual Builder')

@section('content')
<div class="space-y-10">
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
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Templates</h2>
                        <p class="text-sm text-slate-600">Manage reusable layouts. Select one to inspect its sections and blocks.</p>
                    </div>
                    <span class="text-xs font-medium text-slate-500">{{ $templates->count() }} templates</span>
                </div>
                <div class="divide-y divide-slate-100" id="builder-template-list">
                    @forelse($templates as $template)
                        <article class="px-6 py-4 hover:bg-slate-50 transition flex items-start justify-between" data-template-id="{{ $template->id }}">
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

            <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center" id="builder-canvas-empty-state">
                <svg class="mx-auto h-12 w-12 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.5l16.5 0M3.75 9.75l16.5 0M3.75 15l16.5 0M3.75 20.25l16.5 0" />
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-slate-800">Select a template to begin editing</h3>
                <p class="mt-2 text-sm text-slate-600">Sections and blocks will appear here once a template is active. Drag, reorder, and customise each block directly from the builder sidebar.</p>
            </div>
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
                </div>
            </div>
        </aside>
    </section>
</div>
@endsection

@push('scripts')
<script type="module">
    const templateList = document.querySelector('#builder-template-list');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    async function publishTemplate(id) {
        await fetch(`/admin/page-templates/${id}/publish`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
        });
    }

    async function deleteTemplate(id) {
        await fetch(`/admin/page-templates/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
        });
    }

    templateList?.addEventListener('click', async (event) => {
        const button = event.target.closest('button[data-action]');
        if (!button) return;

        const row = button.closest('[data-template-id]');
        const templateId = row?.dataset.templateId;
        if (!templateId) return;

        if (button.dataset.action === 'publish') {
            await publishTemplate(templateId);
            window.location.reload();
        }
        if (button.dataset.action === 'delete') {
            if (confirm('Delete this template? This action cannot be undone.')) {
                await deleteTemplate(templateId);
                window.location.reload();
            }
        }
    });
</script>
@endpush
