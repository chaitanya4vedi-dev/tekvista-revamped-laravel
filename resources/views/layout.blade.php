<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#031126">
    <title>{{ $title ?? 'Tekvista Infosolutions Pvt Ltd' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Tekvista Infosolutions Private Limited - enterprise cloud, cybersecurity, networking, Zoho, Odoo, Microsoft and Google solutions.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'enterprise IT solutions, cybersecurity, cloud services, networking, Zoho, Odoo, Microsoft 365, Google Workspace, Tally on Cloud' }}">
    <link rel="manifest" href="/manifest.webmanifest">
    <link rel="icon" href="/pwa/icon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/pwa/icon-192.png">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? 'Tekvista Infosolutions Pvt Ltd' }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Tekvista Infosolutions Private Limited technology services.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $visuals['hero'] ?? 'https://images.pexels.com/photos/7414033/pexels-photo-7414033.jpeg?auto=compress&cs=tinysrgb&w=1200' }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&family=Anonymous+Pro:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    @php
        $organizationSchema = [
            '@'.'context' => 'https://schema.org',
            '@'.'type' => 'Organization',
            'name' => 'Tekvista Infosolutions Private Limited',
            'url' => url('/'),
            'telephone' => '+91 9432246063',
            'email' => 'alok@tekvista.in',
            'address' => [
                '@'.'type' => 'PostalAddress',
                'streetAddress' => 'Room No: C8 & C9, 2nd Floor, Bharat Bhawan, 3 Chittaranjan Avenue',
                'addressLocality' => 'Kolkata',
                'postalCode' => '700072',
                'addressCountry' => 'IN',
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES) !!}</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/app.css') }}?v={{ @filemtime(public_path('assets/app.css')) ?: time() }}">
    <script defer src="{{ asset('assets/app.js') }}?v={{ @filemtime(public_path('assets/app.js')) ?: time() }}"></script>
