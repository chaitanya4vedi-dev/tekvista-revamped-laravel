<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Blog\ManagePostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/services', [SiteController::class, 'services'])->name('services');
Route::get('/it-consultancy', [SiteController::class, 'itConsultancy'])->name('it-consultancy');
Route::get('/it-support', [SiteController::class, 'itSupport'])->name('it-support');
Route::get('/software-solutions', [SiteController::class, 'softwareSolutions'])->name('software-solutions');
Route::get('/ai-integration', [SiteController::class, 'aiIntegration'])->name('ai-integration');
Route::get('/cybersecurity', [SiteController::class, 'cybersecurity'])->name('cybersecurity');
Route::get('/cloud', [SiteController::class, 'cloud'])->name('cloud');
Route::get('/networking', [SiteController::class, 'networking'])->name('networking');
Route::get('/av-solutions', [SiteController::class, 'avSolutions'])->name('av-solutions');
Route::get('/zoho', [SiteController::class, 'zoho'])->name('zoho');
Route::get('/odoo', [SiteController::class, 'odoo'])->name('odoo');
Route::get('/mailing', [SiteController::class, 'mailing'])->name('mailing');
Route::get('/email-security', [SiteController::class, 'emailSecurity'])->name('email-security');
Route::get('/infrastructure', [SiteController::class, 'infrastructure'])->name('infrastructure');
Route::get('/csr', [SiteController::class, 'csr'])->name('csr');
Route::get('/contact', [SiteController::class, 'contactPage'])->name('contact');
Route::get('/blog', [SiteController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [SiteController::class, 'blogShow'])->name('blog.show');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:6,1')->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('dashboard/blog')->name('blog.manage.')->group(function (): void {
    Route::get('/', [ManagePostController::class, 'index'])->name('index');
    Route::get('/create', [ManagePostController::class, 'create'])->name('create');
    Route::post('/create', [ManagePostController::class, 'store'])->name('store');
    Route::get('/{post}/edit', [ManagePostController::class, 'edit'])->name('edit');
    Route::patch('/{post}/edit', [ManagePostController::class, 'update'])->name('update');
});

Route::middleware('auth')->prefix('dashboard/profile')->name('profile.')->group(function (): void {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
});

Route::post('/contact', [SiteController::class, 'contact'])
    ->middleware('throttle:6,1')
    ->name('contact.submit');

$policyPages = [
    'privacy-policy' => 'Privacy Policy',
    'refund-policy' => 'Refund Policy',
    'return-policy' => 'Return Policy',
    'terms-of-use' => 'Terms of Use',
    'cookie-policy' => 'Cookie Policy',
    'disclaimer' => 'Disclaimer',
    'security-policy' => 'Security Policy',
    'safe-harbor' => 'Safe Harbor',
    'data-processing-agreement' => 'Data Processing Agreement',
    'gdpr-data-subject-rights' => 'GDPR Data Subject Rights',
    'eula-terms-of-sale' => 'EULA Terms of Sale',
    'modern-slavery-csr' => 'Modern Slavery CSR',
    'accessibility-statement' => 'Accessibility Statement',
    'service-level-agreement' => 'Service Level Agreement',
    'shipping-policy' => 'Shipping Policy',
    'terms-and-conditions' => 'Terms & Conditions',
];

foreach ($policyPages as $slug => $label) {
    Route::get('/'.$slug, [SiteController::class, 'policy'])
        ->defaults('slug', $slug)
        ->name("policy.{$slug}");
}

Route::get('/sitemap.xml', function () use ($policyPages) {
    $now = now()->toAtomString();
    $staticUrls = [
        ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly', 'lastmod' => $now],
        ['loc' => route('about'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('services'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $now],
        ['loc' => route('it-consultancy'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('it-support'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('software-solutions'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('ai-integration'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('cybersecurity'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $now],
        ['loc' => route('cloud'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $now],
        ['loc' => route('networking'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('av-solutions'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('zoho'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('odoo'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('mailing'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('email-security'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('infrastructure'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('csr'), 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('contact'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
        ['loc' => route('blog.index'), 'priority' => '0.9', 'changefreq' => 'daily', 'lastmod' => $now],
    ];

    $policyUrls = collect(array_keys($policyPages))->map(
        fn (string $slug): array => [
            'loc' => url('/'.$slug),
            'priority' => '0.6',
            'changefreq' => 'monthly',
            'lastmod' => $now,
        ]
    );

    try {
        $blogUrls = Post::query()
            ->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now()->utc());
            })
            ->orderByDesc('published_at')
            ->get(['slug', 'published_at', 'updated_at'])
            ->map(fn (Post $post): array => [
                'loc' => route('blog.show', $post->slug),
                'priority' => '0.7',
                'changefreq' => 'weekly',
                'lastmod' => ($post->updated_at ?? $post->published_at ?? now())->toAtomString(),
            ]);
    } catch (\Throwable) {
        $blogUrls = collect();
    }

    if ($blogUrls->isEmpty()) {
        $blogUrls = collect([
            ['loc' => url('/blog/building-a-security-first-it-roadmap-for-growing-businesses'), 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => $now],
            ['loc' => url('/blog/cloud-migration-without-business-disruption'), 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => $now],
            ['loc' => url('/blog/why-network-observability-matters-for-enterprise-it'), 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => $now],
            ['loc' => url('/blog/managed-it-support-as-a-growth-lever'), 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => $now],
        ]);
    }

    $urls = collect($staticUrls)
        ->merge($policyUrls)
        ->merge($blogUrls)
        ->values()
        ->all();

    $xml = view('sitemap', ['urls' => $urls]);

    return response($xml, 200)->header('Content-Type', 'application/xml');
});

foreach ([
    'index.html' => '/',
    'about.html' => '/about',
    'csr.html' => '/csr',
    'contact.html' => '/contact',
    'software.html' => '/services',
    'cloud.html' => '/cloud',
    'cybersecurity.html' => '/cybersecurity',
    'email-security.html' => '/email-security',
    'systems.html' => '/infrastructure',
    'av.html' => '/av-solutions',
    'consultancy.html' => '/it-consultancy',
    'networking.html' => '/networking',
    'support.html' => '/it-support',
] as $from => $to) {
    Route::redirect('/'.$from, $to, 301);
}

Route::redirect('/tally-on-cloud', '/cloud', 301);
