@extends('layout')

@section('content')
<article>
    <section class="relative isolate overflow-hidden">
        <img src="{{ $post->hero ?: 'https://images.pexels.com/photos/7414033/pexels-photo-7414033.jpeg?auto=compress&cs=tinysrgb&w=1400' }}" alt="{{ $post->title }}" class="absolute inset-0 -z-20 h-full w-full object-cover">
        <div class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(15,46,41,0.9),rgba(15,46,41,0.72),rgba(15,46,41,0.34))]"></div>
        <div class="mx-auto max-w-5xl px-4 py-20 sm:px-6 lg:px-8">
            <p class="section-kicker">{{ $post->categories->pluck('name')->first() ?: 'Enterprise' }} / {{ $post->read_time }} / {{ optional($post->published_on)->format('F d, Y') }}</p>
            <h1 class="mt-4 text-4xl font-black leading-tight text-white sm:text-6xl">{{ $post->title }}</h1>
            <p class="mt-5 max-w-3xl text-base leading-8 text-[#def7ea]">{{ $post->excerpt }}</p>
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
