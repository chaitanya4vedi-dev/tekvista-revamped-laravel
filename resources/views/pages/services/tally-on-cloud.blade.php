@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['infra'] }}" alt="Tally on cloud infrastructure" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.95),rgba(5,7,13,0.78),rgba(5,7,13,0.45))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">Tally on Cloud</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Business-critical Tally access with secure cloud uptime.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">Dedicated hosting for Tally workloads with backup automation, security controls, and multi-user access planning.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-3">
    <article class="neo-card p-5"><h2 class="text-xl font-black">Always-on Access</h2><p class="mt-3 text-sm text-[var(--muted)]">Access Tally securely from office, branch, or remote locations.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Disaster Recovery</h2><p class="mt-3 text-sm text-[var(--muted)]">Scheduled backups and rapid restore controls for finance continuity.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Performance Tuning</h2><p class="mt-3 text-sm text-[var(--muted)]">Right-sized compute and storage for smooth concurrent operations.</p></article>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <div class="mt-2 grid gap-3 sm:grid-cols-2">
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/tally.png') }}" alt="Tally"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/googlecloud.svg') }}" alt="Cloud hosting"></div>
        </div>
    </div>
</section>
@endsection
