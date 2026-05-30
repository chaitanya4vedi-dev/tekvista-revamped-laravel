@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['mail'] }}" alt="Enterprise mailing and secure communication operations" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.82),rgba(5,7,13,0.58),rgba(5,7,13,0.26))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Mailing Solutions</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Managed enterprise mail for Microsoft, Google, and Zoho.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">Migration, configuration, security policy, and user lifecycle management for business email and collaboration suites.</p>
        <div class="mt-7">
            <a href="{{ route('contact', ['intent' => 'Configure Enterprise Mailing Platform']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-3">
    <article class="neo-card p-5"><h2 class="text-xl font-black">Microsoft 365</h2><p class="mt-3 text-sm text-[var(--muted)]">Exchange, Teams, compliance, and identity-aligned collaboration setup.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Google Workspace</h2><p class="mt-3 text-sm text-[var(--muted)]">Gmail, Meet, Drive, and admin security with migration orchestration.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Zoho Mail</h2><p class="mt-3 text-sm text-[var(--muted)]">Secure, cost-optimized business email integrated with Zoho apps.</p></article>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Supported Platforms</p>
        <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-5">
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/microsoft.svg') }}" alt="Microsoft"><p class="logo-chip-name">Microsoft</p></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/office-365.png') }}" alt="Office 365"><p class="logo-chip-name">Office 365</p></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/googleworkspace.svg') }}" alt="Google Workspace"><p class="logo-chip-name">Google Workspace</p></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/gmail.svg') }}" alt="Gmail"><p class="logo-chip-name">Gmail for Business</p></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/zoho.svg') }}" alt="Zoho"><p class="logo-chip-name">Zoho Mail</p></div>
        </div>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <h2 class="text-2xl font-black text-[var(--text)]">Need advanced anti-phishing and gateway protection?</h2>
        <p class="mt-3 text-sm leading-7 text-[var(--muted)]">For dedicated secure email gateway deployment, threat sandboxing, and executive impersonation controls, explore our dedicated Email Security page.</p>
        <div class="mt-5">
            <a href="{{ route('email-security') }}" class="btn-secondary">
                <i class="bi bi-shield-lock-fill"></i>Explore Email Security
            </a>
        </div>
    </div>
</section>
@endsection
