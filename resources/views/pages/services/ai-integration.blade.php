@extends('layout')

@section('content')
<section class="hero-shell">
    <img src="{{ $visuals['ops'] }}" alt="AI integration for enterprise operations" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(95deg,rgba(5,11,20,0.8),rgba(5,11,20,0.58),rgba(5,11,20,0.26))]"></div>

    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">AI Integration</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Practical AI integration for enterprise teams.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#def2ff]">We help organizations adopt AI where it creates measurable value: service operations, internal workflows, analytics, and assisted decision systems.</p>
        <div class="mt-7">
            <a href="{{ route('contact', ['intent' => 'Plan AI Integration']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-5 md:grid-cols-3">
        <div class="neo-card p-6"><h2 class="text-xl font-black">Use Cases</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Knowledge assistants, intelligent routing, document summarization, and reporting enhancements for business teams.</p></div>
        <div class="neo-card p-6"><h2 class="text-xl font-black">Integration</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Link AI workflows with CRM, ERP, collaboration suites, and service systems while preserving operational controls.</p></div>
        <div class="neo-card p-6"><h2 class="text-xl font-black">Governance</h2><p class="mt-3 text-sm leading-7 text-[var(--muted)]">Responsible rollout with data boundaries, auditability, human oversight, and gradual scaling by proven outcomes.</p></div>
    </div>
</section>
@endsection
