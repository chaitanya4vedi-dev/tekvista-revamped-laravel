<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactInquiry;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $data = $this->pageData();

        return view('pages.home', [
            ...$data,
            ...$this->seo(
                'Home',
                'Tekvista Infosolutions delivers enterprise cloud, cybersecurity, networking, Zoho, Odoo, Microsoft and Google solutions from Kolkata.',
                'enterprise IT solutions Kolkata, cloud solutions, cybersecurity services, Zoho partner, Odoo implementation, Microsoft 365, Google Workspace'
            ),
            'latestPosts' => $this->publishedPosts()->take(3),
        ]);
    }

    public function about(): View
    {
        $data = $this->pageData();

        return view('pages.about', [
            ...$data,
            ...$this->seo('About', 'About Tekvista Infosolutions Private Limited, enterprise IT delivery model, and technology leadership.', 'about tekvista infosolutions, enterprise technology company kolkata, IT consulting company profile'),
        ]);
    }

    public function services(): View
    {
        $data = $this->pageData();

        return view('pages.services', [
            ...$data,
            ...$this->seo('Services', 'Explore Tekvista enterprise services across cybersecurity, cloud, networking, AV, Zoho, Odoo and mailing solutions.', 'enterprise services, cybersecurity, cloud services, networking solutions, av solutions, Zoho solutions, Odoo ERP, mailing solutions'),
        ]);
    }

    public function cybersecurity(): View
    {
        return view('pages.services.cybersecurity', [...$this->pageData(), ...$this->seo('Cybersecurity', 'Enterprise-grade cybersecurity solutions protecting your assets and data.', 'cybersecurity services, SOC, MDR, zero trust, endpoint security')]);
    }

    public function cloud(): View
    {
        return view('pages.services.cloud', [...$this->pageData(), ...$this->seo('Cloud Solutions', 'Scalable, secure, and resilient enterprise cloud architectures.', 'cloud migration, cloud governance, managed cloud services, enterprise cloud')]);
    }

    public function tallyOnCloud(): View
    {
        return view('pages.services.tally-on-cloud', [...$this->pageData(), ...$this->seo('Tally on Cloud', 'Reliable and accessible Tally on Cloud services for continuous business operations.', 'tally on cloud, tally hosting, tally remote access, tally cloud backup')]);
    }

    public function networking(): View
    {
        return view('pages.services.networking', [...$this->pageData(), ...$this->seo('Networking', 'Next-generation networking infrastructure for high performance and observability.', 'enterprise networking, SD-WAN, firewall, network monitoring')]);
    }

    public function avSolutions(): View
    {
        return view('pages.services.av-solutions', [...$this->pageData(), ...$this->seo('AV Solutions', 'End-to-end enterprise AV solutions from boardrooms to digital signage with design, integration, and managed support.', 'av solutions kolkata, video conferencing setup, digital signage, boardroom av, conference room audio visual integration')]);
    }

    public function zoho(): View
    {
        return view('pages.services.zoho', [...$this->pageData(), ...$this->seo('Zoho Solutions', 'Comprehensive Zoho implementation and support for seamless workflows.', 'zoho solutions, zoho one, zoho crm, zoho mail implementation')]);
    }

    public function odoo(): View
    {
        return view('pages.services.odoo', [...$this->pageData(), ...$this->seo('Odoo Solutions', 'End-to-end Odoo ERP implementation for enterprise resource planning.', 'odoo implementation, odoo ERP, odoo customization, odoo integration')]);
    }

    public function mailing(): View
    {
        return view('pages.services.mailing', [...$this->pageData(), ...$this->seo('Mailing Solutions', 'Enterprise mailing platforms including Microsoft 365, Google Workspace, and Zoho Mail.', 'microsoft 365 setup, google workspace migration, zoho mail setup, enterprise email security')]);
    }

    public function infrastructure(): View
    {
        return view('pages.infrastructure', [...$this->pageData(), ...$this->seo('Infrastructure', 'Infrastructure architecture, deployment and operations support by Tekvista Infosolutions.', 'IT infrastructure services, server setup, virtualization, data center operations')]);
    }

    public function csr(): View
    {
        return view('pages.csr', [...$this->pageData(), ...$this->seo('CSR', 'Tekvista corporate social responsibility initiatives focused on education and community impact.', 'tekvista csr, corporate social responsibility kolkata')]);
    }

    public function contactPage(): View
    {
        return view('pages.contact', [...$this->pageData(), ...$this->seo('Contact', 'Contact Tekvista Infosolutions for IT consulting, implementation and managed support.', 'contact tekvista infosolutions, enterprise IT consultation kolkata')]);
    }

    public function blogIndex(Request $request): View
    {
        $data = $this->pageData();
        $category = trim((string) $request->query('category', ''));
        $tag = trim((string) $request->query('tag', ''));
        $query = trim((string) $request->query('q', ''));

        $posts = Post::query()
            ->with(['categories', 'tags'])
            ->where('is_published', true)
            ->when($query !== '', fn ($q) => $q->where(function ($inner) use ($query) {
                $inner->where('title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            }))
            ->when($category !== '', fn ($q) => $q->whereHas('categories', fn ($c) => $c->where('slug', Str::slug($category))))
            ->when($tag !== '', fn ($q) => $q->whereHas('tags', fn ($t) => $t->where('slug', Str::slug($tag))))
            ->orderByDesc('published_on')
            ->orderByDesc('created_at')
            ->get();

        $allCategories = Category::query()->withCount('posts')->orderBy('name')->get()->mapWithKeys(fn ($c) => [$c->name => $c->posts_count]);
        $allTags = Tag::query()->withCount('posts')->orderBy('name')->get()->mapWithKeys(fn ($t) => [$t->name => $t->posts_count]);

        return view('pages.blog.index', [
            ...$data,
            ...$this->seo('Blog', 'Insights on IT strategy, cloud, cybersecurity, networking, Zoho, Odoo and enterprise support operations.', 'enterprise IT blog, cloud strategy, cybersecurity insights, networking best practices, Zoho and Odoo blogs'),
            'posts' => $posts,
            'allCategories' => $allCategories,
            'allTags' => $allTags,
            'selectedCategory' => $category,
            'selectedTag' => $tag,
            'searchQuery' => $query,
        ]);
    }

    public function blogShow(string $slug): View
    {
        $post = Post::query()->with(['categories', 'tags'])->where('slug', $slug)->where('is_published', true)->firstOrFail();

        $relatedPosts = Post::query()
            ->with(['categories', 'tags'])
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->where(function ($q) use ($post) {
                $q->whereHas('categories', fn ($c) => $c->whereIn('categories.id', $post->categories->pluck('id')))
                  ->orWhereHas('tags', fn ($t) => $t->whereIn('tags.id', $post->tags->pluck('id')));
            })
            ->orderByDesc('published_on')
            ->take(3)
            ->get();

        return view('pages.blog.show', [
            ...$this->pageData(),
            ...$this->seo($post->meta_title ?: $post->title, $post->meta_description ?: $post->excerpt, $post->meta_keywords ?: $post->tags->pluck('name')->implode(', ')),
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    public function contact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:160'],
            'company' => ['nullable', 'string', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'service' => ['nullable', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:2200'],
        ]);

        ContactInquiry::create([...$validated, 'ip_address' => $request->ip(), 'user_agent' => $request->userAgent()]);

        return redirect()->route('contact')->with('status', 'Thanks. Tekvista will review your inquiry and respond shortly.');
    }

    private function seo(string $pageTitle, string $description, string $keywords = ''): array
    {
        return ['title' => "Tekvista Infosolutions | {$pageTitle}", 'metaDescription' => $description, 'metaKeywords' => $keywords];
    }

    private function publishedPosts(): Collection
    {
        $dbPosts = Post::query()->with(['categories', 'tags'])->where('is_published', true)->orderByDesc('published_on')->take(4)->get();

        if ($dbPosts->isNotEmpty()) {
            return $dbPosts;
        }

        return collect();
    }

    private function pageData(): array
    {
        $services = [
            ['name' => 'Cybersecurity', 'route' => 'cybersecurity', 'tagline' => 'Enterprise-Grade Security Architecture.', 'summary' => 'Protecting your digital assets with advanced endpoint security, zero-trust frameworks, and continuous threat monitoring.'],
            ['name' => 'Cloud Solutions', 'route' => 'cloud', 'tagline' => 'Resilient Cloud Architectures.', 'summary' => 'Scalable infrastructure designed for performance, rapid deployment, and optimized operational costs.'],
            ['name' => 'Tally on Cloud', 'route' => 'tally-on-cloud', 'tagline' => 'Uninterrupted Financial Workflows.', 'summary' => 'Host your mission-critical Tally ERP on secure, high-availability cloud infrastructure.'],
            ['name' => 'Networking Solutions', 'route' => 'networking', 'tagline' => 'High-Performance Connectivity.', 'summary' => 'Enterprise networking designs ensuring stable performance, observability, and controlled growth.'],
            ['name' => 'AV Solutions', 'route' => 'av-solutions', 'tagline' => 'Immersive Collaboration Experiences.', 'summary' => 'Boardroom AV, video conferencing, digital signage, and control systems integrated for enterprise communication.'],
            ['name' => 'Zoho Solutions', 'route' => 'zoho', 'tagline' => 'Streamlined Business Operations.', 'summary' => 'Comprehensive integration, customization, and support for the full suite of Zoho applications.'],
            ['name' => 'Odoo Solutions', 'route' => 'odoo', 'tagline' => 'Enterprise Resource Planning.', 'summary' => 'End-to-end implementation of Odoo ERP, centralizing finance, inventory, manufacturing, and sales into one platform.'],
            ['name' => 'Mailing Solutions', 'route' => 'mailing', 'tagline' => 'Secure Enterprise Communication.', 'summary' => 'Implementing and managing industry-leading mailing platforms, including Microsoft 365, Google Workspace, and Zoho Mail.'],
            ['name' => 'Systems & Infra', 'route' => 'infrastructure', 'tagline' => 'Scalable backbone for modern teams', 'summary' => 'Servers, storage, virtualization, data-center planning, monitoring and resilient architecture for enterprise workloads.'],
        ];

        return [
            'visuals' => [
                'hero' => 'https://images.pexels.com/photos/7414033/pexels-photo-7414033.jpeg?auto=compress&cs=tinysrgb&w=1800',
                'strategy' => 'https://images.pexels.com/photos/6913224/pexels-photo-6913224.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'workspace' => 'https://images.pexels.com/photos/6774146/pexels-photo-6774146.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'engineering' => 'https://images.pexels.com/photos/3867849/pexels-photo-3867849.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'support' => 'https://images.pexels.com/photos/6774939/pexels-photo-6774939.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'ops' => 'https://images.pexels.com/photos/5990030/pexels-photo-5990030.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'infra' => 'https://images.pexels.com/photos/325229/pexels-photo-325229.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'security' => 'https://images.pexels.com/photos/5380659/pexels-photo-5380659.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'network' => 'https://images.pexels.com/photos/442150/pexels-photo-442150.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'zoho' => 'https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'odoo' => 'https://images.pexels.com/photos/735911/pexels-photo-735911.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'mail' => 'https://images.pexels.com/photos/1933239/pexels-photo-1933239.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'av' => 'https://images.pexels.com/photos/159888/pexels-photo-159888.jpeg?auto=compress&cs=tinysrgb&w=1400',
            ],
            'services' => $services,
            'contact' => [
                'address' => 'Room No: C8 & C9, 2nd Floor, Bharat Bhawan, 3 Chittaranjan Avenue, Kolkata 700072',
                'phone' => '+91 9432246063',
                'landline' => '033 48001523',
                'email' => 'alok@tekvista.in',
                'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.9352152562333!2d88.35689168326019!3d22.581526226589904!2m3!1f0!2f0!3f0!2m3!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0277b35ee8cd2f%3A0x25e4ff4786813b73!2s3%2C%20Chittaranjan%20Ave%2C%20Raja%20Katra%2C%20College%20Street%20Market%2C%20College%20Street%2C%20Kolkata%2C%20West%20Bengal%20700007!5e0!3m2!1sen!2sin!4v1718801082220!5m2!1sen!2sin',
            ],
            'metrics' => [
                ['value' => '20+', 'label' => 'OEM and industry partnerships'],
                ['value' => '150+', 'label' => 'Satisfied business customers'],
                ['value' => '5-star', 'label' => 'Customer review rating'],
                ['value' => '2021', 'label' => 'Private limited incorporation'],
            ],
            'credibility' => [
                'CIN' => 'U72900WB2021PTC248435',
                'ROC' => 'ROC Kolkata',
                'Company Status' => 'Active',
                'Business Activity' => 'Enterprise IT and computer-related services',
            ],
            'csrPoints' => [
                'Tekvista supports school infrastructure initiatives at Shree BadriKedar Dhanuka Adarsh Vidya Mandir, Churu.',
                'CSR focus includes safe and modern classroom environments for long-term student outcomes.',
                'Projects emphasize quality education access, digital enablement, and community-first development.',
                'Our CSR model aligns sustainable business growth with practical social impact in education.',
            ],
            'avOems' => ['Crestron', 'Biamp', 'Poly', 'Logitech', 'Barco', 'AMX'],
        ];
    }
}
