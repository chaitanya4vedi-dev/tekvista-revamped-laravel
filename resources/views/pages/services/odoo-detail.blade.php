@extends('layout')

@section('content')
@php
    $relatedServices = [];
    foreach (($odooService['related'] ?? []) as $slug) {
        if (isset($odooServices[$slug])) {
            $relatedServices[$slug] = $odooServices[$slug];
        }
    }

    $whatsAppUrl = 'https://wa.me/919051433313?text=' . rawurlencode('Hello Tekvista Team, we want to discuss ' . $odooService['name'] . '.');
@endphp

<section class="service-hero relative isolate overflow-hidden">
    <img src="{{ $visuals['odoo'] }}" alt="{{ $odooService['name'] }} service by Tekvista" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.82),rgba(5,7,13,0.58),rgba(5,7,13,0.26))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <a href="{{ route('odoo') }}" class="inline-flex items-center rounded-full border border-white/30 bg-white/10 px-4 py-2 text-xs font-bold tracking-wider text-[#def2ff]">
            <i class="bi bi-arrow-left mr-2"></i>Back to Odoo pages
        </a>

        <div class="mt-6 flex flex-wrap items-center gap-3">
            @if (!empty($odooService['logo']))
                <div class="tv-product-hero-logo">
                    <img src="{{ $odooService['logo'] }}" alt="{{ $odooService['logoAlt'] ?? $odooService['name'] }}">
                </div>
            @endif
            <p class="section-kicker hero-kicker-readable">{{ $odooService['heroKicker'] }}</p>
        </div>

        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">{{ $odooService['heroTitle'] }}</h1>
        <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">{{ $odooService['heroSummary'] }}</p>
        <div class="mt-7 flex flex-wrap gap-3">
            <a href="{{ route('contact', ['intent' => $odooService['primaryIntent']]) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>{{ $odooService['primaryIntent'] }}
            </a>
            <a href="{{ $whatsAppUrl }}" target="_blank" rel="noopener" class="btn-secondary btn-secondary-on-dark">
                <i class="bi bi-whatsapp"></i>Discuss on WhatsApp
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Overview</p>
        <h2 class="mt-2 text-3xl font-black text-[var(--text)]">{{ $odooService['summaryTitle'] }}</h2>
        @foreach ($odooService['summaryBody'] as $paragraph)
            <p class="mt-4 text-sm leading-8 text-[var(--muted)]">{{ $paragraph }}</p>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <p class="section-kicker">What We Configure</p>
    <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Key setup areas for {{ $odooService['name'] }}</h2>
    <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($odooService['capabilities'] as $capability)
            <article class="neo-card p-5">
                <h3 class="text-xl font-black text-[var(--text)]">{{ $capability['title'] }}</h3>
                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $capability['copy'] }}</p>
            </article>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-[1fr_1fr]">
        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">Where It Helps</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Common use cases</h2>
            <div class="mt-5 grid gap-3">
                @foreach ($odooService['useCases'] as $useCase)
                    <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                        <h3 class="text-lg font-black text-[var(--text)]">{{ $useCase['title'] }}</h3>
                        <p class="mt-2 text-sm leading-7 text-[var(--muted)]">{{ $useCase['copy'] }}</p>
                    </div>
                @endforeach
            </div>
        </article>

        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">Delivery Steps</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">How we deliver this service</h2>
            <div class="mt-5 grid gap-3">
                @foreach ($odooService['deliveryPhases'] as $phase)
                    <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                        <h3 class="text-lg font-black text-[var(--text)]">{{ $phase['title'] }}</h3>
                        <p class="mt-2 text-sm leading-7 text-[var(--muted)]">{{ $phase['copy'] }}</p>
                    </div>
                @endforeach
            </div>
        </article>
    </div>
</section>

<section class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">Governance</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Controls we include</h2>
            <ul class="mt-5 grid gap-3 text-sm leading-7 text-[var(--muted)]">
                @foreach ($odooService['governance'] as $control)
                    <li class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3"><i class="bi bi-shield-check mr-2 text-[var(--accent)]"></i>{{ $control }}</li>
                @endforeach
            </ul>
        </article>

        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">FAQs</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Common questions</h2>
            <div class="mt-5 grid gap-3">
                @foreach ($odooService['faqs'] as $faq)
                    <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                        <h3 class="text-lg font-black text-[var(--text)]">{{ $faq['q'] }}</h3>
                        <p class="mt-2 text-sm leading-7 text-[var(--muted)]">{{ $faq['a'] }}</p>
                    </div>
                @endforeach
            </div>
        </article>
    </div>
</section>

@if (!empty($relatedServices))
<section class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <p class="section-kicker">Related Odoo Products</p>
    <h2 class="mt-2 text-2xl font-black text-[var(--text)]">You may also need these pages</h2>
    <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($relatedServices as $slug => $service)
            <a href="{{ route('odoo.service', ['odooPage' => $slug]) }}" class="neo-card p-5 transition hover:border-[var(--accent)]">
                <div class="flex items-center gap-3">
                    @if (!empty($service['logo']))
                        <div class="tv-related-product-logo">
                            <img src="{{ $service['logo'] }}" alt="{{ $service['logoAlt'] ?? $service['name'] }}">
                        </div>
                    @endif
                    <h3 class="text-lg font-black text-[var(--text)]">{{ $service['name'] }}</h3>
                </div>
                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $service['cardSummary'] }}</p>
            </a>
        @endforeach
    </div>
</section>
@endif
@endsection
