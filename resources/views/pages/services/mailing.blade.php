@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['mail'] }}" alt="Enterprise mailing and collaboration platforms" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.95),rgba(5,7,13,0.78),rgba(5,7,13,0.45))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">Mailing Solutions</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Managed enterprise mail for Microsoft, Google, and Zoho.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">Migration, configuration, security policy, and user lifecycle management for business email and collaboration suites.</p>
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
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/microsoft.svg') }}" alt="Microsoft"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/office-365.png') }}" alt="Office 365"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/googleworkspace.svg') }}" alt="Google Workspace"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/gmail.svg') }}" alt="Gmail"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/zoho.svg') }}" alt="Zoho"></div>
        </div>
    </div>
</section>
@endsection
