@extends('layout')

@section('content')
<section class="mx-auto max-w-4xl px-4 py-14 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">SEO Authoring</p>
        <h1 class="mt-2 text-3xl font-black text-[var(--text)]">Write Enterprise Blog Post</h1>
        <p class="mt-2 text-sm text-[var(--muted)]">Use practical, industry-focused language for TekVista's enterprise audience.</p>

        <form method="POST" action="{{ route('blog.manage.store') }}" enctype="multipart/form-data" class="mt-6 grid gap-4">
            @csrf
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Title
                <input type="text" name="title" value="{{ old('title') }}" required class="input-field" maxlength="180">
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">SEO slug (optional)
                <input type="text" name="slug" value="{{ old('slug') }}" class="input-field" maxlength="190" placeholder="enterprise-network-hardening-guide">
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Excerpt (optional, auto-generated if empty)
                <textarea name="excerpt" class="input-field" rows="3" maxlength="320">{{ old('excerpt') }}</textarea>
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Content
                <textarea name="content" class="input-field" rows="12" required>{{ old('content') }}</textarea>
            </label>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Header image upload
                    <input type="file" name="hero_image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="input-field">
                    <span class="text-xs font-medium text-[var(--muted)]">Auto-optimized to 1200x630 for header and social meta image.</span>
                </label>
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Or online header image URL
                    <input type="url" name="hero" value="{{ old('hero') }}" class="input-field" placeholder="https://example.com/image.jpg">
                    <span class="text-xs font-medium text-[var(--muted)]">If valid, image will be downloaded and optimized automatically.</span>
                </label>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Categories (comma-separated)
                    <input type="text" name="categories_csv" value="{{ old('categories_csv') }}" class="input-field" placeholder="Cloud, Cybersecurity">
                </label>
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Tags (comma-separated)
                    <input type="text" name="tags_csv" value="{{ old('tags_csv') }}" class="input-field" placeholder="Zero Trust, SD-WAN">
                </label>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Meta title
                    <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="input-field" maxlength="180">
                </label>
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Meta keywords
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" class="input-field" maxlength="320" placeholder="enterprise IT, cloud strategy">
                </label>
            </div>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Meta description
                <textarea name="meta_description" class="input-field" rows="2" maxlength="320">{{ old('meta_description') }}</textarea>
            </label>
            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="btn-primary justify-center">Publish Post</button>
        </form>
    </div>
</section>
@endsection
