@extends('layout')

@section('content')
<section class="relative isolate overflow-hidden">
    <img src="{{ $visuals['about'] }}" alt="Tekvista business partnerships and global technology network" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(5,7,13,0.86),rgba(5,7,13,0.62),rgba(5,7,13,0.28))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">About Tekvista</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-white sm:text-6xl">Enterprise technology delivery built in Kolkata, scaled for modern business.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">Tekvista Infosolutions Private Limited helps organizations modernize cloud, security, collaboration, and infrastructure with disciplined execution, measurable outcomes, and long-term operational support.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
        <div class="light-panel p-6">
            <p class="section-kicker text-[#00796b]">Company identity</p>
            <div class="mt-5 grid gap-3 sm:grid-cols-2">
                @foreach ($credibility as $label => $value)
                    <div class="rounded-xl border border-[#0a8f99]/18 bg-white/70 p-4">
                        <p class="font-mono text-[0.68rem] font-bold text-[#00796b]">{{ $label }}</p>
                        <p class="mt-2 text-sm font-bold leading-6 text-[#193247]">{{ $value }}</p>
                    </div>
                @endforeach
                <div class="rounded-xl border border-[#0a8f99]/18 bg-white/70 p-4">
                    <p class="font-mono text-[0.68rem] font-bold text-[#00796b]">Incorporation</p>
                    <p class="mt-2 text-sm font-bold leading-6 text-[#193247]">29 September 2021 (Private Limited)</p>
                </div>
                <div class="rounded-xl border border-[#0a8f99]/18 bg-white/70 p-4">
                    <p class="font-mono text-[0.68rem] font-bold text-[#00796b]">Leadership</p>
                    <p class="mt-2 text-sm font-bold leading-6 text-[#193247]">Founder-led execution with director oversight and client-first governance</p>
                </div>
            </div>
        </div>
        <div class="grid gap-4 md:grid-cols-3">
            <x-feature-card title="Mission" copy="Make business technology dependable, documented, secure, and ready for scale." tone="teal">
                <x-slot:icon><svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3l7 6-7 12L5 9l7-6z"/></svg></x-slot:icon>
            </x-feature-card>
            <x-feature-card title="Method" copy="Assess, architect, migrate, harden, monitor, and continuously optimize." tone="blue">
                <x-slot:icon><svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M4 12h16M4 17h10"/></svg></x-slot:icon>
            </x-feature-card>
            <x-feature-card title="Promise" copy="Local accountability with enterprise operating discipline and response speed." tone="green">
                <x-slot:icon><svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3l7 3v5c0 5-3 8.5-7 10-4-1.5-7-5-7-10V6l7-3z"/></svg></x-slot:icon>
            </x-feature-card>
        </div>
    </div>
</section>

<section class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-3">
        <article class="light-panel p-6 lg:col-span-2">
            <p class="section-kicker text-[#0b8f9a]">Founder Journey</p>
            <h2 class="mt-2 text-2xl font-black text-[#0d283d]">From relationship-led IT support to structured enterprise transformation.</h2>
            <div class="mt-4 grid gap-4 text-sm leading-7 text-[#244761]">
                <p>Tekvista grew from practical IT problem-solving for fast-moving businesses into a full enterprise services practice. The founder journey has remained focused on one operating principle: every implementation must be supportable in the real world, not just impressive on launch day.</p>
                <p>That approach shaped the company into a cross-functional delivery team spanning cybersecurity, cloud, networking, collaboration, and business applications. Today, the same founder-led culture drives execution quality, ownership, and long-term client trust across projects.</p>
            </div>
        </article>
        <article class="light-panel p-6">
            <p class="section-kicker text-[#0b8f9a]">Enterprise Focus</p>
            <h3 class="mt-2 text-lg font-black text-[#0d283d]">How Tekvista works with organizations</h3>
            <ul class="mt-4 grid gap-3 text-sm leading-6 text-[#244761]">
                <li class="rounded-lg border border-[#0a8f99]/20 bg-white/70 px-3 py-2">Governance-first discovery before implementation.</li>
                <li class="rounded-lg border border-[#0a8f99]/20 bg-white/70 px-3 py-2">Vendor-neutral architecture aligned to risk and budget.</li>
                <li class="rounded-lg border border-[#0a8f99]/20 bg-white/70 px-3 py-2">Operational handover with documentation and accountability.</li>
                <li class="rounded-lg border border-[#0a8f99]/20 bg-white/70 px-3 py-2">Continuous support model for uptime and security posture.</li>
            </ul>
        </article>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="light-panel p-6">
        <p class="section-kicker text-[#0b8f9a]">Tekvista and Zauba Corp Context</p>
        <h2 class="mt-2 text-2xl font-black text-[#0d283d]">Public-company visibility and verification layer</h2>
        <div class="mt-4 grid gap-4 text-sm leading-7 text-[#244761]">
            <p>Tekvista Infosolutions Private Limited is publicly discoverable through corporate data aggregators like Zauba-style business research platforms. This improves discoverability for procurement, partner due diligence, and vendor shortlisting workflows.</p>
            <p>Public profile datasets identify Tekvista as an active private company under ROC Kolkata with CIN <span class="font-semibold">U72900WB2021PTC248435</span>, helping enterprise buyers validate statutory identity before engagement.</p>
            <p class="text-xs text-[#4b697f]">Note: Public aggregator datasets are reference sources; statutory filings with MCA remain the primary legal source of truth.</p>
        </div>
    </div>
</section>

<section class="mx-auto mt-14 max-w-7xl px-4 pb-4 sm:px-6 lg:px-8">
    <div class="grid gap-4 md:grid-cols-3">
        <img src="{{ $visuals['strategy'] }}" alt="Indian office team discussing technology strategy" class="h-72 w-full rounded-2xl border border-[var(--line)] object-cover shadow-[var(--shadow)]">
        <img src="{{ $visuals['workspace'] }}" alt="Modern Indian workplace collaboration" class="h-72 w-full rounded-2xl border border-[var(--line)] object-cover shadow-[var(--shadow)]">
        <img src="{{ $visuals['engineering'] }}" alt="Technology collaboration in office" class="h-72 w-full rounded-2xl border border-[var(--line)] object-cover shadow-[var(--shadow)]">
    </div>
</section>
@endsection
