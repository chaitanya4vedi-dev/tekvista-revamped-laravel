@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['network'] }}" alt="Enterprise networking infrastructure" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.95),rgba(5,7,13,0.78),rgba(5,7,13,0.45))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">Networking Solutions</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Intelligent networking for distributed enterprise teams.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">Campus LAN, branch WAN, secure remote access, and observable network operations with enterprise governance.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-3">
    <article class="neo-card p-5"><h2 class="text-xl font-black">LAN and WAN Engineering</h2><p class="mt-3 text-sm text-[var(--muted)]">High-availability architecture, segmentation, and planned growth design.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">SD-WAN Rollout</h2><p class="mt-3 text-sm text-[var(--muted)]">Smart routing and policy control to improve app performance.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Network Security</h2><p class="mt-3 text-sm text-[var(--muted)]">Firewall policy, VPN access, and continuous observability baselines.</p></article>
</section>
@endsection
