<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Blog\ManagePostController;
use App\Http\Controllers\ProfileController;
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
Route::get('/tally-on-cloud', [SiteController::class, 'tallyOnCloud'])->name('tally-on-cloud');
Route::get('/networking', [SiteController::class, 'networking'])->name('networking');
Route::get('/av-solutions', [SiteController::class, 'avSolutions'])->name('av-solutions');
Route::get('/zoho', [SiteController::class, 'zoho'])->name('zoho');
Route::get('/odoo', [SiteController::class, 'odoo'])->name('odoo');
Route::get('/mailing', [SiteController::class, 'mailing'])->name('mailing');
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
});

Route::middleware('auth')->prefix('dashboard/profile')->name('profile.')->group(function (): void {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
});

Route::post('/contact', [SiteController::class, 'contact'])
    ->middleware('throttle:6,1')
    ->name('contact.submit');

Route::get('/sitemap.xml', function () {
    $urls = [
        route('home'),
        route('about'),
        route('services'),
        route('cybersecurity'),
        route('cloud'),
        route('tally-on-cloud'),
        route('networking'),
        route('av-solutions'),
        route('zoho'),
        route('odoo'),
        route('mailing'),
        route('infrastructure'),
        route('csr'),
        route('contact'),
        route('blog.index'),
        url('/blog/building-a-security-first-it-roadmap-for-growing-businesses'),
        url('/blog/cloud-migration-without-business-disruption'),
        url('/blog/why-network-observability-matters-for-enterprise-it'),
        url('/blog/managed-it-support-as-a-growth-lever'),
    ];

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
    'systems.html' => '/infrastructure',
    'av.html' => '/av-solutions',
    'consultancy.html' => '/it-consultancy',
    'networking.html' => '/networking',
    'support.html' => '/it-support',
] as $from => $to) {
    Route::redirect('/'.$from, $to, 301);
}
