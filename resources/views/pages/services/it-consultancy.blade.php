@extends('layout')

@section('content')
<section class="hero-shell">
    <img src="{{ $visuals['strategy'] }}" alt="IT consultancy strategy workshop" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(95deg,rgba(5,11,20,0.9),rgba(5,11,20,0.7),rgba(5,11,20,0.42))]"></div>

    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">IT Consultancy</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Enterprise IT consulting for measurable business outcomes.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#def2ff]">From technology roadmaps to architecture decisions, Tekvista helps leadership teams align IT investments with operational and growth priorities.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-5 md:grid-cols-2">
        <div class="neo-card p-6"><h2 class="text-2xl font-black">Consulting Scope</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Current-state assessment, gap analysis, transformation roadmap, vendor evaluation, and governance design for enterprise technology programs.</p></div>
        <div class="neo-card p-6"><h2 class="text-2xl font-black">Delivery Model</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Business-first workshops, architecture recommendations, prioritized action plans, and implementation oversight with risk-controlled execution.</p></div>
    </div>
</section>
@endsection
