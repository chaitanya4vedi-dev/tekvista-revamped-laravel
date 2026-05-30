@extends('layout')

@section('content')
<section class="hero-shell">
    <img src="{{ $visuals['csr'] }}" alt="Tekvista CSR and community growth initiatives" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(105deg,rgba(247,255,251,0.94),rgba(241,253,247,0.84),rgba(231,248,239,0.58))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">Corporate Social Responsibility</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-[var(--text)] sm:text-6xl">Building community impact through education-focused CSR initiatives</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[var(--muted)]">Tekvista Infosolutions supports practical social impact projects with a focus on safer learning environments, educational infrastructure, and long-term community value.</p>
        <div class="mt-7">
            <a href="{{ route('contact', ['intent' => 'Discuss CSR Collaboration with Tekvista']) }}" class="btn-primary">
                <i class="bi bi-send-check-fill"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-4 sm:grid-cols-2">
        <img src="/images/tekvista/school-gallery1.jpeg" alt="CSR school cultural event" class="h-72 w-full rounded-2xl border border-[var(--line)] object-cover shadow-[var(--shadow)] sm:col-span-2">
        <img src="/images/tekvista/school-gallery2.jpeg" alt="Students in CSR-supported school" class="h-56 w-full rounded-2xl border border-[var(--line)] object-cover shadow-[var(--shadow)]">
        <img src="/images/tekvista/school-gallery3.jpeg" alt="CSR-backed school infrastructure" class="h-56 w-full rounded-2xl border border-[var(--line)] object-cover shadow-[var(--shadow)]">
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-4 md:grid-cols-2">
        @foreach ($csrPoints as $point)
            <div class="neo-card p-4 text-sm leading-7 text-[var(--text)]">
                <i class="bi bi-check2-circle text-[var(--accent)] mr-2"></i>{{ $point }}
            </div>
        @endforeach
    </div>
</section>
@endsection
