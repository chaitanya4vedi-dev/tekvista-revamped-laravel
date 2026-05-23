@extends('layout')

@section('content')
@php
    $whatsAppOdooUrl = 'https://wa.me/919051433313?text=' . rawurlencode('Hello Tekvista Team, we need help with Odoo services.');
@endphp

<section class="service-hero relative isolate overflow-hidden">
    <img src="{{ $visuals['odoo'] }}" alt="Odoo services by Tekvista" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(5,7,13,0.86),rgba(5,7,13,0.62),rgba(5,7,13,0.42))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center text-center">
            <div class="tv-product-hero-logo">
                <img src="{{ asset('images/tekvista/logos/odoo.svg') }}" alt="Odoo color logo">
            </div>
            <p class="mt-5 section-kicker hero-kicker-readable">Odoo Services by Tekvista</p>
            <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">Odoo modules set up in plain and practical way.</h1>
            <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">We implement Odoo for sales, accounting, inventory, production, HR, and more. Our focus is simple workflows your team can actually use every day.</p>
        </div>
        <div class="mt-7 flex flex-wrap justify-center gap-3">
            <a href="{{ route('contact', ['intent' => 'Discuss Odoo services']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Book an Odoo Call
            </a>
            <a href="{{ $whatsAppOdooUrl }}" target="_blank" rel="noopener" class="btn-secondary btn-secondary-on-dark">
                <i class="bi bi-whatsapp"></i>Chat on WhatsApp
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="section-kicker">Odoo Product Pages</p>
            <h2 class="mt-2 text-3xl font-black text-[var(--text)]">Explore our Odoo services</h2>
        </div>
        <p class="text-sm font-semibold text-[var(--muted)]">{{ count($odooServices) }} Odoo products covered</p>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($odooServices as $slug => $service)
            <a href="{{ route('odoo.service', ['odooPage' => $slug]) }}" class="neo-card p-5 transition hover:border-[var(--accent)]">
                <div class="flex items-center gap-3">
                    @if (!empty($service['logo']))
                        <div class="tv-product-card-logo">
                            <img src="{{ $service['logo'] }}" alt="{{ $service['logoAlt'] ?? $service['name'] }}">
                        </div>
                    @else
                        <div class="tv-product-card-logo text-[var(--accent)]"><i class="bi bi-grid-3x3-gap text-lg"></i></div>
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
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Our standard Odoo delivery flow</h2>
        <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            @foreach ([
                ['title' => '1. Scope and process mapping', 'copy' => 'We review your process and decide the right Odoo modules.'],
                ['title' => '2. Configure and customize', 'copy' => 'We set up modules, users, and required business logic.'],
                ['title' => '3. Migrate and test', 'copy' => 'We import data and test with real daily scenarios.'],
                ['title' => '4. Go live and support', 'copy' => 'We train users and support your team post launch.'],
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
