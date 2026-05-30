@extends('layout')

@section('content')
<section class="service-hero relative isolate overflow-hidden">
    <img src="{{ $visuals['security'] }}" alt="Tekvista authorised product and service partners" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[#020817]/55"></div>
    <div class="absolute inset-0 -z-10" style="background: linear-gradient(105deg, rgba(2,6,23,.95) 0%, rgba(2,6,23,.80) 42%, rgba(2,6,23,.42) 100%);"></div>
    <div class="absolute inset-0 -z-10" style="background: radial-gradient(circle at 16% 48%, rgba(11,184,132,.18), transparent 34rem);"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Authorised Product Services</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">Products Tekvista can sell, deploy, and support for your business</h1>
        <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">Tekvista works with security, cloud, productivity, and infrastructure product ecosystems. These pages explain what we offer, how we deploy it, and how we support customers after purchase.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($productPartners as $slug => $partner)
            <a href="{{ route('product.partner', ['vendor' => $slug]) }}" class="neo-card overflow-hidden transition hover:border-[var(--accent)]">
                <img src="{{ $partner['heroImage'] }}" alt="{{ $partner['name'] }} products by Tekvista" class="h-36 w-full object-cover">
                <div class="p-5">
                    <div class="tv-product-card-logo">
                        <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }} logo">
                    </div>
                    <h2 class="mt-4 text-2xl font-black text-[var(--text)]">{{ $partner['name'] }}</h2>
                    <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $partner['heroSummary'] }}</p>
                    <p class="mt-4 text-sm font-bold text-[var(--accent)]">Open product page <i class="bi bi-arrow-right-short"></i></p>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endsection
