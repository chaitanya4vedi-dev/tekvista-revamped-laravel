@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['network'] }}" alt="Enterprise networking infrastructure" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.82),rgba(5,7,13,0.58),rgba(5,7,13,0.26))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Networking Solutions</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Networks, servers, cloud and security engineered as one operating layer.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">Campus LAN, branch WAN, managed and unmanaged switching, firewall operations, secure remote access, and observable network governance.</p>
        <div class="mt-7">
            <a href="{{ route('contact', ['intent' => 'Get Networking Consultation']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 grid max-w-7xl gap-6 px-4 sm:px-6 md:grid-cols-2 lg:grid-cols-4 lg:px-8">
    <article class="neo-card p-5"><h2 class="text-xl font-black">LAN and WAN Engineering</h2><p class="mt-3 text-sm text-[var(--muted)]">High-availability architecture, segmentation, and planned growth design.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Managed Switching</h2><p class="mt-3 text-sm text-[var(--muted)]">Centralized control, VLAN strategy, and performance tuning for critical business traffic.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Unmanaged Switching</h2><p class="mt-3 text-sm text-[var(--muted)]">Reliable plug-and-play connectivity for edge teams, retail counters, and simple branch expansion.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Firewall and Access Security</h2><p class="mt-3 text-sm text-[var(--muted)]">Policy hardening, VPN control, and always-on observability to reduce risk and downtime.</p></article>
</section>
@endsection
