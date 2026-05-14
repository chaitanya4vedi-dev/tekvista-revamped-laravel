@extends('layout')

@section('content')
@php
    $isEdit = $mode === 'edit' && $post !== null;
    $currentCategories = old('categories_csv', $isEdit ? $post->categories->pluck('name')->implode(', ') : '');
    $currentTags = old('tags_csv', $isEdit ? $post->tags->pluck('name')->implode(', ') : '');
    $currentPublishMode = old('publish_mode', $isEdit ? (($post->is_published && $post->published_at && $post->published_at->isFuture()) ? 'schedule' : ($post->is_published ? 'publish' : 'draft')) : 'publish');
    $currentPublishAt = old('publish_at', $isEdit && $post->published_at ? $post->published_at->clone()->timezone('Asia/Kolkata')->format('Y-m-d\\TH:i') : now('Asia/Kolkata')->addHour()->format('Y-m-d\\TH:i'));
@endphp
<section class="mx-auto max-w-4xl overflow-x-hidden px-3 py-10 sm:px-6 lg:px-8">
    <div class="neo-card min-w-0 overflow-hidden p-4 sm:p-8">
        <p class="section-kicker">SEO Authoring</p>
        <h1 class="mt-2 break-words text-2xl font-black text-[var(--text)] sm:text-3xl">{{ $isEdit ? 'Edit Enterprise Blog Post' : 'Write Enterprise Blog Post' }}</h1>
        <p class="mt-2 text-sm text-[var(--muted)]">Publishing timezone for all posts is fixed to Asia/Kolkata.</p>

        <form method="POST" action="{{ $isEdit ? route('blog.manage.update', $post->id) : route('blog.manage.store') }}" enctype="multipart/form-data" class="mt-6 grid min-w-0 gap-4">
            @csrf
            @if($isEdit)
                @method('PATCH')
            @endif

            <label class="grid min-w-0 gap-2 text-sm font-bold text-[var(--text)]">Title
                <input type="text" name="title" value="{{ old('title', $isEdit ? $post->title : '') }}" required class="input-field w-full min-w-0" maxlength="180">
            </label>
            <label class="grid min-w-0 gap-2 text-sm font-bold text-[var(--text)]">SEO slug (optional)
                <input type="text" name="slug" value="{{ old('slug', $isEdit ? $post->slug : '') }}" class="input-field w-full min-w-0" maxlength="190" placeholder="enterprise-network-hardening-guide">
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Excerpt (optional, auto-generated if empty)
                <textarea name="excerpt" class="input-field w-full min-w-0" rows="3" maxlength="320">{{ old('excerpt', $isEdit ? $post->excerpt : '') }}</textarea>
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Content
                <textarea id="content-editor" name="content" class="input-field w-full min-w-0" rows="14" required>{{ old('content', $isEdit ? $post->content : '') }}</textarea>
                <span class="text-xs font-medium text-[var(--muted)]">Minimum recommended content length: 40 characters.</span>
            </label>

            <div class="grid min-w-0 gap-4 sm:grid-cols-2">
                <label class="grid min-w-0 gap-2 text-sm font-bold text-[var(--text)]">Header image upload
                    <input type="file" name="hero_image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="input-field w-full min-w-0">
                    <span class="text-xs font-medium text-[var(--muted)]">Auto-optimized to 1200x630 for header and social meta image.</span>
                </label>
                <label class="grid min-w-0 gap-2 text-sm font-bold text-[var(--text)]">Or online header image URL
                    <input type="url" name="hero" value="{{ old('hero', $isEdit ? $post->hero : '') }}" class="input-field w-full min-w-0" placeholder="https://example.com/image.jpg">
                    <span class="text-xs font-medium text-[var(--muted)]">If valid, image will be downloaded and optimized automatically.</span>
                </label>
            </div>

            <div class="grid min-w-0 gap-4 sm:grid-cols-2">
                <label class="grid min-w-0 gap-2 text-sm font-bold text-[var(--text)]">Publish mode
                    <select name="publish_mode" class="input-field w-full min-w-0">
                        <option value="draft" @selected($currentPublishMode === 'draft')>Draft</option>
                        <option value="publish" @selected($currentPublishMode === 'publish')>Publish now</option>
                        <option value="schedule" @selected($currentPublishMode === 'schedule')>Schedule</option>
                    </select>
                </label>
                <label class="grid min-w-0 gap-2 text-sm font-bold text-[var(--text)]">Publish date/time (Asia/Kolkata)
                    <input type="datetime-local" name="publish_at" value="{{ $currentPublishAt }}" class="input-field w-full min-w-0">
                </label>
            </div>

            <div class="grid min-w-0 gap-4 sm:grid-cols-2">
                <label class="grid min-w-0 gap-2 text-sm font-bold text-[var(--text)]">Categories (comma-separated)
                    <input type="text" name="categories_csv" value="{{ $currentCategories }}" class="input-field w-full min-w-0" placeholder="Cloud, Cybersecurity">
                    <span class="text-xs font-medium text-[var(--muted)]">Optional. If empty, category defaults to "General".</span>
                </label>
                <label class="grid min-w-0 gap-2 text-sm font-bold text-[var(--text)]">Tags (comma-separated)
                    <input type="text" name="tags_csv" value="{{ $currentTags }}" class="input-field w-full min-w-0" placeholder="Zero Trust, SD-WAN">
                </label>
            </div>

            <div class="grid min-w-0 gap-4 sm:grid-cols-2">
                <label class="grid min-w-0 gap-2 text-sm font-bold text-[var(--text)]">Meta title
                    <input type="text" name="meta_title" value="{{ old('meta_title', $isEdit ? $post->meta_title : '') }}" class="input-field w-full min-w-0" maxlength="180">
                </label>
                <label class="grid min-w-0 gap-2 text-sm font-bold text-[var(--text)]">Meta keywords
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $isEdit ? $post->meta_keywords : '') }}" class="input-field w-full min-w-0" maxlength="320" placeholder="enterprise IT, cloud strategy">
                </label>
            </div>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Meta description
                <textarea name="meta_description" class="input-field w-full min-w-0" rows="2" maxlength="320">{{ old('meta_description', $isEdit ? $post->meta_description : '') }}</textarea>
            </label>

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">
                    <p class="font-semibold">Please fix the following:</p>
                    <ul class="mt-2 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="btn-primary justify-center">{{ $isEdit ? 'Update Post' : 'Save Post' }}</button>
        </form>
    </div>
