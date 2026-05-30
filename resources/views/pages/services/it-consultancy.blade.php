@extends('layout')

@section('content')
<section class="hero-shell">
    <img src="{{ $visuals['strategy'] }}" alt="IT consultancy strategy workshop" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(95deg,rgba(5,11,20,0.8),rgba(5,11,20,0.58),rgba(5,11,20,0.26))]"></div>

    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">IT Consultancy</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Enterprise IT consulting for measurable business outcomes</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#def2ff]">From technology roadmaps to architecture decisions, Tekvista helps leadership teams align IT investments with operational and growth priorities.</p>
        <div class="mt-7">
            <a href="{{ route('contact', ['intent' => 'Book IT Consultancy Session']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-5 md:grid-cols-2">
        <div class="neo-card p-6"><h2 class="text-2xl font-black">Consulting Scope</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Current-state assessment, gap analysis, transformation roadmap, vendor evaluation, and governance design for enterprise technology programs.</p></div>
        <div class="neo-card p-6"><h2 class="text-2xl font-black">Delivery Model</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Business-first workshops, architecture recommendations, prioritized action plans, and implementation oversight with risk-controlled execution.</p></div>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <h2 class="text-2xl font-black text-[var(--text)]">Consulting tracks we run for enterprise teams</h2>
        <div class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-diagram-3-fill mr-2 text-[var(--accent)]"></i>IT governance and policy framework</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-cash-coin mr-2 text-[var(--accent)]"></i>Technology budgeting and vendor strategy</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-building-gear mr-2 text-[var(--accent)]"></i>Infrastructure modernization roadmap</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-clipboard2-data-fill mr-2 text-[var(--accent)]"></i>Quarterly review and execution governance</div>
        </div>
    </div>
</section>
@endsection
