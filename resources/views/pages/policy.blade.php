@extends('layout')

@section('content')
<section class="hero-shell">
    <img src="{{ $visuals['security'] }}" alt="Tekvista policy and compliance workspace" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(95deg,rgba(5,11,20,0.8),rgba(5,11,20,0.58),rgba(5,11,20,0.26))]"></div>

    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker hero-kicker-readable">Compliance Library</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">{{ $policy['title'] }}</h1>
        <p class="mt-5 max-w-4xl text-base leading-8 text-[#d5edf6]">{{ $policy['summary'] }}</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 pb-10 sm:px-6 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-[0.85fr_1.15fr]">
        <aside class="neo-card p-5">
            <p class="section-kicker">All Policies</p>
            <p class="mt-2 text-sm text-[var(--muted)]">Legal, privacy, and assurance references for Tekvista Infosolutions Pvt Ltd and Agile Innotech-aligned business operations.</p>
            <div class="mt-4 grid gap-2 text-sm">
                @foreach ($policyIndex as $slug => $item)
                    <a href="{{ url('/'.$slug) }}" class="rounded-lg border px-3 py-2 transition {{ $policySlug === $slug ? 'border-[var(--accent)] bg-[var(--accent)]/10 text-[var(--text)] font-bold' : 'border-[var(--line)] text-[var(--muted)] hover:text-[var(--accent)]' }}">
                        {{ $item['title'] }}
                    </a>
                @endforeach
            </div>
        </aside>

        <article class="neo-card p-6 sm:p-8">
            <div class="flex flex-wrap items-center justify-between gap-2 border-b border-[var(--line)] pb-4">
                <p class="section-kicker">Policy Document</p>
                <p class="text-xs text-[var(--muted)]">Effective date: <span class="font-semibold text-[var(--text)]">{{ $policyEffectiveDate }}</span></p>
            </div>

            <div class="mt-5 grid gap-5 text-sm leading-7 text-[var(--muted)]">
                @foreach ($policy['sections'] as $section)
                    <section class="rounded-xl border border-[var(--line)] bg-white/70 p-4">
                        <h2 class="text-xl font-black text-[var(--text)]">{{ $section['heading'] }}</h2>
                        <ul class="mt-3 grid gap-2">
                            @foreach ($section['points'] as $point)
                                <li class="rounded-lg border border-[var(--line)] bg-[var(--surface-light)] px-3 py-2 text-[var(--text)]"><i class="bi bi-check2-circle mr-2 text-[var(--accent)]"></i>{{ $point }}</li>
                            @endforeach
                        </ul>
                    </section>
                @endforeach
            </div>

            <section class="mt-6 rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-4 text-sm leading-7 text-[var(--text)]">
                <p><span class="font-black">Need clarification?</span> Contact <a class="font-semibold text-[var(--accent)] underline" href="mailto:alok@tekvista.in">alok@tekvista.in</a> with your company name, applicable policy, and commercial reference.</p>
                <p class="mt-2 text-xs text-[var(--muted)]">Compliance note: This page provides policy-level guidance and does not replace professional legal advice.</p>
            </section>
        </article>
    </div>
</section>
@endsection
