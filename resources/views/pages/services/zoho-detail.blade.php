@extends('layout')

@section('content')
@php
    $icons = [
        'zoho-one' => 'bi-grid-1x2-fill',
        'crm' => 'bi-graph-up-arrow',
        'books' => 'bi-receipt-cutoff',
        'people' => 'bi-people-fill',
        'desk' => 'bi-headset',
        'creator' => 'bi-app-indicator',
        'flow' => 'bi-diagram-3-fill',
        'workplace' => 'bi-envelope-paper-fill',
    ];

    $relatedServices = [];
    foreach (($zohoService['related'] ?? []) as $slug) {
        if (isset($zohoServices[$slug])) {
            $relatedServices[$slug] = $zohoServices[$slug];
        }
    }

    $whatsAppUrl = 'https://wa.me/919051433313?text=' . rawurlencode('Hello Tekvista Team, we want to discuss ' . $zohoService['name'] . ' implementation for our organization.');
@endphp

<section class="service-hero relative isolate overflow-hidden">
    <img src="{{ $visuals['zoho'] }}" alt="{{ $zohoService['name'] }} implementation service" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.82),rgba(5,7,13,0.58),rgba(5,7,13,0.26))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <a href="{{ route('zoho') }}" class="inline-flex items-center rounded-full border border-white/30 bg-white/10 px-4 py-2 text-xs font-bold tracking-wider text-[#def2ff]">
            <i class="bi bi-arrow-left mr-2"></i>Back to Zoho Services
        </a>
        <p class="section-kicker hero-kicker-readable mt-5">{{ $zohoService['heroKicker'] }}</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">{{ $zohoService['heroTitle'] }}</h1>
        <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">{{ $zohoService['heroSummary'] }}</p>
        <div class="mt-7 flex flex-wrap gap-3">
            <a href="{{ route('contact', ['intent' => $zohoService['primaryIntent']]) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>{{ $zohoService['primaryIntent'] }}
            </a>
            <a href="{{ $whatsAppUrl }}" target="_blank" rel="noopener" class="btn-secondary btn-secondary-on-dark">
                <i class="bi bi-whatsapp"></i>Discuss on WhatsApp
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Official Zoho Partner</p>
        <h2 class="mt-2 text-3xl font-black text-[var(--text)]">{{ $zohoService['summaryTitle'] }}</h2>
        @foreach ($zohoService['summaryBody'] as $paragraph)
            <p class="mt-4 text-sm leading-8 text-[var(--muted)]">{{ $paragraph }}</p>
        @endforeach
        <p class="mt-4 text-sm leading-8 text-[var(--muted)]">Tekvista delivers this through enterprise process governance, security-first configuration, and adoption-focused handholding for teams.</p>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <p class="section-kicker">Core Capabilities</p>
    <h2 class="mt-2 text-2xl font-black text-[var(--text)]">What we implement for {{ $zohoService['name'] }}</h2>
    <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($zohoService['capabilities'] as $capability)
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
            <p class="section-kicker">Business Fit</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">When this service creates immediate value</h2>
            <div class="mt-5 grid gap-3">
                @foreach ($zohoService['useCases'] as $useCase)
                    <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                        <h3 class="text-lg font-black text-[var(--text)]">{{ $useCase['title'] }}</h3>
                        <p class="mt-2 text-sm leading-7 text-[var(--muted)]">{{ $useCase['copy'] }}</p>
                    </div>
                @endforeach
            </div>
        </article>

        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">Delivery Phases</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">How Tekvista executes {{ $zohoService['name'] }}</h2>
            <div class="mt-5 grid gap-3">
                @foreach ($zohoService['deliveryPhases'] as $phase)
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
            <p class="section-kicker">Governance Framework</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Enterprise controls we apply</h2>
            <ul class="mt-5 grid gap-3 text-sm leading-7 text-[var(--muted)]">
                @foreach ($zohoService['governance'] as $control)
                    <li class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3"><i class="bi bi-shield-check mr-2 text-[var(--accent)]"></i>{{ $control }}</li>
                @endforeach
            </ul>
        </article>

        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">Service FAQ</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Common questions</h2>
            <div class="mt-5 grid gap-3">
                @foreach ($zohoService['faqs'] as $faq)
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
    <p class="section-kicker">Related Zoho Pages</p>
    <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Continue exploring the Zoho stack</h2>
    <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($relatedServices as $slug => $service)
            <a href="{{ route('zoho.service', ['zohoPage' => $slug]) }}" class="neo-card p-5 transition hover:border-[var(--accent)]">
                <h3 class="text-xl font-black text-[var(--text)]"><i class="bi {{ $icons[$slug] ?? 'bi-stars' }} mr-2 text-[var(--accent)]"></i>{{ $service['name'] }}</h3>
                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $service['cardSummary'] }}</p>
            </a>
        @endforeach
    </div>
</section>
@endif
@endsection
