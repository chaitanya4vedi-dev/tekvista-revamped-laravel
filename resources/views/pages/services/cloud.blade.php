@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['infra'] }}" alt="Enterprise cloud infrastructure" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.82),rgba(5,7,13,0.58),rgba(5,7,13,0.26))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Cloud Solutions</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">One enterprise cloud platform for workloads, applications, and business continuity.</h1>
        <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">TekVista delivers Tally on Cloud, Zoho, Odoo, Microsoft Azure, Google Cloud Platform (GCP), Amazon Web Services (AWS), and CtrlS datacenter-backed hosting through one integrated cloud delivery model.</p>
        <div class="mt-7">
            <a href="{{ route('contact', ['intent' => 'Plan Cloud and Tally Hosting Rollout']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-3">
    <article class="neo-card p-5"><h2 class="text-xl font-black">Dedicated Cloud at Shared Cost</h2><p class="mt-3 text-sm text-[var(--muted)]">We provide dedicated cloud service while keeping commercial plans close to shared-cloud pricing, so enterprises get stronger isolation without heavy cost overhead.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Tally on Cloud Included</h2><p class="mt-3 text-sm text-[var(--muted)]">Secure multi-user Tally access with role-based permissions, performance tuning, and remote availability for finance teams across offices and branches.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">CtrlS Datacenter Backbone</h2><p class="mt-3 text-sm text-[var(--muted)]">Cloud workloads are hosted from CtrlS data centers with enterprise-grade power, network, and physical security controls for stable operations.</p></article>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Platforms We Deliver</p>
        <div class="mt-4 grid gap-3 sm:grid-cols-4">
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/tally.png') }}" alt="Tally"><p class="logo-chip-name">Tally on Cloud</p></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/zoho.svg') }}" alt="Zoho"><p class="logo-chip-name">Zoho</p></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/odoo.svg') }}" alt="Odoo"><p class="logo-chip-name">Odoo ERP</p></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/microsoft.svg') }}" alt="Microsoft Azure"><p class="logo-chip-name">Microsoft Azure</p></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/googlecloud.svg') }}" alt="Google Cloud"><p class="logo-chip-name">Google Cloud</p></div>
            <div class="logo-chip"><span class="text-lg font-black text-[var(--text)]">AWS</span><p class="logo-chip-name">Amazon Web Services</p></div>
            <div class="logo-chip"><span class="text-lg font-black text-[var(--text)]">CtrlS</span><p class="logo-chip-name">CtrlS Datacenters</p></div>
            <div class="logo-chip"><span class="text-lg font-black text-[var(--text)]">Dedicated Cloud</span><p class="logo-chip-name">Isolated Enterprise Hosting</p></div>
        </div>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">What We Deliver</p>
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Enterprise cloud lifecycle coverage from onboarding to operations.</h2>
        <div class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-3">
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-cloud-arrow-up-fill mr-2 text-[var(--accent)]"></i>Cloud readiness and migration wave planning</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-calculator-fill mr-2 text-[var(--accent)]"></i>Tally on Cloud onboarding with multi-user enablement</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-shield-lock-fill mr-2 text-[var(--accent)]"></i>Identity, policy, and environment hardening</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-hdd-stack-fill mr-2 text-[var(--accent)]"></i>Compute, storage, and workload right-sizing</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-arrow-repeat mr-2 text-[var(--accent)]"></i>Backup, restore drills, and continuity playbooks</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-graph-up-arrow mr-2 text-[var(--accent)]"></i>Ongoing optimization for performance and cost control</div>
        </div>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Operating Model</p>
        <div class="grid gap-6 md:grid-cols-2">
            <article>
                <h2 class="text-2xl font-black text-[var(--text)]">Tally, Zoho, and Odoo in cloud-ready architecture.</h2>
                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">We design application hosting and integration patterns so your finance, operations, CRM, and collaboration workloads can run with predictable uptime, secure access, and clean data flow between systems.</p>
                <ul class="mt-4 space-y-2 text-sm text-[var(--text)]">
                    <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Concurrent user access with role-bound privileges</li>
                    <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Secure remote usage from office, branch, and field teams</li>
                    <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Structured transition from current setup to cloud operations</li>
                </ul>
            </article>
            <article>
                <h2 class="text-2xl font-black text-[var(--text)]">Clear backup policy and accountability boundary.</h2>
                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">We sincerely provide managed cloud data backup, retention planning, and restore support. Final data ownership, audit confirmation, and business-level liability remain with the customer organization and its authorized stakeholders.</p>
                <ul class="mt-4 space-y-2 text-sm text-[var(--text)]">
                    <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Automated backup schedules with restore checkpoints</li>
                    <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Recovery guidance with documented restoration steps</li>
                    <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Shared governance model for continuity compliance</li>
                </ul>
            </article>
        </div>
    </div>
</section>
@endsection
