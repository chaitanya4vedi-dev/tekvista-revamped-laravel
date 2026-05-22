@extends('layout')

@section('content')
@php
    $whatsAppZohoUrl = 'https://wa.me/919051433313?text=' . rawurlencode('Hello Tekvista Team, we need help with Zoho services.');
@endphp

<section class="service-hero relative isolate overflow-hidden">
    <img src="{{ $visuals['zoho'] }}" alt="Zoho services by Tekvista" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.82),rgba(5,7,13,0.58),rgba(5,7,13,0.26))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Zoho Services by Tekvista</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">Simple, practical Zoho setup for real business teams.</h1>
        <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">We help you choose the right Zoho products, set them up the right way, and support your team after go live. From CRM and finance to HR and operations, we keep things clear and easy to use.</p>
        <div class="mt-7 flex flex-wrap gap-3">
            <a href="{{ route('contact', ['intent' => 'Discuss Zoho services']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Book a Zoho Call
            </a>
            <a href="{{ $whatsAppZohoUrl }}" target="_blank" rel="noopener" class="btn-secondary btn-secondary-on-dark">
                <i class="bi bi-whatsapp"></i>Chat on WhatsApp
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="section-kicker">Zoho Product Pages</p>
            <h2 class="mt-2 text-3xl font-black text-[var(--text)]">Explore each Zoho service page</h2>
        </div>
        <p class="text-sm font-semibold text-[var(--muted)]">{{ count($zohoServices) }} Zoho products covered</p>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($zohoServices as $slug => $service)
            <a href="{{ route('zoho.service', ['zohoPage' => $slug]) }}" class="neo-card p-5 transition hover:border-[var(--accent)]">
                <div class="flex items-center gap-3">
                    @if (!empty($service['logo']))
                        <div class="grid size-12 shrink-0 place-items-center rounded-xl border border-[var(--line)] bg-white p-1 sm:size-14">
                            <img src="{{ $service['logo'] }}" alt="{{ $service['logoAlt'] ?? $service['name'] }}" class="h-8 w-8 object-contain sm:h-10 sm:w-10">
                        </div>
                    @else
                        <div class="grid size-12 shrink-0 place-items-center rounded-xl border border-[var(--line)] bg-[var(--surface-light)] text-[var(--accent)] sm:size-14"><i class="bi bi-stars text-lg"></i></div>
                    @endif
                    <h3 class="text-xl font-black text-[var(--text)]">{{ $service['name'] }}</h3>
                </div>
                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $service['cardSummary'] }}</p>
                <p class="mt-4 text-sm font-bold text-[var(--accent)]">Open page <i class="bi bi-arrow-right-short"></i></p>
            </a>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">How We Work</p>
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Four steps we follow for most Zoho rollouts</h2>
        <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            @foreach ([
                ['title' => '1. Understand your process', 'copy' => 'We learn how your team works today and what needs to improve.'],
                ['title' => '2. Configure and automate', 'copy' => 'We set up apps, fields, rules, and simple approvals.'],
                ['title' => '3. Migrate and test', 'copy' => 'We move data and test carefully with your team.'],
                ['title' => '4. Go live and support', 'copy' => 'We train users and keep improving after launch.'],
            ] as $step)
                <article class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                    <h3 class="text-lg font-black text-[var(--text)]">{{ $step['title'] }}</h3>
                    <p class="mt-2 text-sm leading-7 text-[var(--muted)]">{{ $step['copy'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
