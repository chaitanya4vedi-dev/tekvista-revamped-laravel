@extends('layout')

@section('content')
<section class="relative isolate overflow-hidden">
    <div class="absolute inset-0 -z-20 bg-[linear-gradient(110deg,#effcf6,#e6f8ef,#f6fffb)]"></div>
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_20%_20%,rgba(11,184,132,0.14),transparent_40%),radial-gradient(circle_at_85%_10%,rgba(58,168,107,0.18),transparent_36%)]"></div>
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <p class="section-kicker">Tekvista insights</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-[var(--text)] sm:text-6xl">Enterprise technology blog ecosystem</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[var(--muted)]">Practical implementation playbooks for cloud, cybersecurity, networking, Zoho, Odoo, and modern IT operations.</p>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 pb-5 sm:px-6 lg:px-8">
    <form method="GET" action="{{ route('blog.index') }}" class="neo-card p-4 sm:p-5">
        <div class="grid gap-3 md:grid-cols-[2fr_1fr_1fr_auto]">
            <input type="text" name="q" value="{{ $searchQuery }}" placeholder="Search articles, tags, or topics" class="rounded-xl border border-[var(--line)] bg-white px-4 py-2.5 text-sm text-[var(--text)] outline-none">
            <select name="category" class="rounded-xl border border-[var(--line)] bg-white px-3 py-2.5 text-sm text-[var(--text)]">
                <option value="">All categories</option>
                @foreach ($allCategories as $name => $count)
                    <option value="{{ \Illuminate\Support\Str::slug($name) }}" @selected(\Illuminate\Support\Str::slug($selectedCategory) === \Illuminate\Support\Str::slug($name))>{{ $name }} ({{ $count }})</option>
                @endforeach
            </select>
            <select name="tag" class="rounded-xl border border-[var(--line)] bg-white px-3 py-2.5 text-sm text-[var(--text)]">
                <option value="">All tags</option>
                @foreach ($allTags as $name => $count)
                    <option value="{{ \Illuminate\Support\Str::slug($name) }}" @selected(\Illuminate\Support\Str::slug($selectedTag) === \Illuminate\Support\Str::slug($name))>{{ $name }} ({{ $count }})</option>
                @endforeach
            </select>
            <button type="submit" class="btn-primary justify-center"><i class="bi bi-search"></i>Filter</button>
        </div>
    </form>
</section>

<section class="mx-auto max-w-7xl px-4 pb-10 sm:px-6 lg:px-8">
    @if ($posts->isEmpty())
        <div class="neo-card p-8 text-center">
            <h2 class="text-2xl font-black">No posts matched your filters</h2>
            <p class="mt-2 text-sm text-[var(--muted)]">Try removing one or more filters to discover more insights.</p>
            <a href="{{ route('blog.index') }}" class="btn-secondary mt-4">Reset filters</a>
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2">
            @foreach ($posts as $post)
                <article class="neo-card group overflow-hidden">
                    <div class="relative">
                        <img src="{{ $post->hero ?: 'https://images.pexels.com/photos/7414033/pexels-photo-7414033.jpeg?auto=compress&cs=tinysrgb&w=1400' }}" alt="{{ $post->title }}" class="h-64 w-full object-cover transition duration-300 group-hover:scale-105">
                        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-24 bg-[linear-gradient(180deg,rgba(255,255,255,0),rgba(6,26,43,0.45))]"></div>
                    </div>
                    <div class="p-6">
                        <p class="section-kicker">{{ $post->categories->pluck('name')->first() ?: 'Enterprise' }} / {{ $post->read_time }} / {{ optional($post->published_on)->timezone('Asia/Kolkata')->format('F d, Y') }}</p>
                        <h2 class="mt-3 text-2xl font-black leading-8 text-[var(--text)]">{{ $post->title }}</h2>
                        <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $post->excerpt }}</p>
                        <div class="mt-3 flex items-center gap-3 rounded-xl border border-[var(--line)] bg-[var(--surface-light)] px-3 py-2 text-xs text-[var(--muted)]">
                            <img src="{{ $post->author?->avatar_url ?: 'https://ui-avatars.com/api/?name='.urlencode($post->author?->name ?? 'Tekvista Team').'&background=0B5C52&color=fff&size=120' }}" alt="{{ $post->author?->name ?? 'Tekvista Team' }}" class="h-9 w-9 rounded-full border border-[var(--line)] object-cover">
                            <div>
                                By <span class="font-semibold text-[var(--text)]">{{ $post->author?->name ?? 'Tekvista Team' }}</span>
                                @if($post->author?->job_title)
                                    ({{ $post->author->job_title }})
                                @endif
                                @if($post->author?->username)
                                    · {{ '@'.$post->author->username }}
                                @endif
                            </div>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('blog.index', ['tag' => \Illuminate\Support\Str::slug($tag->name)]) }}" class="rounded-full border border-[var(--line)] px-2.5 py-1 text-xs font-semibold text-[var(--muted)]">#{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn-secondary mt-5 px-4 py-2 text-sm">Read article</a>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection
