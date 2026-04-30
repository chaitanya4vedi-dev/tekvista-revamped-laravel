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
                <p class="section-kicker">{{ $post->is_published ? 'Published' : 'Draft' }} / {{ $post->published_on?->format('M d, Y') }}</p>
                <h2 class="mt-2 text-xl font-black text-[var(--text)]">{{ $post->title }}</h2>
                <p class="mt-2 text-sm text-[var(--muted)]">{{ $post->excerpt }}</p>
            </article>
        @empty
            <div class="neo-card p-6 text-sm text-[var(--muted)]">No blog posts yet. Start with your first SEO article.</div>
        @endforelse
    </div>
</section>
@endsection
