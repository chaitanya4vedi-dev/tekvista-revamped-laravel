@extends('layout')

@section('content')
<section class="service-hero relative isolate overflow-hidden">
    <img src="{{ $visuals['about'] }}" alt="Industry wise Tekvista IT solutions" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[#020817]/45"></div>
    <div class="absolute inset-0 -z-10 tv-industry-hero-gradient"></div>
    <div class="absolute inset-0 -z-10 tv-industry-hero-mesh"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Products and Services by Industry</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">Choose Tekvista products and services by the industry you operate in</h1>
        <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">Every industry has a different mix of risk, users, workflows, and uptime pressure. These pages group Tekvista products and services into practical bundles for the sectors we work with.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($industryPages as $slug => $industry)
            <a href="{{ route('industry.show', ['industry' => $slug]) }}" class="neo-card overflow-hidden transition hover:border-[var(--accent)]">
                <img src="{{ $industry['heroImage'] }}" alt="{{ $industry['name'] }} IT services" class="h-40 w-full object-cover">
                <div class="p-5">
                    <p class="section-kicker">{{ $industry['name'] }}</p>
                    <h2 class="mt-2 text-2xl font-black text-[var(--text)]">{{ $industry['heroTitle'] }}</h2>
                    <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $industry['heroSummary'] }}</p>
                    <p class="mt-4 text-sm font-bold text-[var(--accent)]">Open industry page <i class="bi bi-arrow-right-short"></i></p>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endsection
