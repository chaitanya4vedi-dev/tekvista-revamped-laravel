@extends('layout')

@section('content')
<section class="hero-shell">
    <img src="{{ $visuals['workspace'] }}" alt="Enterprise services" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(105deg,rgba(247,255,251,0.92),rgba(241,253,247,0.82),rgba(231,248,239,0.52))]"></div>

    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">Tekvista Enterprise Services</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-[var(--text)] sm:text-6xl">Enterprise-grade IT solutions designed for scale and reliability.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[var(--muted)]">A completely business-focused portfolio: cybersecurity, cloud, tally on cloud, networking, Zoho, Odoo, and enterprise mailing ecosystems.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    @php
        $serviceIcons = [
            'Cybersecurity' => 'bi-shield-lock-fill',
            'Cloud Solutions' => 'bi-cloud-check-fill',
            'Tally on Cloud' => 'bi-calculator-fill',
            'Networking Solutions' => 'bi-hdd-network-fill',
            'AV Solutions' => 'bi-camera-video-fill',
            'Zoho Solutions' => 'bi-diagram-3-fill',
            'Odoo Solutions' => 'bi-kanban-fill',
            'Mailing Solutions' => 'bi-envelope-at-fill',
        ];
    @endphp
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($services as $service)
            @continue($service['name'] === 'Systems & Infra')
            <a href="{{ route($service['route']) }}" class="neo-card p-5 group hover:border-[var(--accent)] transition-colors">
                <h2 class="text-xl font-black text-[var(--text)]"><i class="bi {{ $serviceIcons[$service['name']] ?? 'bi-stars' }} text-[var(--accent)] mr-2"></i>{{ $service['name'] }}</h2>
                <p class="mt-2 text-sm font-semibold text-[var(--text)]">{{ $service['tagline'] }}</p>
                <p class="mt-4 text-sm leading-7 text-[var(--muted)]">{{ $service['summary'] }}</p>
            </a>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Technology Ecosystem</p>
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Platforms and logos we actively support</h2>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/microsoft.svg') }}" alt="Microsoft"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/googleworkspace.svg') }}" alt="Google"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/zoho.svg') }}" alt="Zoho"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/odoo.svg') }}" alt="Odoo"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/office-365.png') }}" alt="Microsoft 365"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/googlecloud.svg') }}" alt="Google Cloud"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/tally.png') }}" alt="Tally"></div>
            <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/zohomail.svg') }}" alt="Zoho Mail"></div>
        </div>
    </div>
</section>
@endsection
