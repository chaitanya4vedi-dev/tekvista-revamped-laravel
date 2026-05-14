@extends('layout')

@section('content')
<section class="hero-shell">
    <img src="{{ $visuals['engineering'] }}" alt="Software engineering for enterprise" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(95deg,rgba(5,11,20,0.8),rgba(5,11,20,0.58),rgba(5,11,20,0.26))]"></div>

    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Software Solutions</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Custom software aligned with enterprise workflows.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#def2ff]">We design and implement business software that integrates with your cloud, ERP, CRM, and productivity systems for better control and execution speed.</p>
        <div class="mt-7">
            <a href="{{ route('contact', ['intent' => 'Scope Software Solution Project']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-5 md:grid-cols-2">
        <div class="neo-card p-6"><h2 class="text-2xl font-black">What We Build</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Internal workflow tools, portals, automation workflows, integration layers, and reporting solutions tailored to your operating model.</p></div>
        <div class="neo-card p-6"><h2 class="text-2xl font-black">How We Build</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Requirements mapping, phased delivery, secure coding practices, and deployment handover with documentation and operational readiness.</p></div>
    </div>
</section>
@endsection
