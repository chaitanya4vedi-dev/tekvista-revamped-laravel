@extends('layout')

@section('content')
<section class="hero-shell">
    <img src="{{ $visuals['workspace'] }}" alt="Enterprise services" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(105deg,rgba(247,255,251,0.92),rgba(241,253,247,0.82),rgba(231,248,239,0.52))]"></div>

    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">Tekvista Enterprise Services</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-[var(--text)] sm:text-6xl">Enterprise-grade IT solutions designed for scale and reliability.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[var(--muted)]">A completely business-focused portfolio: cybersecurity, cloud (including Tally hosting), networking, Zoho, Odoo, and enterprise mailing ecosystems.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    @php
        $serviceIcons = [
            'IT Consultancy' => 'bi-briefcase-fill',
            'Cybersecurity' => 'bi-shield-lock-fill',
            'Cloud Solutions' => 'bi-cloud-check-fill',
            'Networking Solutions' => 'bi-hdd-network-fill',
            'IT Support' => 'bi-headset',
            'Software Solutions' => 'bi-code-slash',
            'AV Solutions' => 'bi-camera-video-fill',
            'Zoho Solutions' => 'bi-diagram-3-fill',
            'Odoo Solutions' => 'bi-kanban-fill',
            'Mailing Solutions' => 'bi-envelope-at-fill',
            'AI Integration' => 'bi-cpu-fill',
            'Systems & Infra' => 'bi-server',
        ];
    @endphp
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($services as $service)
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
        <p class="section-kicker">Operating Domains</p>
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Enterprise work areas we actively deliver</h2>
        <div class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-3">
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-diagram-2-fill mr-2 text-[var(--accent)]"></i>Technology consulting and architecture planning</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-shield-check mr-2 text-[var(--accent)]"></i>Cybersecurity posture and controls implementation</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-cloud-arrow-up-fill mr-2 text-[var(--accent)]"></i>Cloud modernization, migration, and governance</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-hdd-network-fill mr-2 text-[var(--accent)]"></i>Networking, infrastructure, and operations support</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-window-stack mr-2 text-[var(--accent)]"></i>Custom software solutions and enterprise workflows</div>
            <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm text-[var(--text)]"><i class="bi bi-cpu-fill mr-2 text-[var(--accent)]"></i>AI integration for productivity and process automation</div>
        </div>
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
