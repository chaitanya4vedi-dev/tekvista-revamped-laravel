@extends('layout')

@section('content')
@php
    $icons = [
        'zoho-one' => 'bi-grid-1x2-fill',
        'crm' => 'bi-graph-up-arrow',
        'books' => 'bi-receipt-cutoff',
        'people' => 'bi-people-fill',
        'desk' => 'bi-headset',
        'creator' => 'bi-app-indicator',
        'flow' => 'bi-diagram-3-fill',
        'workplace' => 'bi-envelope-paper-fill',
    ];

    $whatsAppZohoUrl = 'https://wa.me/919051433313?text=' . rawurlencode('Hello Tekvista Team, we need enterprise Zoho implementation support. Please share next steps.');
@endphp

<section class="service-hero relative isolate overflow-hidden">
    <img src="{{ $visuals['zoho'] }}" alt="Zoho enterprise applications implementation" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.82),rgba(5,7,13,0.58),rgba(5,7,13,0.26))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Official Zoho Partner Services</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">Enterprise-grade Zoho implementation built for business outcomes.</h1>
        <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">Tekvista delivers structured Zoho consulting, implementation, migration, automation, and managed support across CRM, finance, HR, support, collaboration, and low-code workflows. Every rollout is tailored to your business model, governance standards, and adoption goals.</p>
        <div class="mt-7 flex flex-wrap gap-3">
            <a href="{{ route('contact', ['intent' => 'Discuss Enterprise Zoho Program']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Book Zoho Consultation
            </a>
            <a href="{{ $whatsAppZohoUrl }}" target="_blank" rel="noopener" class="btn-secondary btn-secondary-on-dark">
                <i class="bi bi-whatsapp"></i>Talk on WhatsApp
            </a>
        </div>
        <div class="mt-8 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-white/30 bg-white/10 p-4 text-sm text-[#d5edf6]">Official Zoho partner-led consulting and implementation.</div>
            <div class="rounded-xl border border-white/30 bg-white/10 p-4 text-sm text-[#d5edf6]">Enterprise architecture aligned to your operating model.</div>
            <div class="rounded-xl border border-white/30 bg-white/10 p-4 text-sm text-[#d5edf6]">Data migration, integration, and automation delivery.</div>
            <div class="rounded-xl border border-white/30 bg-white/10 p-4 text-sm text-[#d5edf6]">Post go-live enablement, governance, and optimization.</div>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex items-end justify-between gap-4">
        <div>
            <p class="section-kicker">Zoho Service Portfolio</p>
            <h2 class="mt-2 text-3xl font-black text-[var(--text)]">Detailed Zoho pages for every critical business function</h2>
        </div>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($zohoServices as $slug => $service)
            <a href="{{ route('zoho.service', ['zohoPage' => $slug]) }}" class="neo-card p-5 transition hover:border-[var(--accent)]">
                <p class="text-xs font-mono font-bold tracking-wider text-[var(--accent)]">{{ strtoupper($service['name']) }}</p>
                <h3 class="mt-2 text-2xl font-black text-[var(--text)]"><i class="bi {{ $icons[$slug] ?? 'bi-stars' }} mr-2 text-[var(--accent)]"></i>{{ $service['name'] }}</h3>
                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $service['cardSummary'] }}</p>
                <p class="mt-4 text-sm font-bold text-[var(--accent)]">Explore service page <i class="bi bi-arrow-right-short"></i></p>
            </a>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Delivery Model</p>
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">How Tekvista executes Zoho programs</h2>
        <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                <h3 class="text-lg font-black text-[var(--text)]">1. Discovery</h3>
                <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Process diagnostics, stakeholder workshops, and architecture planning across departments.</p>
            </article>
            <article class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                <h3 class="text-lg font-black text-[var(--text)]">2. Build & Configure</h3>
                <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Platform setup, data model design, workflow automation, and role-based access controls.</p>
            </article>
            <article class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                <h3 class="text-lg font-black text-[var(--text)]">3. Migrate & Validate</h3>
                <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Data migration, scenario testing, integration checks, and controlled go-live readiness.</p>
            </article>
            <article class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                <h3 class="text-lg font-black text-[var(--text)]">4. Adopt & Optimize</h3>
                <p class="mt-2 text-sm leading-7 text-[var(--muted)]">User training, admin handover, operational review cadence, and continuous improvements.</p>
            </article>
        </div>
    </div>
</section>

<section class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">Enterprise Controls</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Governance built into every Zoho rollout</h2>
            <ul class="mt-4 grid gap-3 text-sm leading-7 text-[var(--muted)]">
                <li class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3"><i class="bi bi-shield-lock-fill mr-2 text-[var(--accent)]"></i>Role-based access architecture and least-privilege policy.</li>
                <li class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3"><i class="bi bi-diagram-2-fill mr-2 text-[var(--accent)]"></i>Cross-application data ownership and process handoff standards.</li>
                <li class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3"><i class="bi bi-clipboard2-check-fill mr-2 text-[var(--accent)]"></i>Change governance for workflows, fields, and integration updates.</li>
                <li class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3"><i class="bi bi-bar-chart-line-fill mr-2 text-[var(--accent)]"></i>Post-launch KPI reviews and periodic optimization checkpoints.</li>
            </ul>
        </article>

        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">Partner Commitment</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Why organizations choose Tekvista for Zoho</h2>
            <div class="mt-4 grid gap-3 text-sm leading-7 text-[var(--muted)]">
                <p class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3">Official Zoho partner delivery approach with business-first consulting.</p>
                <p class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3">Enterprise implementation expertise across cloud, security, and business applications.</p>
                <p class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3">Migration, customization, and integration planning aligned to your operational realities.</p>
                <p class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3">Long-term support model for adoption, governance, and platform evolution.</p>
            </div>
            <div class="mt-6 grid gap-3 sm:grid-cols-2">
                <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/zoho.svg') }}" alt="Zoho"><p class="logo-chip-name">Zoho Official Partner Support</p></div>
                <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/zohomail.svg') }}" alt="Zoho Mail"><p class="logo-chip-name">Zoho Workplace Services</p></div>
            </div>
        </article>
    </div>
</section>

<section class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Frequently Asked Questions</p>
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Zoho implementation questions we handle most often</h2>
        <div class="mt-5 grid gap-4 lg:grid-cols-2">
            <article class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                <h3 class="text-lg font-black text-[var(--text)]">Can you implement Zoho in phases instead of all at once?</h3>
                <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Yes. We typically design phased releases based on process dependency, adoption readiness, and operational risk.</p>
            </article>
            <article class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                <h3 class="text-lg font-black text-[var(--text)]">Do you provide migration support from existing tools?</h3>
                <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Yes. Tekvista plans and executes structured migration with cleansing, mapping, validation, and rollback preparedness.</p>
            </article>
            <article class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                <h3 class="text-lg font-black text-[var(--text)]">Can Tekvista customize Zoho for industry-specific workflows?</h3>
                <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Yes. We configure standard modules and build controlled custom flows for your organization-specific process needs.</p>
            </article>
            <article class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4">
                <h3 class="text-lg font-black text-[var(--text)]">Do you also support post go-live operations?</h3>
                <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Yes. We can provide ongoing administrative support, user enablement, and quarterly optimization programs.</p>
            </article>
        </div>
    </div>
</section>
@endsection
