@extends('layout')

@section('content')
@php
    $whatsAppUrl = 'https://wa.me/919051433313?text=' . rawurlencode('Hello Tekvista Team, we want to discuss IT solutions for ' . $industryPage['name'] . '.');
@endphp

<section class="service-hero relative isolate overflow-hidden">
    <img src="{{ $industryPage['heroImage'] }}" alt="{{ $industryPage['name'] }} IT solutions by Tekvista" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[#020817]/45"></div>
    <div class="absolute inset-0 -z-10 tv-industry-hero-gradient"></div>
    <div class="absolute inset-0 -z-10 tv-industry-hero-mesh"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <a href="{{ route('industries') }}" class="inline-flex items-center rounded-full border border-white/30 bg-white/10 px-4 py-2 text-xs font-bold tracking-wider text-[#def2ff]">
            <i class="bi bi-arrow-left mr-2"></i>Back to industries
        </a>
        <p class="mt-7 section-kicker hero-kicker-readable">{{ $industryPage['heroKicker'] }}</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">{{ $industryPage['heroTitle'] }}</h1>
        <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">{{ $industryPage['heroSummary'] }}</p>
        <div class="mt-7 flex flex-wrap gap-3">
            <a href="{{ route('contact', ['intent' => 'Discuss ' . $industryPage['name'] . ' IT Solutions']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Discuss {{ $industryPage['name'] }}
            </a>
            <a href="{{ $whatsAppUrl }}" target="_blank" rel="noopener" class="btn-secondary btn-secondary-on-dark">
                <i class="bi bi-whatsapp"></i>Discuss on WhatsApp
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <p class="section-kicker">Industry Focus</p>
    <h2 class="mt-2 text-3xl font-black text-[var(--text)]">Tekvista service areas for {{ $industryPage['name'] }}</h2>
    <div class="mt-5 grid gap-4 md:grid-cols-3">
        @foreach ($industryPage['focus'] as $item)
            <article class="neo-card p-5">
                <h3 class="text-xl font-black text-[var(--text)]">{{ $item['title'] }}</h3>
                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $item['copy'] }}</p>
            </article>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Recommended Products and Services</p>
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Products and services commonly combined for this industry</h2>
        <div class="mt-5 flex flex-wrap gap-3">
            @foreach ($industryPage['services'] as $service)
                <span class="rounded-full border border-[var(--line)] bg-[var(--surface-light)] px-4 py-2 text-sm font-bold text-[var(--text)]">{{ $service }}</span>
            @endforeach
        </div>
    </div>
</section>

@if (count($industryPages) > 1)
    <section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="section-kicker">Other Industries</p>
        <div class="mt-4 grid gap-3 md:grid-cols-3">
            @foreach ($industryPages as $slug => $industry)
                @continue($slug === $industryPage['slug'])
                <a href="{{ route('industry.show', ['industry' => $slug]) }}" class="neo-card p-4 text-sm font-black text-[var(--text)] transition hover:border-[var(--accent)] hover:text-[var(--accent)]">
                    {{ $industry['name'] }} <i class="bi bi-arrow-right-short"></i>
                </a>
            @endforeach
        </div>
    </section>
@endif
@endsection
