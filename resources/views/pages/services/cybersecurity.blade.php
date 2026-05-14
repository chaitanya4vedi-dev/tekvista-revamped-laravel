@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['security'] }}" alt="Cybersecurity operations center" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.82),rgba(5,7,13,0.58),rgba(5,7,13,0.26))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Cybersecurity</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">Enterprise cyber defense built for firewall resilience, privacy, and compliance readiness.</h1>
        <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">Tekvista designs and operates layered protection: firewall policy engineering, endpoint hardening, identity controls, threat monitoring, and compliance-aligned governance for business continuity.</p>
        <div class="mt-7 flex flex-wrap gap-3">
            <a href="{{ route('contact', ['intent' => 'Request Cybersecurity Assessment']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Contact Us
            </a>
            <a href="{{ route('email-security') }}" class="btn-secondary btn-secondary-on-dark">
                <i class="bi bi-shield-lock-fill"></i>Email Security Services
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
        <article class="neo-card p-6"><h2 class="text-xl font-black">Firewall Engineering</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Architecture, rule-base cleanup, segmentation, VPN posture, and continuous policy tuning across perimeter and internal zones.</p></article>
        <article class="neo-card p-6"><h2 class="text-xl font-black">SOC and MDR</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">24x7 monitoring, threat triage, incident response runbooks, and escalation workflows with business-impact prioritization.</p></article>
        <article class="neo-card p-6"><h2 class="text-xl font-black">Privacy Controls</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Data classification, access minimization, encryption policy, and retention governance across business systems.</p></article>
        <article class="neo-card p-6"><h2 class="text-xl font-black">Identity and Endpoint</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">MFA enforcement, privileged access control, endpoint telemetry, and managed hardening for desktop and server estates.</p></article>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Security Coverage</p>
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Operational controls we implement and manage</h2>
        <div class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-3">
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-shield-lock-fill mr-2 text-[var(--accent)]"></i>Next-gen firewall architecture and policy governance</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-person-lock mr-2 text-[var(--accent)]"></i>Identity security, SSO, MFA, and privileged access controls</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-envelope-exclamation-fill mr-2 text-[var(--accent)]"></i>Anti-phishing policies and mailbox threat containment</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-laptop-fill mr-2 text-[var(--accent)]"></i>Endpoint detection, patch governance, and ransomware resilience</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-database-check mr-2 text-[var(--accent)]"></i>Backup validation, secure restore drills, and breach recovery planning</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-journal-check mr-2 text-[var(--accent)]"></i>Audit evidence, policy documentation, and compliance reporting packs</div>
        </div>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-2">
        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">DPDP and Privacy</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">DPDP-aligned security and data governance support</h2>
            <p class="mt-3 text-sm leading-7 text-[var(--muted)]">We help business teams map security controls to privacy obligations under India’s Digital Personal Data Protection (DPDP) Act, 2023. Many teams informally call this DPDT, but the formal legal name is DPDP.</p>
            <ul class="mt-4 space-y-2 text-sm text-[var(--text)]">
                <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Data flow discovery and sensitivity classification</li>
                <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Access boundaries, consent-aligned workflows, and retention policy rollout</li>
                <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Incident response and breach communication readiness plans</li>
                <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Rights handling workflow for access, correction, erasure, and grievance response</li>
                <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Children’s data safeguards, consent controls, and purpose-bound processing governance</li>
                <li><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>Board-facing documentation packs for audits, inquiries, and incident evidence submission</li>
            </ul>
        </article>
        <article class="neo-card p-6 sm:p-8">
            <p class="section-kicker">Product Stack</p>
            <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Platforms and products we provide and support</h2>
            <p class="mt-3 text-sm leading-7 text-[var(--muted)]">FortiGate and FortiMail are products from Fortinet, so they use the same parent brand logo.</p>
            <div class="mt-5 grid gap-3 sm:grid-cols-2">
                <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/fortinet.svg') }}" alt="FortiGate by Fortinet"><p class="logo-chip-title">FortiGate (Fortinet)</p><p class="logo-chip-name">Next-generation firewall deployment and policy hardening services.</p></div>
                <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/sophos.svg') }}" alt="Sophos"><p class="logo-chip-title">Sophos</p><p class="logo-chip-name">Firewall, endpoint, and synchronized security rollout for enterprises.</p></div>
                <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/fortinet.svg') }}" alt="FortiMail by Fortinet"><p class="logo-chip-title">FortiMail</p><p class="logo-chip-name">Secure email gateway implementation and managed security operations.</p></div>
                <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/barracuda.svg') }}" alt="Barracuda"><p class="logo-chip-title">Barracuda</p><p class="logo-chip-name">Email threat defense, impersonation controls, and continuity services.</p></div>
                <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/paloaltonetworks.svg') }}" alt="Palo Alto Networks"><p class="logo-chip-title">Palo Alto Networks</p><p class="logo-chip-name">We sell, deploy, and support next-gen firewall and SASE security services.</p></div>
                <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/seqrite.png') }}" alt="Seqrite"><p class="logo-chip-title">Seqrite</p><p class="logo-chip-name">We provide Seqrite endpoint protection, XDR, and enterprise security services.</p></div>
                <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/microsoft.svg') }}" alt="Microsoft Defender"><p class="logo-chip-title">Microsoft Defender</p><p class="logo-chip-name">Identity and endpoint threat protection with continuous policy tuning.</p></div>
            </div>
        </article>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">DPDP Program Scope</p>
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">What we operationalize for ongoing DPDP readiness</h2>
        <div class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-3">
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-file-earmark-text-fill mr-2 text-[var(--accent)]"></i>Notice and consent language mapping by processing purpose</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-diagram-2-fill mr-2 text-[var(--accent)]"></i>Data fiduciary and processor responsibility matrix</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-person-check-fill mr-2 text-[var(--accent)]"></i>Data principal rights desk and escalation SLAs</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-shield-lock-fill mr-2 text-[var(--accent)]"></i>Reasonable security safeguards and control validation</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-exclamation-triangle-fill mr-2 text-[var(--accent)]"></i>Breach response runbook and regulator-notification preparedness</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-journal-richtext mr-2 text-[var(--accent)]"></i>Periodic governance review aligned to DPDP Rules and notifications</div>
        </div>
        <p class="mt-5 text-xs leading-6 text-[var(--muted)]">Compliance note: this section reflects implementation guidance support and does not substitute legal advice. We work with your legal/compliance team for final policy sign-off.</p>
    </div>
</section>
@endsection
