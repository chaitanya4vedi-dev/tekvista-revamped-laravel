@extends('layout')

@section('content')
@php
    $publishedDate = optional($post->published_on)->timezone('Asia/Kolkata');
    $author = $post->author;
    $articleSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $post->title,
        'description' => $post->excerpt,
        'datePublished' => $publishedDate?->toIso8601String(),
        'dateModified' => optional($post->updated_at)->timezone('Asia/Kolkata')->toIso8601String(),
        'author' => [
            '@type' => 'Person',
            'name' => $author?->name ?? 'Tekvista Team',
            'description' => $author?->job_title,
            'url' => $author?->website_url,
            'sameAs' => array_values(array_filter([$author?->linkedin_url])),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Tekvista Infosolutions Private Limited',
            'url' => url('/'),
        ],
        'mainEntityOfPage' => url()->current(),
        'image' => $post->hero,
    ];
@endphp
<script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES) !!}</script>
<article>
    <section class="relative isolate overflow-hidden">
        <img src="{{ $post->hero ?: 'https://images.pexels.com/photos/7414033/pexels-photo-7414033.jpeg?auto=compress&cs=tinysrgb&w=1400' }}" alt="{{ $post->title }}" class="absolute inset-0 -z-20 h-full w-full object-cover">
        <div class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(15,46,41,0.9),rgba(15,46,41,0.72),rgba(15,46,41,0.34))]"></div>
        <div class="mx-auto max-w-5xl px-4 py-20 sm:px-6 lg:px-8">
            <p class="section-kicker">{{ $post->categories->pluck('name')->first() ?: 'Enterprise' }} / {{ $post->read_time }} / {{ $publishedDate?->format('F d, Y h:i A') }} IST</p>
            <h1 class="mt-4 text-4xl font-black leading-tight text-white sm:text-6xl">{{ $post->title }}</h1>
            <p class="mt-5 max-w-3xl text-base leading-8 text-[#def7ea]">{{ $post->excerpt }}</p>
            <div class="mt-5 rounded-2xl border border-white/30 bg-white/10 p-4 text-sm text-white/95">
                <div class="flex items-start gap-3">
                    <img src="{{ $author?->avatar_url ?: 'https://ui-avatars.com/api/?name='.urlencode($author?->name ?? 'Tekvista Team').'&background=0B5C52&color=fff&size=200' }}" alt="{{ $author?->name ?? 'Tekvista Team' }}" class="h-14 w-14 rounded-full border border-white/40 object-cover">
                    <div>
                        <p class="font-semibold">By {{ $author?->name ?? 'Tekvista Team' }} @if($author?->username) · @{{ $author->username }} @endif</p>
                        @if($author?->job_title || $author?->department)
                            <p class="mt-1 text-white/80">{{ collect([$author?->job_title, $author?->department])->filter()->implode(' · ') }}</p>
                        @endif
                        @if($author?->bio)
                            <p class="mt-2 text-white/80">{{ $author->bio }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($post->tags as $tag)
                    <a href="{{ route('blog.index', ['tag' => \Illuminate\Support\Str::slug($tag->name)]) }}" class="rounded-full border border-white/30 bg-white/10 px-2.5 py-1 text-xs font-semibold text-white">#{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto mt-10 max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="neo-card space-y-6 p-7 text-base leading-8 text-[var(--text)]">
            @foreach (preg_split('/\n\n+/', trim($post->content)) as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>
    </section>
</article>

<section class="mx-auto mt-14 max-w-7xl px-4 pb-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-black text-[var(--text)]">Related Posts</h2>
    <div class="mt-5 grid gap-5 md:grid-cols-3">
        @foreach ($relatedPosts as $item)
            <a href="{{ route('blog.show', $item->slug) }}" class="neo-card">
                <img src="{{ $item->hero ?: 'https://images.pexels.com/photos/7414033/pexels-photo-7414033.jpeg?auto=compress&cs=tinysrgb&w=1400' }}" alt="{{ $item->title }}" class="h-40 w-full object-cover">
                <div class="p-4">
                    <p class="section-kicker">{{ $item->categories->pluck('name')->first() ?: 'Enterprise' }}</p>
                    <h3 class="mt-2 text-base font-black text-[var(--text)]">{{ $item->title }}</h3>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endsection
