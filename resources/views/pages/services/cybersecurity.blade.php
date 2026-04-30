@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['security'] }}" alt="Cybersecurity operations center" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.95),rgba(5,7,13,0.78),rgba(5,7,13,0.45))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">Cybersecurity</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Enterprise cyber defense with proactive risk control.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">Security architecture, endpoint control, threat monitoring, and compliance-aligned governance for business continuity.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-3">
    <article class="neo-card p-5"><h2 class="text-xl font-black">SOC and MDR</h2><p class="mt-3 text-sm text-[var(--muted)]">24x7 monitoring, incident triage, and guided response playbooks.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Identity and Access</h2><p class="mt-3 text-sm text-[var(--muted)]">MFA, conditional access, and least-privilege rollout across teams.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Compliance Readiness</h2><p class="mt-3 text-sm text-[var(--muted)]">Audit support, policy mapping, and secure baseline controls.</p></article>
</section>
@endsection