</section>

<style>
    .input-field {
        max-width: 100%;
    }
    .ck-editor {
        max-width: 100%;
    }
    .ck,
    .ck-editor__main,
    .ck-editor__editable,
    .ck-content {
        max-width: 100%;
        min-width: 0;
        overflow-wrap: anywhere;
        word-break: break-word;
    }
    .ck.ck-editor__main {
        overflow-x: hidden;
    }
    .ck-content p,
    .ck-content li,
    .ck-content h1,
    .ck-content h2,
    .ck-content h3,
    .ck-content h4,
    .ck-content blockquote,
    .ck-content a,
    .ck-content span {
        overflow-wrap: anywhere;
        word-break: break-word;
    }
    .ck-content img,
    .ck-content video,
    .ck-content iframe {
        max-width: 100%;
        height: auto;
    }
    .ck-content table {
        display: block;
        max-width: 100%;
        overflow-x: auto;
    }
    .ck-content pre {
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        word-break: break-word;
    }
    .ck.ck-toolbar {
        flex-wrap: wrap;
        row-gap: 6px;
        width: 100%;
    }
    .ck.ck-editor__main > .ck-editor__editable {
        min-height: 280px;
        width: 100%;
    }
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#content-editor'), {
        toolbar: [
            'heading', '|',
            'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
            'blockQuote', 'insertTable', 'undo', 'redo'
        ]
    }).catch((error) => {
        console.error(error);
    });
</script>
@endsection
