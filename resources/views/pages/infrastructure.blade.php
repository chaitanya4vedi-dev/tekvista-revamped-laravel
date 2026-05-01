@extends('layout')

@section('content')
<section class="relative isolate overflow-hidden">
    <img src="{{ $visuals['infra'] }}" alt="Cloud and infrastructure technology environment" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(5,7,13,0.96),rgba(5,7,13,0.72),rgba(5,7,13,0.32))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">Infrastructure command</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Networks, servers, cloud and security engineered as one operating layer.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">From office connectivity to hybrid cloud, Tekvista designs resilient systems that can be monitored, supported and improved without chaos.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    @php
        $process = [
            ['step' => '01', 'title' => 'Assess', 'copy' => 'Baseline review of current infrastructure, dependencies, risks, and business continuity requirements.'],
            ['step' => '02', 'title' => 'Architect', 'copy' => 'Design secure network, compute, storage, and cloud topology aligned to performance and resilience targets.'],
            ['step' => '03', 'title' => 'Operate', 'copy' => 'Implement monitoring, patching, backup, and governance controls for stable day-to-day enterprise operations.'],
            ['step' => '04', 'title' => 'Optimize', 'copy' => 'Continuously tune capacity, reliability, and cost posture with measurable operational improvements.'],
        ];
    @endphp
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($process as $item)
            <article class="neo-card p-5">
                <p class="font-mono text-xs font-black text-[var(--accent)]">{{ $item['step'] }}</p>
                <h2 class="mt-3 text-xl font-black text-[var(--text)]">{{ $item['title'] }}</h2>
                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $item['copy'] }}</p>
            </article>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-[1fr_0.9fr]">
        <div class="neo-card p-6">
            <p class="section-kicker">Infra signal matrix</p>
            <div class="mt-5 grid gap-3 sm:grid-cols-2">
                @foreach (['Firewall and VPN', 'Structured LAN and WAN', 'Cloud backup', 'Server virtualization', 'Endpoint monitoring', 'DR readiness', 'Storage lifecycle', 'Patch governance'] as $signal)
                    <div class="rounded-lg border border-[var(--line)] bg-[var(--surface-light)] px-4 py-3 text-sm font-semibold text-[var(--muted)]">{{ $signal }}</div>
                @endforeach
            </div>
        </div>
        <img src="{{ $visuals['security'] }}" alt="Cybersecurity and infrastructure monitoring" class="h-full min-h-80 w-full rounded-2xl border border-[var(--line)] object-cover shadow-[var(--shadow)]">
    </div>
</section>
@endsection
