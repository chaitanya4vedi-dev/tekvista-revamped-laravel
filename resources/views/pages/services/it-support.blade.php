@extends('layout')

@section('content')
<section class="hero-shell">
    <img src="{{ $visuals['support'] }}" alt="IT support operations" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(95deg,rgba(5,11,20,0.9),rgba(5,11,20,0.7),rgba(5,11,20,0.42))]"></div>

    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">IT Support</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Reliable support operations for business continuity.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#def2ff]">Tekvista provides structured incident management, proactive maintenance, and escalation-ready support for mission-critical enterprise environments.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-5 md:grid-cols-3">
        <div class="neo-card p-6"><h2 class="text-xl font-black">Monitoring</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Proactive health checks, alerting, and performance observation across infrastructure and key services.</p></div>
        <div class="neo-card p-6"><h2 class="text-xl font-black">Response</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">SLA-oriented incident triage, root-cause isolation, and restoration workflows with clear communication.</p></div>
        <div class="neo-card p-6"><h2 class="text-xl font-black">Lifecycle</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Patch management, upgrade planning, and reliability improvements to reduce recurring issues.</p></div>
    </div>
</section>
@endsection
