@extends('layout')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <p class="section-kicker">Content Dashboard</p>
            <h1 class="mt-2 text-3xl font-black text-[var(--text)]">Manage Blog Posts</h1>
        </div>
        <a href="{{ route('blog.manage.create') }}" class="btn-primary"><i class="bi bi-plus-circle"></i>Write New Post</a>
    </div>

    @if (session('status'))
        <div class="mt-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
    @endif

    <div class="mt-6 grid gap-4">
        @forelse ($posts as $post)
            <article class="neo-card p-5">
                <p class="section-kicker">
                    @if (!$post->is_published)
                        Draft
                    @elseif($post->published_at && $post->published_at->isFuture())
                        Scheduled / {{ $post->published_at->clone()->timezone('Asia/Kolkata')->format('M d, Y h:i A') }} IST
                    @else
                        Published / {{ optional($post->published_at ?: $post->published_on)->timezone('Asia/Kolkata')->format('M d, Y h:i A') }} IST
                    @endif
                </p>
                <h2 class="mt-2 text-xl font-black text-[var(--text)]">{{ $post->title }}</h2>
                <p class="mt-2 text-sm text-[var(--muted)]">{{ $post->excerpt }}</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    <a href="{{ route('blog.manage.edit', $post->id) }}" class="btn-secondary px-4 py-2 text-xs"><i class="bi bi-pencil-square"></i>Edit</a>
                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" rel="noopener" class="btn-secondary px-4 py-2 text-xs"><i class="bi bi-box-arrow-up-right"></i>Preview</a>
                </div>
            </article>
        @empty
            <div class="neo-card p-6 text-sm text-[var(--muted)]">No blog posts yet. Start with your first SEO article.</div>
        @endforelse
    </div>
</section>
@endsection
