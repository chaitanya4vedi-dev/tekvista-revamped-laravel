@extends('layout')

@section('content')
@php
    $whatsAppUrl = 'https://wa.me/919051433313?text=' . rawurlencode('Hello Tekvista Team, we want to discuss ' . $partner['name'] . ' products and services.');
@endphp

<section class="service-hero relative isolate overflow-hidden">
    <img src="{{ $partner['heroImage'] }}" alt="{{ $partner['name'] }} products and services by Tekvista" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[#020817]/55"></div>
    <div class="absolute inset-0 -z-10" style="background: linear-gradient(110deg, rgba(2,6,23,.96) 0%, rgba(2,6,23,.82) 42%, rgba(2,6,23,.44) 100%);"></div>
    <div class="absolute inset-0 -z-10" style="background: radial-gradient(circle at 18% 50%, rgba(11,184,132,.18), transparent 34rem);"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col items-start gap-5">
            <div class="tv-product-hero-logo">
                <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }} logo">
            </div>
            <div>
                <p class="section-kicker hero-kicker-readable">{{ $partner['heroKicker'] }}</p>
                <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">{{ $partner['heroTitle'] }}</h1>
                <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">{{ $partner['heroSummary'] }}</p>
            </div>
        </div>
        <div class="mt-7 flex flex-wrap gap-3">
            <a href="{{ route('contact', ['intent' => $partner['primaryIntent']]) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>{{ $partner['primaryIntent'] }}
            </a>
            <a href="{{ $whatsAppUrl }}" target="_blank" rel="noopener" class="btn-secondary btn-secondary-on-dark">
                <i class="bi bi-whatsapp"></i>Discuss on WhatsApp
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Authorised Product Services</p>
        <h2 class="mt-2 text-3xl font-black text-[var(--text)]">{{ $partner['overviewTitle'] }}</h2>
        @foreach ($partner['overviewBody'] as $paragraph)
            <p class="mt-4 text-sm leading-8 text-[var(--muted)]">{{ $paragraph }}</p>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <p class="section-kicker">Products We Offer</p>
    <h2 class="mt-2 text-2xl font-black text-[var(--text)]">{{ $partner['name'] }} products Tekvista can supply and support</h2>
    <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($partner['products'] as $product)
            <article class="neo-card p-5">
                <h3 class="text-xl font-black text-[var(--text)]">{{ $product['title'] }}</h3>
                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $product['copy'] }}</p>
            </article>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-[1fr_0.9fr]">
        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">How We Deliver</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Procurement, deployment, and support flow</h2>
            <div class="mt-5 grid gap-3">
                @foreach ($partner['delivery'] as $step)
                    <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm font-semibold leading-7 text-[var(--text)]">
                        <i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>{{ $step }}
                    </div>
                @endforeach
            </div>
        </article>

        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">Related Tekvista Services</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Where this product stack fits</h2>
            <div class="mt-5 grid gap-3">
                @foreach ($partner['relatedRoutes'] as $related)
                    <a href="{{ route($related['route']) }}" class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm font-black text-[var(--text)] transition hover:border-[var(--accent)] hover:text-[var(--accent)]">
                        {{ $related['label'] }} <i class="bi bi-arrow-right-short"></i>
                    </a>
                @endforeach
            </div>
        </article>
    </div>
</section>
@endsection
