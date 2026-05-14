@extends('layout')

@section('content')
<section class="hero-shell">
    <img src="{{ $visuals['hero'] }}" alt="Enterprise IT team" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(105deg,rgba(247,255,251,0.92),rgba(241,253,247,0.82),rgba(231,248,239,0.52))]"></div>

    <div class="mx-auto grid min-h-[84svh] max-w-7xl gap-8 px-4 py-16 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-8 lg:py-24">
        <div class="self-center">
            <p class="section-kicker">Enterprise Technology Platform</p>
            <h1 class="mt-3 text-5xl font-black leading-[1.03] text-[var(--text)] sm:text-7xl">Tekvista Infosolutions</h1>
            <p class="mt-4 max-w-3xl text-2xl font-bold text-[#1f5d4b] sm:text-3xl">Cloud, Cybersecurity, Networking, Zoho, Odoo, and Business Mail - engineered for enterprise operations.</p>
            <p class="mt-5 max-w-2xl text-base leading-8 text-[var(--muted)]">We help businesses modernize mission-critical infrastructure with a future-ready operating model inspired by enterprise standards.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('services') }}" class="btn-primary"><i class="bi bi-grid-1x2-fill"></i>Explore Services</a>
                <a href="{{ route('contact') }}" class="btn-secondary"><i class="bi bi-telephone-forward-fill"></i>Consult Experts</a>
            </div>
        </div>

        <div class="neo-card p-5 self-end">
            <div class="mb-4 flex items-center justify-between">
                <p class="section-kicker">Live Capabilities</p>
                <span class="rounded-full border border-[var(--line)] px-3 py-1 text-xs font-mono text-[var(--accent)]">24x7</span>
            </div>
            <div class="grid gap-3">
                <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3"><i class="bi bi-shield-lock-fill mr-2 text-[var(--accent)]"></i>Cybersecurity and governance controls</div>
                <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3"><i class="bi bi-cloud-check-fill mr-2 text-[var(--accent)]"></i>Cloud architecture and migration</div>
                <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3"><i class="bi bi-hdd-network-fill mr-2 text-[var(--accent)]"></i>Enterprise networking and observability</div>
                <div class="rounded-xl border border-[var(--line)] bg-[var(--surface-light)] p-3"><i class="bi bi-envelope-at-fill mr-2 text-[var(--accent)]"></i>Microsoft, Google, Zoho mailing platforms</div>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <p class="section-kicker">Core Solutions</p>
        <h2 class="mt-2 text-4xl font-black">Enterprise service portfolio</h2>
    </div>
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @php
            $serviceIcons = [
                'IT Consultancy' => 'bi-briefcase-fill',
                'Cybersecurity' => 'bi-shield-lock-fill',
                'Cloud Solutions' => 'bi-cloud-check-fill',
                'Networking Solutions' => 'bi-hdd-network-fill',
                'IT Support' => 'bi-headset',
                'Software Solutions' => 'bi-code-slash',
                'AV Solutions' => 'bi-camera-video-fill',
                'Zoho Solutions' => 'bi-diagram-3-fill',
                'Odoo Solutions' => 'bi-kanban-fill',
                'Mailing Solutions' => 'bi-envelope-at-fill',
                'Email Security' => 'bi-shield-exclamation',
                'AI Integration' => 'bi-cpu-fill',
                'Systems & Infra' => 'bi-server',
            ];
        @endphp
        @foreach ($services as $service)
            <a href="{{ route($service['route']) }}" class="neo-card p-5 hover:border-[var(--accent)] transition-colors">
                <h3 class="text-xl font-black text-[var(--text)]"><i class="bi {{ $serviceIcons[$service['name']] ?? 'bi-stars' }} text-[var(--accent)] mr-2"></i>{{ $service['name'] }}</h3>
                <p class="mt-2 text-sm font-semibold text-[var(--text)]">{{ $service['tagline'] }}</p>
                <p class="mt-3 text-sm text-[var(--muted)]">{{ $service['summary'] }}</p>
            </a>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-14 max-w-7xl px-4 pb-10 sm:px-6 lg:px-8">
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="section-kicker">Latest Insights</p>
            <h2 class="mt-2 text-4xl font-black text-[var(--text)]">From the Tekvista blog</h2>
            <p class="mt-2 max-w-3xl text-sm text-[var(--muted)]">Short, actionable enterprise IT insights from our consulting and implementation teams.</p>
        </div>
        <a href="{{ route('blog.index') }}" class="btn-secondary"><i class="bi bi-journal-text"></i>View All Posts</a>
    </div>
    @if(($latestPosts ?? collect())->isEmpty())
        <div class="neo-card p-6 text-sm text-[var(--muted)]">No published posts yet. Fresh insights will appear here automatically.</div>
    @else
        <div class="grid gap-5 md:grid-cols-3">
            @foreach ($latestPosts as $post)
                <article class="neo-card overflow-hidden">
                    <img src="{{ $post->hero ?: 'https://images.pexels.com/photos/7414033/pexels-photo-7414033.jpeg?auto=compress&cs=tinysrgb&w=1400' }}" alt="{{ $post->title }}" class="h-48 w-full object-cover">
                    <div class="p-5">
                        <p class="section-kicker">{{ $post->categories->pluck('name')->first() ?: 'Enterprise' }} / {{ $post->read_time }}</p>
                        <h3 class="mt-2 text-xl font-black leading-7 text-[var(--text)]">{{ $post->title }}</h3>
                        <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $post->excerpt }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn-secondary mt-4 px-4 py-2 text-sm">Read Article</a>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection
