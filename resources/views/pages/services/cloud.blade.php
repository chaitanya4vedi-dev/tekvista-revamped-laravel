@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['infra'] }}" alt="Enterprise cloud infrastructure" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.95),rgba(5,7,13,0.78),rgba(5,7,13,0.45))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">Cloud Solutions</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Cloud architecture built for reliability, control, and scale.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">Migration, governance, optimization, and managed cloud operations on Microsoft and Google ecosystems.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-3">
    <article class="neo-card p-5"><h2 class="text-xl font-black">Migration Factory</h2><p class="mt-3 text-sm text-[var(--muted)]">Structured migration waves with rollback and uptime protection.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Cloud Governance</h2><p class="mt-3 text-sm text-[var(--muted)]">IAM, backup policy, cost controls, and visibility dashboards.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Managed Operations</h2><p class="mt-3 text-sm text-[var(--muted)]">Performance tuning, patching, and proactive cloud support.</p></article>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Cloud Ecosystem</p>
        <div class="mt-4 grid gap-3 sm:grid-cols-3">
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/microsoft.svg') }}" alt="Microsoft"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/googlecloud.svg') }}" alt="Google Cloud"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/office-365.png') }}" alt="Microsoft 365"></div>
        </div>
    </div>
</section>
@endsection
