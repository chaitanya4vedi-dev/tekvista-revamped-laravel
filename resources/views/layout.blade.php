<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        $defaultMetaImagePath = '/images/tekvista/meta-image-tekvista-og.jpg';
        $providedMetaImage = $metaImage ?? null;
        $manifestVersion = @filemtime(public_path('manifest.webmanifest')) ?: time();
        $serviceWorkerVersion = @filemtime(public_path('service-worker.js')) ?: time();
        $faviconVersion = @filemtime(public_path('favicon-v2.ico')) ?: time();
        $icon192Version = @filemtime(public_path('pwa/icon-192-v2.png')) ?: time();
        $wordmarkVersion = @filemtime(public_path('branding/tekvista-logo-header.png')) ?: time();
        $metaImageUrl = $providedMetaImage
            ? (\Illuminate\Support\Str::startsWith($providedMetaImage, ['http://', 'https://']) ? $providedMetaImage : request()->getSchemeAndHttpHost().$providedMetaImage)
            : request()->getSchemeAndHttpHost().$defaultMetaImagePath;
        $metaImageExt = strtolower(pathinfo(parse_url($metaImageUrl, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION));
        $metaImageType = $metaImageExt === 'jpg' || $metaImageExt === 'jpeg' ? 'image/jpeg' : ($metaImageExt === 'webp' ? 'image/webp' : 'image/png');
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0bb884">
    <title>{{ $title ?? 'Tekvista Infosolutions Pvt Ltd' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Tekvista Infosolutions Private Limited delivers enterprise IT services including cloud solutions, cybersecurity, networking, AV, Zoho, Odoo, Microsoft 365 and Google Workspace from Kolkata, India.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'Tekvista Infosolutions, enterprise IT solutions Kolkata, cloud solutions, cybersecurity services, networking, AV solutions, Zoho partner, Odoo implementation, Microsoft 365, Google Workspace, Tally on Cloud' }}">
    <meta name="author" content="Tekvista Infosolutions Private Limited">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="manifest" href="/manifest.webmanifest?v={{ $manifestVersion }}">
    <link rel="icon" href="/favicon-v2.ico?v={{ $faviconVersion }}" sizes="any">
    <link rel="icon" href="/pwa/icon-192-v2.png?v={{ $icon192Version }}" type="image/png" sizes="192x192">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32-v2.png?v={{ $faviconVersion }}">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16-v2.png?v={{ $faviconVersion }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/pwa/apple-touch-icon-v2.png?v={{ $icon192Version }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_IN">
    <meta property="og:site_name" content="Tekvista Infosolutions Private Limited">
    <meta property="og:title" content="{{ $title ?? 'Tekvista Infosolutions | Enterprise Technology and Cloud Partner' }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Tekvista Infosolutions Private Limited delivers enterprise cloud, cybersecurity, networking and business technology solutions.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $metaImageUrl }}">
    <meta property="og:image:secure_url" content="{{ $metaImageUrl }}">
    <meta property="og:image:type" content="{{ $metaImageType }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Tekvista Infosolutions Private Limited enterprise IT services">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Tekvista Infosolutions | Enterprise Technology and Cloud Partner' }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? 'Tekvista Infosolutions Private Limited delivers enterprise cloud, cybersecurity, networking and business technology solutions.' }}">
    <meta name="twitter:image" content="{{ $metaImageUrl }}">
    <meta name="twitter:image:alt" content="Tekvista Infosolutions Private Limited enterprise IT services">
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
            'logo' => $metaImageUrl,
            'image' => $metaImageUrl,
            'telephone' => '+91 9432246063',
            'email' => 'alok@tekvista.in',
            'address' => [
                '@'.'type' => 'PostalAddress',
                'streetAddress' => 'Room No: C8 & C9, 2nd Floor, Bharat Bhawan, 3 Chittaranjan Avenue',
                'addressLocality' => 'Kolkata',
                'postalCode' => '700072',
                'addressCountry' => 'IN',
            ],
            'sameAs' => [
                'https://www.linkedin.com/company/tekvista',
                'https://www.facebook.com/TekVista.in',
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES) !!}</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/app.css') }}?v={{ @filemtime(public_path('assets/app.css')) ?: time() }}">
    <script defer src="{{ asset('assets/app.js') }}?v={{ @filemtime(public_path('assets/app.js')) ?: time() }}"></script>
    <script>
        if ('serviceWorker' in navigator && (location.protocol === 'https:' || ['localhost', '127.0.0.1'].includes(location.hostname))) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('/service-worker.js?v={{ $serviceWorkerVersion }}').catch(function () {});
            });
        }
    </script>
