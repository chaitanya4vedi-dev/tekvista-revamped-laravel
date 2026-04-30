@extends('layout')

@section('content')
<section class="hero-shell">
    <img src="{{ $visuals['av'] }}" alt="Enterprise AV solutions setup" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(105deg,rgba(247,255,251,0.92),rgba(241,253,247,0.82),rgba(231,248,239,0.52))]"></div>

    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">AV Solutions</p>
        <h1 class="mt-3 max-w-5xl text-4xl font-black leading-tight text-[var(--text)] sm:text-6xl">Transforming spaces with cutting-edge enterprise AV technology.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[var(--muted)]">Tekvista Infosolutions delivers end-to-end AV solutions, from system design to integration and managed support, for boardrooms, training rooms, campuses, and event spaces.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach ([
            ['icon' => 'bi-camera-video-fill', 'title' => 'Video Conferencing', 'copy' => 'HD cameras, echo-cancelling audio, and intuitive control panels for seamless hybrid meetings.'],
            ['icon' => 'bi-badge-hd-fill', 'title' => 'Digital Signage', 'copy' => 'Dynamic signage displays with centralized content management for enterprise communication.'],
            ['icon' => 'bi-volume-up-fill', 'title' => 'Acoustic Solutions', 'copy' => 'Room tuning, sound treatment, and speech intelligibility optimization for high clarity.'],
            ['icon' => 'bi-sliders2-vertical', 'title' => 'AV Control Systems', 'copy' => 'Centralized automation across AV, lighting, and room controls for better user experience.'],
            ['icon' => 'bi-tools', 'title' => 'Installation and Support', 'copy' => 'Certified installation, commissioning, and lifecycle support with responsive SLA coverage.'],
            ['icon' => 'bi-easel2-fill', 'title' => 'Venue and Event AV', 'copy' => 'Temporary and permanent event AV for conferences, auditoriums, and executive briefings.'],
        ] as $item)
            <article class="neo-card p-5">
                <h2 class="text-xl font-black text-[var(--text)]"><i class="bi {{ $item['icon'] }} text-[var(--accent)] mr-2"></i>{{ $item['title'] }}</h2>
                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $item['copy'] }}</p>
            </article>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">AV OEM Ecosystem</p>
        <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Technology partners for AV integration projects</h2>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($avOems as $oem)
                <div class="logo-chip"><span class="text-lg font-black tracking-wide text-[var(--text)]">{{ $oem }}</span></div>
            @endforeach
        </div>
    </div>
</section>
@endsection
