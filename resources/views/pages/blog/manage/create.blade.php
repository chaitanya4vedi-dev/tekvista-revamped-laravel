@extends('layout')

@section('content')
<section class="mx-auto max-w-4xl px-4 py-14 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">SEO Authoring</p>
        <h1 class="mt-2 text-3xl font-black text-[var(--text)]">Write Enterprise Blog Post</h1>
        <p class="mt-2 text-sm text-[var(--muted)]">Use practical, industry-focused language for TekVista's enterprise audience.</p>

        <form method="POST" action="{{ route('blog.manage.store') }}" class="mt-6 grid gap-4">
            @csrf
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Title
                <input type="text" name="title" value="{{ old('title') }}" required class="input-field" maxlength="180">
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Excerpt (SEO summary)
                <textarea name="excerpt" class="input-field" rows="3" required maxlength="320">{{ old('excerpt') }}</textarea>
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Content
                <textarea name="content" class="input-field" rows="12" required>{{ old('content') }}</textarea>
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Hero image URL
                <input type="url" name="hero" value="{{ old('hero') }}" class="input-field">
            </label>
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