</head>
<body class="antialiased">
    @php
        $whatsAppEnterpriseText = rawurlencode('Hello Tekvista Team, we need enterprise IT consultation for our organization. Please reply in English.');
        $whatsAppUrl = "https://wa.me/919051433313?text={$whatsAppEnterpriseText}";
        $navItems = [
            ['label' => 'Home', 'route' => 'home'],
            ['label' => 'About', 'route' => 'about'],
            ['label' => 'CSR', 'route' => 'csr'],
            [
                'label' => 'Services',
                'route' => 'services',
                'children' => [
                    ['label' => 'IT Consultancy', 'route' => 'it-consultancy'],
                    ['label' => 'Cybersecurity', 'route' => 'cybersecurity'],
                    ['label' => 'Cloud Solutions', 'route' => 'cloud'],
                    ['label' => 'IT Support', 'route' => 'it-support'],
                    ['label' => 'Software Solutions', 'route' => 'software-solutions'],
                    ['label' => 'Networking', 'route' => 'networking'],
                    ['label' => 'AV Solutions', 'route' => 'av-solutions'],
                    ['label' => 'Zoho Solutions', 'route' => 'zoho'],
                    ['label' => 'Odoo Solutions', 'route' => 'odoo'],
                    ['label' => 'Mailing Solutions', 'route' => 'mailing'],
                    ['label' => 'Email Security', 'route' => 'email-security'],
                    ['label' => 'Systems & Infra', 'route' => 'infrastructure'],
                    ['label' => 'AI Integration', 'route' => 'ai-integration'],
                ]
            ],
            ['label' => 'Blog', 'route' => 'blog.index'],
            ['label' => 'Contact', 'route' => 'contact'],
        ];
    @endphp

    <header class="app-header sticky top-0 z-50">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-2 px-3 py-2.5 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="mobile-brand flex min-w-0 items-center gap-2.5">
                <img src="{{ asset('branding/tekvista-logo-header.png') }}?v={{ $wordmarkVersion }}" alt="TekVista Infosolutions" class="h-9 w-auto shrink-0 sm:h-10">
            </a>

            <nav class="hidden min-w-0 flex-1 items-center justify-center gap-1 text-sm font-semibold lg:flex">
                @foreach ($navItems as $item)
                    @if (isset($item['children']))
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <a href="{{ route($item['route']) }}" class="nav-link flex items-center gap-2 {{ request()->routeIs($item['route'].'*') ? 'nav-link-active' : '' }}">
                                {{ $item['label'] }}
                                <i class="bi bi-chevron-down text-xs"></i>
                            </a>
                            <div x-show="open" x-transition.opacity class="absolute left-0 top-full mt-1 w-60 rounded-xl border border-[var(--line)] bg-[var(--surface-strong)] py-2 shadow-xl backdrop-blur-md" style="display:none;">
                                @foreach ($item['children'] as $child)
                                    <a href="{{ route($child['route']) }}" class="block px-4 py-2 text-sm text-[var(--text)] hover:bg-[var(--surface-light)] hover:text-[var(--accent)]">{{ $child['label'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ route($item['route']) }}" class="nav-link {{ request()->routeIs($item['route']) ? 'nav-link-active' : '' }}">{{ $item['label'] }}</a>
                    @endif
                @endforeach
            </nav>

            <div class="hidden shrink-0 items-center gap-2 lg:flex">
            @auth
                <a href="{{ route('blog.manage.index') }}" class="btn-secondary px-3 py-2 text-sm"><i class="bi bi-pencil-square"></i>Write</a>
                <a href="{{ route('profile.edit') }}" class="btn-secondary px-3 py-2 text-sm"><i class="bi bi-person-gear"></i>Profile</a>
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
                    <a href="{{ route($item['route']) }}" class="nav-link">{{ $item['label'] }}</a>
                @endforeach
                @auth
                    <a href="{{ route('blog.manage.index') }}" class="nav-link"><i class="bi bi-pencil-square mr-2"></i>Write Blog</a>
                    <a href="{{ route('profile.edit') }}" class="nav-link"><i class="bi bi-person-gear mr-2"></i>Edit Profile</a>
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
        <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-4 lg:px-8">
            <div>
                <p class="text-lg font-black text-[var(--text)]">Tekvista Infosolutions Pvt Ltd</p>
                <p class="mt-2 text-sm leading-7 text-[var(--muted)]">Enterprise IT delivery across cybersecurity, cloud, infrastructure, collaboration, and business applications.</p>
                <div class="mt-4 grid gap-1 text-sm text-[var(--muted)]">
                    <span><i class="bi bi-shield-check mr-2"></i>Cybersecurity</span>
                    <span><i class="bi bi-cloud-check mr-2"></i>Cloud and Infrastructure</span>
                    <span><i class="bi bi-envelope-at mr-2"></i>Mail and Email Security</span>
                </div>
            </div>

            <div>
                <p class="section-kicker">Quick Links</p>
                <div class="mt-3 grid gap-2 text-sm text-[var(--muted)]">
                    <a href="{{ route('home') }}" class="hover:text-[var(--accent)]">Home</a>
                    <a href="{{ route('about') }}" class="hover:text-[var(--accent)]">About</a>
                    <a href="{{ route('services') }}" class="hover:text-[var(--accent)]">Services</a>
                    <a href="{{ route('csr') }}" class="hover:text-[var(--accent)]">CSR</a>
                    <a href="{{ route('blog.index') }}" class="hover:text-[var(--accent)]">Blog</a>
                    <a href="{{ route('contact') }}" class="hover:text-[var(--accent)]">Contact</a>
                </div>
            </div>

            <div>
                <p class="section-kicker">Service Links</p>
                <div class="mt-3 grid gap-2 text-sm text-[var(--muted)]">
                    <a href="{{ route('it-consultancy') }}" class="hover:text-[var(--accent)]">IT Consultancy</a>
                    <a href="{{ route('cybersecurity') }}" class="hover:text-[var(--accent)]">Cybersecurity</a>
                    <a href="{{ route('email-security') }}" class="hover:text-[var(--accent)]">Email Security</a>
                    <a href="{{ route('cloud') }}" class="hover:text-[var(--accent)]">Cloud Solutions</a>
                    <a href="{{ route('networking') }}" class="hover:text-[var(--accent)]">Networking</a>
                    <a href="{{ route('it-support') }}" class="hover:text-[var(--accent)]">IT Support</a>
                    <a href="{{ route('software-solutions') }}" class="hover:text-[var(--accent)]">Software Solutions</a>
                    <a href="{{ route('av-solutions') }}" class="hover:text-[var(--accent)]">AV Solutions</a>
                    <a href="{{ route('zoho') }}" class="hover:text-[var(--accent)]">Zoho Solutions</a>
                    <a href="{{ route('odoo') }}" class="hover:text-[var(--accent)]">Odoo Solutions</a>
                    <a href="{{ route('mailing') }}" class="hover:text-[var(--accent)]">Mailing Solutions</a>
                    <a href="{{ route('infrastructure') }}" class="hover:text-[var(--accent)]">Systems and Infra</a>
                    <a href="{{ route('ai-integration') }}" class="hover:text-[var(--accent)]">AI Integration</a>
                </div>
            </div>

            <div>
                <p class="section-kicker">Contact</p>
                <p class="mt-3 text-sm text-[var(--muted)]"><i class="bi bi-telephone-fill mr-2"></i><a href="tel:+919432246063">+91 9432246063</a></p>
                <p class="mt-1 text-sm text-[var(--muted)]"><i class="bi bi-telephone mr-2"></i><a href="tel:+913348001523">033 48001523</a></p>
                <p class="mt-1 text-sm text-[var(--muted)]"><i class="bi bi-envelope-fill mr-2"></i><a href="mailto:alok@tekvista.in">alok@tekvista.in</a></p>
                <p class="mt-1 text-sm text-[var(--muted)]"><i class="bi bi-geo-alt-fill mr-2"></i>Kolkata, India</p>
            </div>
        </div>
        <div class="mx-auto mt-8 max-w-7xl border-t border-[var(--line)] px-4 pt-4 text-xs text-[var(--muted)] sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-between gap-2">
                <p>© {{ now()->year }} Tekvista Infosolutions Pvt Ltd. All rights reserved.</p>
                <a href="{{ url('/sitemap.xml') }}" class="hover:text-[var(--accent)]">Sitemap</a>
            </div>
        </div>
    </footer>
</body>
</html>
