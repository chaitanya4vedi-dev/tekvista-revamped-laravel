@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['zoho'] }}" alt="Zoho enterprise applications" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.82),rgba(5,7,13,0.58),rgba(5,7,13,0.26))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Zoho Solutions</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Zoho implementation for connected business workflows.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">From Zoho Mail and CRM to automation and reporting, Tekvista deploys Zoho with enterprise process design.</p>
        <div class="mt-7">
            <a href="{{ route('contact', ['intent' => 'Discuss Zoho Implementation']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-3">
    <article class="neo-card p-5"><h2 class="text-xl font-black">Zoho One Architecture</h2><p class="mt-3 text-sm text-[var(--muted)]">Sales, support, finance, and operations in one platform blueprint.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">CRM and Automation</h2><p class="mt-3 text-sm text-[var(--muted)]">Lead lifecycle automation and role-based dashboarding for teams.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Zoho Mail and Workplace</h2><p class="mt-3 text-sm text-[var(--muted)]">Domain setup, migration, policy hardening, and continuity support.</p></article>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <div class="mt-2 grid gap-3 sm:grid-cols-2">
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/zoho.svg') }}" alt="Zoho"><p class="logo-chip-name">Zoho One Platform</p></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/zohomail.svg') }}" alt="Zoho Mail"><p class="logo-chip-name">Zoho Mail</p></div>
        </div>
    </div>
</section>
@endsection
