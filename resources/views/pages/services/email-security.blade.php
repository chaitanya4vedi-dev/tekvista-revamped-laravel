@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['emailSecurity'] }}" alt="Enterprise email security and phishing protection" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.82),rgba(5,7,13,0.58),rgba(5,7,13,0.26))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Email Security</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">Dedicated email security services for phishing defense and mailbox trust</h1>
        <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">Tekvista provides enterprise email security implementation and managed operations, covering secure email gateway tuning, anti-spoofing controls, and continuity planning.</p>
        <div class="mt-7">
            <a href="{{ route('contact', ['intent' => 'Discuss Email Security Rollout']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
        <article class="neo-card p-6"><h2 class="text-xl font-black">Secure Email Gateway</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Policy-based inbound and outbound filtering, malware scanning, and quarantine workflows for controlled mail flow.</p></article>
        <article class="neo-card p-6"><h2 class="text-xl font-black">Anti-Phishing Shield</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Executive impersonation detection, suspicious-link controls, and end-user awareness playbooks to reduce successful attacks.</p></article>
        <article class="neo-card p-6"><h2 class="text-xl font-black">Domain Protection</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">SPF, DKIM, and DMARC rollout with monitoring and policy progression from visibility to enforcement.</p></article>
        <article class="neo-card p-6"><h2 class="text-xl font-black">Compliance and Continuity</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Retention policy alignment, legal-hold readiness, backup access, and restore pathways for critical mailboxes.</p></article>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Platforms We Support</p>
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Email security products and services tailored for our customers</h2>
        <p class="mt-3 text-sm leading-7 text-[var(--muted)]">We sell, implement, and provide managed services for these platforms based on your risk profile and scale.</p>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/barracuda.svg') }}" alt="Barracuda"><p class="logo-chip-title">Barracuda</p><p class="logo-chip-name">Email Security Gateway and impersonation protection services.</p></div>
            <a href="{{ route('product.partner', ['vendor' => 'fortinet']) }}" class="logo-chip"><img src="{{ asset('images/tekvista/logos/fortinet.svg') }}" alt="FortiMail by Fortinet"><p class="logo-chip-title">FortiMail</p><p class="logo-chip-name">Secure email gateway with anti-phishing and ATP policy controls.</p></a>
            <a href="{{ route('product.partner', ['vendor' => 'sophos']) }}" class="logo-chip"><img src="{{ asset('images/tekvista/logos/sophos.svg') }}" alt="Sophos Email"><p class="logo-chip-title">Sophos Email</p><p class="logo-chip-name">Business email threat detection and mailbox protection workflows.</p></a>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/paloaltonetworks.svg') }}" alt="Palo Alto Networks"><p class="logo-chip-title">Palo Alto Networks</p><p class="logo-chip-name">We sell and provide security services across firewall and cloud-delivered controls.</p></div>
            <a href="{{ route('product.partner', ['vendor' => 'seqrite']) }}" class="logo-chip"><img src="{{ asset('images/tekvista/logos/seqrite.png') }}" alt="Seqrite"><p class="logo-chip-title">Seqrite</p><p class="logo-chip-name">Enterprise email and endpoint threat protection deployment and support.</p></a>
            <a href="{{ route('product.partner', ['vendor' => 'microsoft']) }}" class="logo-chip"><img src="{{ asset('images/tekvista/logos/microsoft.svg') }}" alt="Microsoft Defender"><p class="logo-chip-title">Microsoft Defender</p><p class="logo-chip-name">M365-native email threat protection, investigations, and response support.</p></a>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/googleworkspace.svg') }}" alt="Google Workspace Security"><p class="logo-chip-title">Google Workspace Security</p><p class="logo-chip-name">Gmail security controls, policy hardening, and domain reputation monitoring.</p></div>
        </div>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <h2 class="text-2xl font-black text-[var(--text)]">How Tekvista runs email security services</h2>
        <div class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-3">
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-clipboard-data-fill mr-2 text-[var(--accent)]"></i>Mailbox threat baseline and current-policy assessment</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-sliders2 mr-2 text-[var(--accent)]"></i>Gateway policy tuning with false-positive reduction</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-activity mr-2 text-[var(--accent)]"></i>Continuous monitoring, alert handling, and incident escalation</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-file-earmark-check-fill mr-2 text-[var(--accent)]"></i>Audit-ready reporting for leadership and compliance teams</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-person-workspace mr-2 text-[var(--accent)]"></i>User awareness reinforcement for high-risk teams</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-arrow-repeat mr-2 text-[var(--accent)]"></i>Quarterly control review and security posture upgrades</div>
        </div>
    </div>
</section>
@endsection