</head>
<body class="antialiased">
    @php
        $whatsAppEnterpriseText = rawurlencode('Hello Tekvista Team, we need enterprise IT consultation for our organization. Please reply in English.');
        $whatsAppUrl = "https://wa.me/919051433313?text={$whatsAppEnterpriseText}";
        $navItems = [
            ['label' => 'Home', 'icon' => 'bi-house-fill', 'route' => 'home'],
            ['label' => 'About', 'icon' => 'bi-building-fill', 'route' => 'about'],
            ['label' => 'CSR', 'icon' => 'bi-heart-fill', 'route' => 'csr'],
            [
                'label' => 'Services',
                'icon' => 'bi-grid-1x2-fill',
                'route' => 'services',
                'children' => [
                    ['label' => 'Cybersecurity', 'route' => 'cybersecurity'],
                    ['label' => 'Cloud Solutions', 'route' => 'cloud'],
                    ['label' => 'Tally on Cloud', 'route' => 'tally-on-cloud'],
                    ['label' => 'Networking', 'route' => 'networking'],
                    ['label' => 'AV Solutions', 'route' => 'av-solutions'],
                    ['label' => 'Zoho Solutions', 'route' => 'zoho'],
                    ['label' => 'Odoo Solutions', 'route' => 'odoo'],
                    ['label' => 'Mailing Solutions', 'route' => 'mailing'],
                ]
            ],
            ['label' => 'Blog', 'icon' => 'bi-journal-richtext', 'route' => 'blog.index'],
            ['label' => 'Contact', 'icon' => 'bi-envelope-check-fill', 'route' => 'contact'],
        ];
    @endphp

    <header class="app-header sticky top-0 z-50">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-2 px-3 py-2.5 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="mobile-brand flex min-w-0 items-center gap-2.5">
                <img src="{{ asset('pwa/tekvista-wordmark.svg') }}" alt="TekVista Infosolutions" class="h-9 w-auto shrink-0 sm:h-10">
            </a>

            <nav class="hidden items-center gap-1 text-sm font-semibold lg:flex">
                @foreach ($navItems as $item)
                    @if (isset($item['children']))
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <a href="{{ route($item['route']) }}" class="nav-link flex items-center gap-2 {{ request()->routeIs($item['route'].'*') ? 'nav-link-active' : '' }}">
                                <i class="bi {{ $item['icon'] }}"></i>{{ $item['label'] }}
                                <i class="bi bi-chevron-down text-xs"></i>
                            </a>
                            <div x-show="open" x-transition.opacity class="absolute left-0 top-full mt-1 w-60 rounded-xl border border-[var(--line)] bg-[var(--surface-strong)] py-2 shadow-xl backdrop-blur-md" style="display:none;">
                                @foreach ($item['children'] as $child)
                                    <a href="{{ route($child['route']) }}" class="block px-4 py-2 text-sm text-[var(--text)] hover:bg-[var(--surface-light)] hover:text-[var(--accent)]">{{ $child['label'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ route($item['route']) }}" class="nav-link {{ request()->routeIs($item['route']) ? 'nav-link-active' : '' }}"><i class="bi {{ $item['icon'] }} mr-1"></i>{{ $item['label'] }}</a>
                    @endif
                @endforeach
            </nav>

            <div class="hidden items-center gap-2 lg:flex">
            @auth
                <a href="{{ route('blog.manage.index') }}" class="btn-secondary px-3 py-2 text-sm"><i class="bi bi-pencil-square"></i>Write</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-secondary px-3 py-2 text-sm"><i class="bi bi-box-arrow-right"></i>Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-secondary px-3 py-2 text-sm"><i class="bi bi-person"></i>Login</a>
                <a href="{{ route('register') }}" class="btn-secondary px-3 py-2 text-sm"><i class="bi bi-person-plus"></i>Register</a>
            @endauth
            <a href="{{ $whatsAppUrl }}" target="_blank" rel="noopener" class="btn-primary px-4 py-2 text-sm">
                <i class="bi bi-whatsapp"></i>Talk to Experts
            </a>
            </div>

            <button class="grid size-10 shrink-0 place-items-center rounded-lg border border-[var(--line)] bg-[var(--surface-light)] text-[var(--text)] lg:hidden" data-mobile-menu-toggle type="button" aria-controls="mobile-menu" aria-expanded="false" aria-label="Open navigation">
                <i class="bi bi-list text-xl"></i>
            </button>
        </div>

        <div id="mobile-menu" class="hidden border-t border-[var(--line)] bg-[var(--surface-strong)] px-3 py-3 lg:hidden">
            <div class="mobile-menu-scroll mx-auto grid gap-1 text-sm font-semibold">
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="nav-link"><i class="bi {{ $item['icon'] }} mr-2"></i>{{ $item['label'] }}</a>
                @endforeach
                @auth
                    <a href="{{ route('blog.manage.index') }}" class="nav-link"><i class="bi bi-pencil-square mr-2"></i>Write Blog</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link w-full text-left"><i class="bi bi-box-arrow-right mr-2"></i>Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link"><i class="bi bi-person mr-2"></i>Login</a>
                    <a href="{{ route('register') }}" class="nav-link"><i class="bi bi-person-plus mr-2"></i>Register</a>
                @endauth
            </div>
        </div>
    </header>

    <main id="main">@yield('content')</main>
    @include('partials.context-cta')
    <button id="install-app" type="button" class="btn-secondary fixed bottom-5 left-5 z-50 hidden px-4 py-2 text-sm">
        <i class="bi bi-download"></i>Install App
    </button>

    <footer class="mt-16 border-t border-[var(--line)] bg-[var(--surface-strong)] py-10 backdrop-blur-xl">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
            <div>
                <p class="text-lg font-black text-[var(--text)]">Tekvista Infosolutions Pvt Ltd</p>
                <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Enterprise solutions company. Agile Innotech is part of the Tekvista ecosystem.</p>
            </div>
            <div>
                <p class="section-kicker">Enterprise Focus</p>
                <div class="mt-2 grid gap-1 text-sm text-[var(--muted)]">
                    <span><i class="bi bi-shield-check mr-2"></i>Cybersecurity</span>
                    <span><i class="bi bi-cloud-check mr-2"></i>Cloud and Tally on Cloud</span>
                    <span><i class="bi bi-envelope-at mr-2"></i>Microsoft, Google, Zoho Mail</span>
                </div>
            </div>
            <div>
                <p class="section-kicker">Contact</p>
                <p class="mt-2 text-sm text-[var(--muted)]"><i class="bi bi-telephone-fill mr-2"></i><a href="tel:+919432246063">+91 9432246063</a></p>
                <p class="text-sm text-[var(--muted)]"><i class="bi bi-envelope-fill mr-2"></i><a href="mailto:alok@tekvista.in">alok@tekvista.in</a></p>
                <p class="text-sm text-[var(--muted)]"><i class="bi bi-geo-alt-fill mr-2"></i>Kolkata, India</p>
            </div>
        </div>
    </footer>
</body>
</html>
