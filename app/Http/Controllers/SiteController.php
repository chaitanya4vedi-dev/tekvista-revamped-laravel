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
    private const PUBLISH_TZ = 'Asia/Kolkata';
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
            ...$this->seo('Services', 'Explore Tekvista enterprise services across cybersecurity, cloud, networking, AV, Zoho, Odoo, mailing and email security solutions.', 'enterprise services, cybersecurity, cloud services, networking solutions, av solutions, Zoho solutions, Odoo ERP, mailing solutions, email security services'),
        ]);
    }

    public function itConsultancy(): View
    {
        return view('pages.services.it-consultancy', [...$this->pageData(), ...$this->seo('IT Consultancy', 'Enterprise IT consulting for strategy, architecture, optimization, and modernization roadmaps.', 'it consultancy kolkata, enterprise IT consulting, technology roadmap, IT strategy')]);
    }

    public function itSupport(): View
    {
        return view('pages.services.it-support', [...$this->pageData(), ...$this->seo('IT Support', 'SLA-oriented IT support services covering proactive monitoring, incident response, and lifecycle support.', 'managed IT support, IT operations support, SLA support services, enterprise helpdesk')]);
    }

    public function softwareSolutions(): View
    {
        return view('pages.services.software-solutions', [...$this->pageData(), ...$this->seo('Software Solutions', 'Custom software development and system integration services for enterprise business outcomes.', 'software solutions kolkata, custom software development, enterprise workflow automation')]);
    }

    public function aiIntegration(): View
    {
        return view('pages.services.ai-integration', [...$this->pageData(), ...$this->seo('AI Integration', 'Applied AI integration services to improve business workflows, decisioning, and productivity.', 'AI integration services, enterprise AI workflows, business process automation')]);
    }

    public function cybersecurity(): View
    {
        return view('pages.services.cybersecurity', [...$this->pageData(), ...$this->seo('Cybersecurity', 'Enterprise-grade cybersecurity solutions protecting your assets and data.', 'cybersecurity services, SOC, MDR, zero trust, endpoint security')]);
    }

    public function cloud(): View
    {
        return view('pages.services.cloud', [...$this->pageData(), ...$this->seo('Cloud Solutions', 'Scalable, secure, and resilient enterprise cloud architectures.', 'cloud migration, cloud governance, managed cloud services, enterprise cloud')]);
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
        return view('pages.services.zoho', [
            ...$this->pageData(),
            ...$this->seo(
                'Zoho Solutions',
                'Official Zoho partner services from Tekvista including implementation, migration, automation, governance, and managed support.',
                'zoho partner india, zoho implementation services, zoho crm partner, zoho one implementation, zoho automation consulting'
            ),
            'zohoServices' => $this->zohoServicePages(),
        ]);
    }

    public function zohoService(string $zohoPage): View
    {
        $zohoServices = $this->zohoServicePages();
        abort_if(!isset($zohoServices[$zohoPage]), 404);

        $service = $zohoServices[$zohoPage];

        return view('pages.services.zoho-detail', [
            ...$this->pageData(),
            ...$this->seo(
                $service['seoTitle'],
                $service['seoDescription'],
                $service['seoKeywords']
            ),
            'zohoService' => $service,
            'zohoServices' => $zohoServices,
        ]);
    }

    public function odoo(): View
    {
        return view('pages.services.odoo', [
            ...$this->pageData(),
            ...$this->seo(
                'Odoo Solutions',
                'Practical Odoo setup and support from Tekvista for sales, finance, inventory, manufacturing, HR, and operations.',
                'odoo implementation partner, odoo services india, odoo crm, odoo accounting, odoo inventory'
            ),
            'odooServices' => $this->odooServicePages(),
        ]);
    }

    public function odooService(string $odooPage): View
    {
        $odooServices = $this->odooServicePages();
        abort_if(!isset($odooServices[$odooPage]), 404);

        $service = $odooServices[$odooPage];

        return view('pages.services.odoo-detail', [
            ...$this->pageData(),
            ...$this->seo(
                $service['seoTitle'],
                $service['seoDescription'],
                $service['seoKeywords']
            ),
            'odooService' => $service,
            'odooServices' => $odooServices,
        ]);
    }

    public function mailing(): View
    {
        return view('pages.services.mailing', [...$this->pageData(), ...$this->seo('Mailing Solutions', 'Enterprise mailing platforms including Microsoft 365, Google Workspace, and Zoho Mail.', 'microsoft 365 setup, google workspace migration, zoho mail setup, enterprise email security')]);
    }

    public function emailSecurity(): View
    {
        return view('pages.services.email-security', [...$this->pageData(), ...$this->seo('Email Security', 'Enterprise email security services for phishing defense, policy enforcement, and continuity planning.', 'email security services, barracuda, fortimail, sophos email, anti phishing gateway, dmarc implementation')]);
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

    public function policy(string $slug): View
    {
        $policies = $this->legalPolicies();
        abort_if(!isset($policies[$slug]), 404);

        $policy = $policies[$slug];

        return view('pages.policy', [
            ...$this->pageData(),
            ...$this->seo($policy['title'], $policy['metaDescription'], $policy['metaKeywords']),
            'policy' => $policy,
            'policySlug' => $slug,
            'policyIndex' => $policies,
            'policyEffectiveDate' => now(self::PUBLISH_TZ)->format('F j, Y'),
        ]);
    }

    public function blogIndex(Request $request): View
    {
        $data = $this->pageData();
        $category = trim((string) $request->query('category', ''));
        $tag = trim((string) $request->query('tag', ''));
        $query = trim((string) $request->query('q', ''));

        $posts = Post::query()
            ->with(['categories', 'tags', 'author'])
            ->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now()->utc());
            })
            ->when($query !== '', fn ($q) => $q->where(function ($inner) use ($query) {
                $inner->where('title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            }))
            ->when($category !== '', fn ($q) => $q->whereHas('categories', fn ($c) => $c->where('slug', Str::slug($category))))
            ->when($tag !== '', fn ($q) => $q->whereHas('tags', fn ($t) => $t->where('slug', Str::slug($tag))))
            ->orderByDesc('published_at')
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
        $post = Post::query()
            ->with(['categories', 'tags', 'author'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now()->utc());
            })
            ->firstOrFail();

        $relatedPosts = Post::query()
            ->with(['categories', 'tags'])
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now()->utc());
            })
            ->where(function ($q) use ($post) {
                $q->whereHas('categories', fn ($c) => $c->whereIn('categories.id', $post->categories->pluck('id')))
                  ->orWhereHas('tags', fn ($t) => $t->whereIn('tags.id', $post->tags->pluck('id')));
            })
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('pages.blog.show', [
            ...$this->pageData(),
            ...$this->seo(
                $post->meta_title ?: $post->title,
                $post->meta_description ?: $post->excerpt,
                $post->meta_keywords ?: $post->tags->pluck('name')->implode(', '),
                $post->hero ?: '/images/tekvista/meta-image-tekvista.png'
            ),
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

    private function seo(string $pageTitle, string $description, string $keywords = '', ?string $metaImage = null): array
    {
        return [
            'title' => "Tekvista Infosolutions | {$pageTitle}",
            'metaDescription' => $description,
            'metaKeywords' => $keywords,
            'metaImage' => $metaImage,
        ];
    }

    private function legalPolicies(): array
    {
        return [
            'privacy-policy' => [
                'title' => 'Privacy Policy',
                'metaDescription' => 'How Tekvista Infosolutions Private Limited collects, processes, secures, and retains personal and business data across IT consulting and managed services.',
                'metaKeywords' => 'Tekvista privacy policy, data protection policy, DPDP compliance support, business data handling',
                'summary' => 'This Privacy Policy explains how Tekvista Infosolutions Private Limited handles personal and operational data when you use our website, submit inquiries, or engage us for enterprise technology services.',
                'sections' => [
                    ['heading' => 'Information We Collect', 'points' => ['Contact details shared in forms, calls, emails, and project discussions.', 'Project and service records such as requirements, ticket history, and implementation notes.', 'Security and technical telemetry including IP address, user-agent, and request logs for abuse prevention.']],
                    ['heading' => 'How We Use Information', 'points' => ['To respond to consultations, deliver contracted services, and provide ongoing support.', 'To maintain service quality, prevent fraud, and strengthen infrastructure security.', 'To comply with lawful requests, accounting obligations, and record-retention needs.']],
                    ['heading' => 'Data Rights and Contact', 'points' => ['You may request access, correction, or deletion of personal data where applicable law permits.', 'Privacy requests can be sent to alok@tekvista.in with your organization details and request scope.']],
                ],
            ],
            'refund-policy' => [
                'title' => 'Refund Policy',
                'metaDescription' => 'Refund terms for Tekvista Infosolutions service engagements, software subscriptions, and implementation projects.',
                'metaKeywords' => 'Tekvista refund policy, IT service refund, implementation refund terms',
                'summary' => 'Refunds are governed by the commercial scope, milestone acceptance, and third-party licensing conditions defined in the signed proposal or agreement.',
                'sections' => [
                    ['heading' => 'General Refund Framework', 'points' => ['Advance retainers and discovery fees are generally non-refundable once engagement starts.', 'Milestone-based work is billable for accepted deliverables and effort completed.', 'Refund eligibility is evaluated against approved scope, delivery evidence, and signed terms.']],
                    ['heading' => 'Subscription and License Components', 'points' => ['Third-party licenses, cloud fees, and OEM subscriptions follow provider refund rules.', 'Provisioned license keys or activated subscriptions are typically non-refundable.']],
                    ['heading' => 'Escalation Process', 'points' => ['Send refund requests to alok@tekvista.in within seven business days of invoiced dispute.', 'Include invoice number, project reference, and reason for refund review.']],
                ],
            ],
            'return-policy' => [
                'title' => 'Return Policy',
                'metaDescription' => 'Return process for hardware and bundled IT products supplied through Tekvista Infosolutions procurement channels.',
                'metaKeywords' => 'Tekvista return policy, IT hardware return, DOA replacement terms',
                'summary' => 'Return terms apply mainly to physical products procured through Tekvista-led supply and are subject to OEM/authorized distributor conditions.',
                'sections' => [
                    ['heading' => 'Eligible Return Cases', 'points' => ['Dead-on-arrival products reported within 48 hours of delivery.', 'Wrong SKU, incomplete shipment, or transit-damaged package with delivery evidence.', 'Manufacturer-approved replacement cases under valid warranty scope.']],
                    ['heading' => 'Non-Returnable Cases', 'points' => ['Opened software media, activated licenses, and custom-ordered items.', 'Consumables and products damaged due to misuse or unauthorized changes.']],
                    ['heading' => 'Return Workflow', 'points' => ['Write to alok@tekvista.in with invoice, serial number, and issue visuals.', 'RMA timelines depend on OEM validation and logistics partner pick-up cycles.']],
                ],
            ],
            'terms-of-use' => [
                'title' => 'Terms of Use',
                'metaDescription' => 'Website usage terms for Tekvista Infosolutions including acceptable use, intellectual property, and liability boundaries.',
                'metaKeywords' => 'Tekvista terms of use, website use terms, acceptable use policy',
                'summary' => 'By using this website, you agree to lawful usage, accurate inquiry submissions, and respect for intellectual property and security boundaries.',
                'sections' => [
                    ['heading' => 'Acceptable Use', 'points' => ['Do not attempt unauthorized access, scraping abuse, or service disruption.', 'Do not submit false, harmful, or unlawful content through forms and channels.']],
                    ['heading' => 'Content and IP', 'points' => ['Website copy, graphics, and solution descriptions remain property of Tekvista and respective trademark owners.', 'Brand logos shown on service pages are used only for partner ecosystem representation.']],
                    ['heading' => 'Service Dependency', 'points' => ['Website information is indicative and may be superseded by signed commercial agreements.', 'Tekvista may revise pages, offerings, and policies without prior notice.']],
                ],
            ],
            'cookie-policy' => [
                'title' => 'Cookie Policy',
                'metaDescription' => 'Cookie and tracking practices for Tekvista Infosolutions website, including functional and security cookies.',
                'metaKeywords' => 'Tekvista cookie policy, website cookies, session cookies',
                'summary' => 'Our site uses limited cookies and local-storage mechanisms to maintain sessions, security, and basic website functionality.',
                'sections' => [
                    ['heading' => 'Cookie Categories Used', 'points' => ['Essential session cookies for login state, CSRF security, and request integrity.', 'Preference storage to remember lightweight UI settings and usability choices.']],
                    ['heading' => 'How to Manage Cookies', 'points' => ['You can clear or block cookies in browser settings, but core site features may degrade.', 'Security-related cookies are required for authenticated and form-based interactions.']],
                    ['heading' => 'Policy Updates', 'points' => ['Cookie practices may change when new features or analytics tooling is introduced.', 'Material updates will be reflected on this page with revised effective date.']],
                ],
            ],
            'disclaimer' => [
                'title' => 'Disclaimer',
                'metaDescription' => 'Legal disclaimer for information and service descriptions published by Tekvista Infosolutions Private Limited.',
                'metaKeywords' => 'Tekvista disclaimer, website legal disclaimer, IT advisory disclaimer',
                'summary' => 'Information on this website is provided for general business context and does not constitute legal, tax, or regulatory advice.',
                'sections' => [
                    ['heading' => 'Informational Nature', 'points' => ['Service details are indicative and may vary by project complexity and customer environment.', 'Compliance references describe implementation support and not legal representation.']],
                    ['heading' => 'No Warranty of Continuous Availability', 'points' => ['Website availability may be affected by maintenance windows, network outages, or force majeure events.', 'Tekvista is not liable for indirect losses arising solely from website downtime.']],
                    ['heading' => 'Third-Party References', 'points' => ['External brand, OEM, and platform names belong to their respective owners.', 'Links to third-party resources are provided for convenience and may change without notice.']],
                ],
            ],
            'security-policy' => [
                'title' => 'Security Policy',
                'metaDescription' => 'Security governance commitments for Tekvista Infosolutions covering access control, incident response, and infrastructure hardening.',
                'metaKeywords' => 'Tekvista security policy, cybersecurity governance, incident response',
                'summary' => 'Tekvista operates a security-first delivery model with layered controls across identity, infrastructure, endpoint, and operational support processes.',
                'sections' => [
                    ['heading' => 'Control Baseline', 'points' => ['Least-privilege access, MFA controls, and role-bound administrative rights.', 'Segmentation, endpoint security, and monitoring workflows for risk reduction.', 'Change-management and approval workflows for production-impacting actions.']],
                    ['heading' => 'Incident Handling', 'points' => ['Priority-based triage, root-cause documentation, and customer communication cadence.', 'Escalation routing for critical alerts and suspected compromise events.']],
                    ['heading' => 'Customer Shared Responsibility', 'points' => ['Some controls require customer-side participation such as policy approvals and user training.', 'Final risk acceptance remains with the data owner organization.']],
                ],
            ],
            'safe-harbor' => [
                'title' => 'Safe Harbor',
                'metaDescription' => 'Forward-looking statements and implementation assumptions for Tekvista service roadmaps and projected outcomes.',
                'metaKeywords' => 'Tekvista safe harbor, forward-looking statements, implementation assumptions',
                'summary' => 'Roadmap statements, estimation references, and performance forecasts are forward-looking and depend on evolving business, technology, and regulatory conditions.',
                'sections' => [
                    ['heading' => 'Forward-Looking Nature', 'points' => ['Projected timelines and outcomes are estimates, not guarantees.', 'Dependency changes, third-party delays, and scope shifts can impact plans.']],
                    ['heading' => 'Decision Responsibility', 'points' => ['Customers should validate strategic decisions with internal legal, finance, and risk stakeholders.', 'Commercial commitments become binding only through executed agreements.']],
                ],
            ],
            'data-processing-agreement' => [
                'title' => 'Data Processing Agreement',
                'metaDescription' => 'Data Processing Agreement terms describing controller-processor responsibilities for Tekvista-managed services.',
                'metaKeywords' => 'Tekvista DPA, data processing agreement, controller processor terms',
                'summary' => 'This DPA outlines baseline data processing principles when Tekvista processes customer data for managed operations, support, migration, or implementation services.',
                'sections' => [
                    ['heading' => 'Roles and Scope', 'points' => ['Customer typically acts as data controller and Tekvista acts as processor for defined service scope.', 'Processing is limited to documented instructions and contractual purpose.']],
                    ['heading' => 'Security and Subprocessors', 'points' => ['Reasonable technical and organizational safeguards are applied for confidentiality and integrity.', 'Subprocessor use may occur for cloud or tooling dependencies under suitable contractual controls.']],
                    ['heading' => 'Retention and Deletion', 'points' => ['Data retention is linked to service necessity, legal obligations, and backup-cycle constraints.', 'Upon service closure, deletion or return workflows are handled as contractually agreed.']],
                ],
            ],
            'gdpr-data-subject-rights' => [
                'title' => 'GDPR Data Subject Rights',
                'metaDescription' => 'How Tekvista supports GDPR data subject rights requests for access, correction, portability, and deletion where applicable.',
                'metaKeywords' => 'Tekvista GDPR rights, data subject request, privacy rights support',
                'summary' => 'Where GDPR applies, Tekvista supports lawful handling of data subject requests in coordination with the responsible customer controller.',
                'sections' => [
                    ['heading' => 'Rights We Help Facilitate', 'points' => ['Access, rectification, erasure, restriction, and portability requests.', 'Objection handling and consent-related withdrawal support when applicable.']],
                    ['heading' => 'How to Submit Requests', 'points' => ['Send request context to alok@tekvista.in with identity and relationship details.', 'Requests may be routed to the customer controller for formal authorization and response.']],
                    ['heading' => 'Verification and Timelines', 'points' => ['Identity and legal basis checks are required before data disclosure or action.', 'Response windows depend on applicable law and controller instructions.']],
                ],
            ],
            'eula-terms-of-sale' => [
                'title' => 'EULA Terms of Sale',
                'metaDescription' => 'Software usage and commercial terms for Tekvista-delivered software licenses, bundles, and integration services.',
                'metaKeywords' => 'Tekvista EULA, software terms of sale, IT licensing terms',
                'summary' => 'These terms apply to software licenses, implementation components, and value-added bundles sold or provisioned through Tekvista engagements.',
                'sections' => [
                    ['heading' => 'License Grant and Limitations', 'points' => ['Software usage rights are limited to scope permitted by vendor license terms.', 'Unauthorized redistribution, reverse engineering, or misuse is prohibited unless legally permitted.']],
                    ['heading' => 'Commercial Terms', 'points' => ['Pricing, taxes, and renewal obligations are governed by invoice and signed proposal.', 'Activation or provisioning of software usually marks non-cancellable commitment for that cycle.']],
                    ['heading' => 'Support Boundary', 'points' => ['Tekvista support scope is defined by plan, SLA, and vendor escalation matrix.', 'Feature roadmaps and upstream bug fixes remain subject to software publisher control.']],
                ],
            ],
            'modern-slavery-csr' => [
                'title' => 'Modern Slavery CSR',
                'metaDescription' => 'Tekvista commitment to ethical labor practices, anti-exploitation controls, and responsible procurement.',
                'metaKeywords' => 'Tekvista modern slavery statement, ethical sourcing, CSR labor policy',
                'summary' => 'Tekvista does not tolerate forced labor, bonded labor, child exploitation, or unethical workforce practices in our operations and supply interactions.',
                'sections' => [
                    ['heading' => 'Core Commitment', 'points' => ['Respect for human rights, fair treatment, and lawful employment practices.', 'Expectation that suppliers and partners adhere to ethical labor principles.']],
                    ['heading' => 'Risk Controls', 'points' => ['Supplier onboarding checks and contract-level compliance expectations where feasible.', 'Escalation process for reported misconduct or policy violations.']],
                    ['heading' => 'CSR Linkage', 'points' => ['Our CSR model emphasizes dignity, inclusion, and community-first development outcomes.', 'Concerns can be reported to alok@tekvista.in for review.']],
                ],
            ],
            'accessibility-statement' => [
                'title' => 'Accessibility Statement',
                'metaDescription' => 'Accessibility commitment for Tekvista digital experiences, including usability improvements for diverse users.',
                'metaKeywords' => 'Tekvista accessibility statement, inclusive design, website accessibility',
                'summary' => 'Tekvista works to improve accessibility and inclusive usability across devices, browsers, and assistive contexts.',
                'sections' => [
                    ['heading' => 'Current Accessibility Focus', 'points' => ['Readable typography, semantic headings, alternative text, and responsive layouts.', 'Keyboard-friendly interaction patterns for core navigation and forms.']],
                    ['heading' => 'Continuous Improvement', 'points' => ['Accessibility refinements are applied as templates and components evolve.', 'User feedback is prioritized when specific blockers are reported.']],
                    ['heading' => 'Requesting Assistance', 'points' => ['If you face an accessibility issue, email alok@tekvista.in with page URL and issue details.', 'We will aim to provide practical alternatives and remediation guidance.']],
                ],
            ],
            'service-level-agreement' => [
                'title' => 'Service Level Agreement',
                'metaDescription' => 'SLA baseline for Tekvista managed services covering response windows, severity levels, and support responsibilities.',
                'metaKeywords' => 'Tekvista SLA, managed IT response time, support agreement',
                'summary' => 'SLA commitments are finalized in project contracts, but this page provides the baseline approach for support prioritization and response governance.',
                'sections' => [
                    ['heading' => 'Severity and Response', 'points' => ['Critical incidents receive accelerated triage and active communication updates.', 'Standard and low-priority requests are handled by queue-based operational scheduling.']],
                    ['heading' => 'Coverage Assumptions', 'points' => ['SLA clocks apply during agreed support windows unless contract states 24x7 coverage.', 'Response time and resolution time are distinct metrics and may differ by issue class.']],
                    ['heading' => 'Customer Responsibilities', 'points' => ['Provide authorized contacts, clear issue details, and required environment access.', 'Coordinate internal approvers for change and remediation actions.']],
                ],
            ],
            'shipping-policy' => [
                'title' => 'Shipping Policy',
                'metaDescription' => 'Shipping, dispatch, and delivery policy for hardware and physical items fulfilled through Tekvista Infosolutions.',
                'metaKeywords' => 'Tekvista shipping policy, IT hardware dispatch, delivery terms',
                'summary' => 'Shipping terms apply when Tekvista handles procurement and dispatch of physical devices, accessories, or infrastructure components.',
                'sections' => [
                    ['heading' => 'Dispatch and Delivery', 'points' => ['Dispatch timelines depend on stock availability, OEM lead times, and commercial clearance.', 'Delivery estimates are indicative and subject to logistics partner performance.']],
                    ['heading' => 'Delivery Verification', 'points' => ['Recipients should inspect packaging condition at delivery and report issues promptly.', 'Proof-of-delivery and courier status logs are treated as primary delivery evidence.']],
                    ['heading' => 'Shipping Exceptions', 'points' => ['Remote-zone deliveries, force majeure, or regulatory constraints may delay shipment.', 'Insurance, handling, or expedited freight charges may apply where explicitly agreed.']],
                ],
            ],
            'terms-and-conditions' => [
                'title' => 'Terms & Conditions',
                'metaDescription' => 'Master terms and conditions governing Tekvista Infosolutions website usage and service engagement baseline.',
                'metaKeywords' => 'Tekvista terms and conditions, legal terms, IT services contract baseline',
                'summary' => 'These Terms & Conditions define the baseline legal framework for using this website and engaging Tekvista services unless superseded by executed agreements.',
                'sections' => [
                    ['heading' => 'General Conditions', 'points' => ['Use of this site implies acceptance of lawful-use, policy, and compliance terms.', 'Violations may result in access controls, suspension, or legal recourse.']],
                    ['heading' => 'Commercial and Legal Priority', 'points' => ['Signed proposals, statements of work, and MSAs take precedence for project-specific commitments.', 'Any conflict between website statements and signed contracts is resolved in favor of signed contracts.']],
                    ['heading' => 'Jurisdiction', 'points' => ['Unless otherwise agreed in writing, disputes are interpreted under applicable Indian law and jurisdiction.']],
                ],
            ],
        ];
    }

    private function publishedPosts(): Collection
    {
        $dbPosts = Post::query()
            ->with(['categories', 'tags'])
            ->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now()->utc());
            })
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        if ($dbPosts->isNotEmpty()) {
            return $dbPosts;
        }

        return collect();
    }

    private function zohoServicePages(): array
    {
        $defaultPhases = [
            ['title' => '1. Understand your process', 'copy' => 'We review your current workflow, team roles, and pain points.'],
            ['title' => '2. Configure and automate', 'copy' => 'We set up modules, fields, rules, and approvals in Zoho.'],
            ['title' => '3. Migrate and test', 'copy' => 'We move your data safely and test with real business scenarios.'],
            ['title' => '4. Go live and improve', 'copy' => 'We train your team and keep improving after launch.'],
        ];

        $defaultGovernance = [
            'Role based access so every user sees only what is needed.',
            'Approval rules for sensitive actions and data updates.',
            'Regular data quality checks and cleanup routines.',
            'Clear admin handover with simple documentation.',
        ];

        $services = [
            'zoho-one' => [
                'name' => 'Zoho One',
                'logo' => asset('images/tekvista/logos/zoho/zoho-one.svg'),
                'heroImage' => 'https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg?auto=compress&cs=tinysrgb&w=1600',
                'cardSummary' => 'One connected suite for sales, finance, HR, and support teams.',
                'heroTitle' => 'Run key teams on one connected Zoho setup.',
                'heroSummary' => 'Tekvista helps you plan and launch Zoho One so your teams can work together without tool confusion.',
                'summaryTitle' => 'What we do in Zoho One projects',
                'summaryBody' => [
                    'We map each department and choose the right apps inside Zoho One.',
                    'We connect data between teams and roll out in safe phases.',
                ],
                'capabilities' => [
                    ['title' => 'Suite planning', 'copy' => 'Select the right apps for your daily business flow.'],
                    ['title' => 'Cross app automation', 'copy' => 'Move information from one team to another automatically.'],
                    ['title' => 'Admin and access setup', 'copy' => 'Set role permissions and security basics from day one.'],
                    ['title' => 'Adoption support', 'copy' => 'Train users and guide internal admins after go live.'],
                ],
                'useCases' => [
                    ['title' => 'Too many disconnected tools', 'copy' => 'Bring teams into one simple and connected ecosystem.'],
                    ['title' => 'Repeated manual handoffs', 'copy' => 'Replace handoffs with workflows and alerts.'],
                    ['title' => 'No single management view', 'copy' => 'Create shared dashboards across departments.'],
                    ['title' => 'Fast business growth', 'copy' => 'Scale with a system that is easier to manage.'],
                ],
                'faqs' => [
                    ['q' => 'Can we launch Zoho One in phases?', 'a' => 'Yes. We usually launch by priority so risk stays low.'],
                    ['q' => 'Can you migrate data from older tools?', 'a' => 'Yes. We plan migration, testing, and cutover support.'],
                    ['q' => 'Do you provide post launch support?', 'a' => 'Yes. We can support users, admins, and new requests.'],
                ],
                'related' => ['crm', 'books', 'people', 'desk', 'flow', 'workplace'],
                'seoDescription' => 'Tekvista Zoho One services for rollout planning, app setup, automation, and ongoing support.',
                'seoKeywords' => 'zoho one services, zoho one implementation partner, zoho one consulting india',
            ],
            'crm' => [
                'name' => 'Zoho CRM',
                'logo' => asset('images/tekvista/logos/zoho/crm.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Track leads and deals clearly with better sales follow up.',
                'heroTitle' => 'Make sales tracking easier with Zoho CRM.',
                'heroSummary' => 'We build a clear sales pipeline in Zoho CRM so your team can follow leads and close deals faster.',
                'summaryTitle' => 'How we set up Zoho CRM',
                'summaryBody' => [
                    'We design stages, lead rules, and reminders to match your real sales process.',
                    'You get dashboards that are simple for sales teams and leadership.',
                ],
                'capabilities' => [
                    ['title' => 'Pipeline setup', 'copy' => 'Define stages, owners, and next step actions.'],
                    ['title' => 'Lead automation', 'copy' => 'Auto assign leads by source, location, or product.'],
                    ['title' => 'Sales reminders', 'copy' => 'Follow up alerts and task workflows for reps.'],
                    ['title' => 'Reports and dashboards', 'copy' => 'Simple views for pipeline, win rate, and team activity.'],
                ],
                'useCases' => [
                    ['title' => 'Lead follow up is inconsistent', 'copy' => 'Create a fixed process with clear ownership.'],
                    ['title' => 'Forecast feels unreliable', 'copy' => 'Track deals in real time with clean stage data.'],
                    ['title' => 'Sales data is spread out', 'copy' => 'Keep all customer communication in one place.'],
                    ['title' => 'Team is growing quickly', 'copy' => 'Standardize process for every sales user.'],
                ],
                'faqs' => [
                    ['q' => 'Can you migrate from another CRM?', 'a' => 'Yes. We map fields, clean data, and migrate safely.'],
                    ['q' => 'Can CRM connect with support and finance apps?', 'a' => 'Yes. We can connect CRM with other Zoho apps.'],
                    ['q' => 'Will sales team training be included?', 'a' => 'Yes. We include role wise training and admin handover.'],
                ],
                'related' => ['zoho-one', 'desk', 'flow', 'analytics', 'bigin'],
                'seoDescription' => 'Tekvista Zoho CRM setup for lead management, deal tracking, automation, and reporting.',
                'seoKeywords' => 'zoho crm implementation, zoho crm partner india, zoho crm consulting',
            ],
            'books' => [
                'name' => 'Zoho Books',
                'logo' => asset('images/tekvista/logos/zoho/books.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Simple accounting, invoicing, and finance approvals in one place.',
                'heroTitle' => 'Improve accounting flow with Zoho Books.',
                'heroSummary' => 'We set up Zoho Books so billing, vendor payments, and basic finance controls are easier to run.',
                'summaryTitle' => 'Our Zoho Books approach',
                'summaryBody' => [
                    'We configure your chart, taxes, templates, and approval steps.',
                    'Your finance team gets reports that are easy to review every month.',
                ],
                'capabilities' => [
                    ['title' => 'Accounting setup', 'copy' => 'Accounts, taxes, vouchers, and base finance settings.'],
                    ['title' => 'Billing automation', 'copy' => 'Quotes, invoices, reminders, and payment tracking.'],
                    ['title' => 'Expense and vendor flow', 'copy' => 'Control purchase and payment approval steps.'],
                    ['title' => 'Finance reports', 'copy' => 'Cash flow, receivables, and management summaries.'],
                ],
                'useCases' => [
                    ['title' => 'Manual bookkeeping is slow', 'copy' => 'Automate routine accounting tasks and reminders.'],
                    ['title' => 'Approvals are unclear', 'copy' => 'Define who approves what and when.'],
                    ['title' => 'Collections are delayed', 'copy' => 'Use reminder flows and payment tracking.'],
                    ['title' => 'Need better monthly reporting', 'copy' => 'Build clean and consistent report views.'],
                ],
                'faqs' => [
                    ['q' => 'Can Books fit our current process?', 'a' => 'Yes. We configure around your team workflow.'],
                    ['q' => 'Can it connect with CRM?', 'a' => 'Yes. We can connect sales and accounting data.'],
                    ['q' => 'Do you support go live?', 'a' => 'Yes. We stay with your team during transition.'],
                ],
                'related' => ['zoho-one', 'crm', 'inventory', 'analytics'],
                'seoDescription' => 'Tekvista Zoho Books services for accounting setup, billing flow, approvals, and finance reports.',
                'seoKeywords' => 'zoho books implementation, zoho books partner, zoho accounting services',
            ],
            'people' => [
                'name' => 'Zoho People',
                'logo' => asset('images/tekvista/logos/zoho/people.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Digital HR for onboarding, attendance, leave, and employee records.',
                'heroTitle' => 'Manage HR tasks in a simpler way with Zoho People.',
                'heroSummary' => 'We help your HR team move from spreadsheets to clear workflows for attendance, leave, and employee lifecycle.',
                'summaryTitle' => 'What we deliver for HR teams',
                'summaryBody' => [
                    'We set up employee records, policy rules, and manager approval steps.',
                    'HR and managers get easier visibility into day to day requests.',
                ],
                'capabilities' => [
                    ['title' => 'Employee lifecycle setup', 'copy' => 'Onboarding, role changes, and exit workflows.'],
                    ['title' => 'Attendance and leave rules', 'copy' => 'Policy based rules with approval flows.'],
                    ['title' => 'Self service forms', 'copy' => 'Employees can update records and request approvals.'],
                    ['title' => 'HR reporting', 'copy' => 'Simple reports on attendance and workflow turnaround.'],
                ],
                'useCases' => [
                    ['title' => 'HR process is mostly manual', 'copy' => 'Digitize requests and reduce email follow ups.'],
                    ['title' => 'Multi branch workforce', 'copy' => 'Use one policy framework with local flexibility.'],
                    ['title' => 'Policy tracking is hard', 'copy' => 'Put policy rules directly into workflows.'],
                    ['title' => 'Team size is growing', 'copy' => 'Scale HR operations with less manual effort.'],
                ],
                'faqs' => [
                    ['q' => 'Can leave policies be customized?', 'a' => 'Yes. We configure rules by role and location.'],
                    ['q' => 'Can HR data stay secure?', 'a' => 'Yes. We set role access for sensitive records.'],
                    ['q' => 'Do you train HR and managers?', 'a' => 'Yes. We include practical training sessions.'],
                ],
                'related' => ['zoho-one', 'recruit', 'cliq', 'creator'],
                'seoDescription' => 'Tekvista Zoho People services for HR process digitization, attendance, leave, and employee workflows.',
                'seoKeywords' => 'zoho people implementation, zoho hr services, zoho people partner',
            ],
            'desk' => [
                'name' => 'Zoho Desk',
                'logo' => asset('images/tekvista/logos/zoho/desk.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Ticket based customer support with SLA tracking and escalation.',
                'heroTitle' => 'Give your support team a clear ticket workflow with Zoho Desk.',
                'heroSummary' => 'We configure Zoho Desk for ticket routing, SLA rules, escalation, and support reporting.',
                'summaryTitle' => 'Support operations made practical',
                'summaryBody' => [
                    'We build queues and response rules that match your support model.',
                    'Your team gets better visibility on pending tickets and service quality.',
                ],
                'capabilities' => [
                    ['title' => 'Ticket queues and routing', 'copy' => 'Assign issues automatically by category and priority.'],
                    ['title' => 'SLA and escalation setup', 'copy' => 'Response and resolution targets with alerts.'],
                    ['title' => 'Knowledge base support', 'copy' => 'Organize reusable help content for agents and customers.'],
                    ['title' => 'Service dashboards', 'copy' => 'Track volume, backlog, and team response quality.'],
                ],
                'useCases' => [
                    ['title' => 'Support is run through email only', 'copy' => 'Move to structured tickets with ownership.'],
                    ['title' => 'Escalations are unplanned', 'copy' => 'Create clear escalation paths and SLAs.'],
                    ['title' => 'No visibility into service quality', 'copy' => 'Use measurable ticket performance dashboards.'],
                    ['title' => 'High ticket volumes', 'copy' => 'Automate routing to reduce manual triage work.'],
                ],
                'faqs' => [
                    ['q' => 'Can Desk support multiple teams?', 'a' => 'Yes. We can set up departments and custom queues.'],
                    ['q' => 'Can Desk link with CRM?', 'a' => 'Yes. We can connect ticket and customer history.'],
                    ['q' => 'Do you help after launch?', 'a' => 'Yes. We support tuning and ongoing improvements.'],
                ],
                'related' => ['crm', 'zoho-one', 'flow', 'analytics'],
                'seoDescription' => 'Tekvista Zoho Desk services for support ticket setup, SLA workflows, and reporting.',
                'seoKeywords' => 'zoho desk implementation, zoho support setup, zoho desk consulting',
            ],
            'creator' => [
                'name' => 'Zoho Creator',
                'logo' => asset('images/tekvista/logos/zoho/creator.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Low code custom apps for business workflows and approvals.',
                'heroTitle' => 'Build custom business apps quickly with Zoho Creator.',
                'heroSummary' => 'Tekvista builds low code apps in Zoho Creator for workflows that standard modules cannot fully cover.',
                'summaryTitle' => 'Custom apps with maintainable setup',
                'summaryBody' => [
                    'We define forms, logic, and reports around real process steps.',
                    'Apps are built for easy updates and secure role based access.',
                ],
                'capabilities' => [
                    ['title' => 'App design', 'copy' => 'Build forms and modules for your exact use case.'],
                    ['title' => 'Workflow logic', 'copy' => 'Approvals, alerts, and status based automation.'],
                    ['title' => 'Integrations', 'copy' => 'Connect Creator apps with Zoho and selected third party tools.'],
                    ['title' => 'Lifecycle support', 'copy' => 'Testing, rollout, and controlled change updates.'],
                ],
                'useCases' => [
                    ['title' => 'Spreadsheet based tracking', 'copy' => 'Turn manual sheets into structured apps.'],
                    ['title' => 'Department specific process gaps', 'copy' => 'Build apps for operations, QA, field teams, and more.'],
                    ['title' => 'Need faster internal tools', 'copy' => 'Launch useful apps without long dev cycles.'],
                    ['title' => 'Data is spread everywhere', 'copy' => 'Keep process data in one managed place.'],
                ],
                'faqs' => [
                    ['q' => 'Can Creator apps scale as we grow?', 'a' => 'Yes. We design with future updates in mind.'],
                    ['q' => 'Can we use apps on mobile?', 'a' => 'Yes. Creator apps can support mobile users.'],
                    ['q' => 'Do you maintain apps after launch?', 'a' => 'Yes. We support enhancement and support plans.'],
                ],
                'related' => ['flow', 'crm', 'people', 'projects'],
                'seoDescription' => 'Tekvista Zoho Creator services for custom low code apps, workflows, and integrations.',
                'seoKeywords' => 'zoho creator development, zoho low code services, zoho creator partner',
            ],
            'flow' => [
                'name' => 'Zoho Flow',
                'logo' => asset('images/tekvista/logos/zoho/flow.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Automate tasks between Zoho apps and external software.',
                'heroTitle' => 'Connect apps and reduce manual work with Zoho Flow.',
                'heroSummary' => 'We build reliable automation between systems so teams do less copy paste and fewer repetitive tasks.',
                'summaryTitle' => 'Smart integration done safely',
                'summaryBody' => [
                    'We define triggers, actions, and fallback steps for each automation.',
                    'Your team gets visibility into flow runs and error handling.',
                ],
                'capabilities' => [
                    ['title' => 'Integration mapping', 'copy' => 'Plan source, target, and data field mapping.'],
                    ['title' => 'Workflow automation', 'copy' => 'Trigger actions from business events in real time.'],
                    ['title' => 'Error handling', 'copy' => 'Retries, alerts, and fallback paths for failed runs.'],
                    ['title' => 'Monitoring', 'copy' => 'Track success rate and improve flows over time.'],
                ],
                'useCases' => [
                    ['title' => 'Manual data transfer', 'copy' => 'Automate repetitive copy work between apps.'],
                    ['title' => 'Delayed follow up actions', 'copy' => 'Trigger next steps instantly from key events.'],
                    ['title' => 'Duplicate data issues', 'copy' => 'Keep systems in sync with controlled mapping.'],
                    ['title' => 'No automation visibility', 'copy' => 'Add dashboards and alerts for flow health.'],
                ],
                'faqs' => [
                    ['q' => 'Can Flow connect non Zoho tools?', 'a' => 'Yes. We use supported connectors and APIs.'],
                    ['q' => 'Can you add error alerts?', 'a' => 'Yes. We build alerts and fallback logic.'],
                    ['q' => 'Can flows be changed later?', 'a' => 'Yes. We support controlled updates and testing.'],
                ],
                'related' => ['zoho-one', 'crm', 'books', 'creator'],
                'seoDescription' => 'Tekvista Zoho Flow services for app integration, automation design, and monitoring.',
                'seoKeywords' => 'zoho flow services, zoho integration automation, zoho flow partner',
            ],
            'workplace' => [
                'name' => 'Zoho Workplace',
                'logo' => asset('images/tekvista/logos/zoho/workplace.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Business email and team collaboration in one secure suite.',
                'heroTitle' => 'Set up secure email and collaboration with Zoho Workplace.',
                'heroSummary' => 'We help you move to Zoho Workplace with mailbox migration, user setup, and collaboration best practices.',
                'summaryTitle' => 'Simple collaboration rollout',
                'summaryBody' => [
                    'We plan DNS, mailbox migration, and user onboarding by batches.',
                    'Teams get practical guidance for mail, docs, and communication apps.',
                ],
                'capabilities' => [
                    ['title' => 'Mailbox migration', 'copy' => 'Plan and move accounts with minimal disruption.'],
                    ['title' => 'Domain and security setup', 'copy' => 'Configure DNS, policies, and account controls.'],
                    ['title' => 'Collaboration tools enablement', 'copy' => 'Set up docs, chat, and meeting workflows.'],
                    ['title' => 'User onboarding', 'copy' => 'Train users and admins for faster adoption.'],
                ],
                'useCases' => [
                    ['title' => 'Legacy mail platform issues', 'copy' => 'Move to a modern and easier platform.'],
                    ['title' => 'Need one collaboration stack', 'copy' => 'Bring mail and team apps into one suite.'],
                    ['title' => 'Sharing controls are weak', 'copy' => 'Apply clear access and sharing policies.'],
                    ['title' => 'Remote team growth', 'copy' => 'Support distributed teams with standard tools.'],
                ],
                'faqs' => [
                    ['q' => 'Can you migrate from Google or Microsoft mail?', 'a' => 'Yes. We support phased mailbox migrations.'],
                    ['q' => 'Will users get onboarding help?', 'a' => 'Yes. We provide guided onboarding sessions.'],
                    ['q' => 'Do you configure security policies?', 'a' => 'Yes. We set policy controls for accounts and sharing.'],
                ],
                'related' => ['mail', 'cliq', 'zoho-one', 'people'],
                'seoDescription' => 'Tekvista Zoho Workplace services for mailbox migration, collaboration setup, and user onboarding.',
                'seoKeywords' => 'zoho workplace migration, zoho mail setup, zoho workplace partner',
            ],
            'projects' => [
                'name' => 'Zoho Projects',
                'logo' => asset('images/tekvista/logos/zoho/projects.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Project planning, task tracking, and team accountability in one view.',
                'heroTitle' => 'Track project work clearly with Zoho Projects.',
                'heroSummary' => 'We set up Zoho Projects so teams can plan tasks, deadlines, and collaboration without confusion.',
                'summaryTitle' => 'Practical project management setup',
                'summaryBody' => [
                    'We create project templates, milestones, and task workflows.',
                    'Managers get clear status views and delivery tracking.',
                ],
                'capabilities' => [
                    ['title' => 'Project templates', 'copy' => 'Reusable structures for repeat project types.'],
                    ['title' => 'Task and milestone tracking', 'copy' => 'Owners, due dates, dependencies, and alerts.'],
                    ['title' => 'Team collaboration', 'copy' => 'Comments, files, and updates inside project records.'],
                    ['title' => 'Project dashboards', 'copy' => 'Simple status, progress, and delay visibility.'],
                ],
                'useCases' => [
                    ['title' => 'Task ownership is unclear', 'copy' => 'Assign owners and track completion properly.'],
                    ['title' => 'Deadlines often slip', 'copy' => 'Use reminders and dependency visibility.'],
                    ['title' => 'Status meetings take too long', 'copy' => 'Use real time dashboards for quick reviews.'],
                    ['title' => 'Project communication is scattered', 'copy' => 'Keep discussion and files in one place.'],
                ],
                'faqs' => [
                    ['q' => 'Can projects be grouped by team?', 'a' => 'Yes. We can structure views by team or department.'],
                    ['q' => 'Can this connect with Zoho CRM?', 'a' => 'Yes. We can connect sales and delivery workflows.'],
                    ['q' => 'Can we get project reporting dashboards?', 'a' => 'Yes. We build dashboards for delivery reviews.'],
                ],
                'related' => ['crm', 'creator', 'analytics', 'workplace'],
                'seoDescription' => 'Tekvista Zoho Projects services for project planning, execution tracking, and reporting.',
                'seoKeywords' => 'zoho projects implementation, zoho project management setup, zoho projects partner',
            ],
            'inventory' => [
                'name' => 'Zoho Inventory',
                'logo' => asset('images/tekvista/logos/zoho/inventory.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Stock, order, and shipment visibility for better operations control.',
                'heroTitle' => 'Control stock and orders better with Zoho Inventory.',
                'heroSummary' => 'We configure Zoho Inventory for item management, order workflows, and warehouse level visibility.',
                'summaryTitle' => 'Inventory operations made easier',
                'summaryBody' => [
                    'We structure items, warehouses, reorder rules, and order states.',
                    'Your team can track stock movement and fulfillment with less manual effort.',
                ],
                'capabilities' => [
                    ['title' => 'Item and warehouse setup', 'copy' => 'Master data, stock units, and location structures.'],
                    ['title' => 'Order processing flow', 'copy' => 'Sales order to shipment tracking with status controls.'],
                    ['title' => 'Reorder and stock alerts', 'copy' => 'Automate low stock notifications and planning.'],
                    ['title' => 'Operations reports', 'copy' => 'Stock aging, movement, and fulfillment performance views.'],
                ],
                'useCases' => [
                    ['title' => 'Stock visibility is weak', 'copy' => 'Get live view across warehouses and items.'],
                    ['title' => 'Order dispatch delays', 'copy' => 'Use structured order and shipment flows.'],
                    ['title' => 'Manual stock updates', 'copy' => 'Track movement through system transactions.'],
                    ['title' => 'Frequent stockouts', 'copy' => 'Set reorder rules and alerts.'],
                ],
                'faqs' => [
                    ['q' => 'Can Inventory connect with Zoho Books?', 'a' => 'Yes. We can connect inventory and finance workflows.'],
                    ['q' => 'Can we manage multiple warehouses?', 'a' => 'Yes. We support multi location setup.'],
                    ['q' => 'Do you support post launch tuning?', 'a' => 'Yes. We help tune reports and flows over time.'],
                ],
                'related' => ['books', 'crm', 'analytics', 'zoho-one'],
                'seoDescription' => 'Tekvista Zoho Inventory services for stock setup, order management, and warehouse visibility.',
                'seoKeywords' => 'zoho inventory implementation, zoho inventory partner, zoho stock management services',
            ],
            'analytics' => [
                'name' => 'Zoho Analytics',
                'logo' => asset('images/tekvista/logos/zoho/analytics.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Business dashboards and reports from your Zoho and external data.',
                'heroTitle' => 'Make better decisions with clear Zoho Analytics dashboards.',
                'heroSummary' => 'We build reporting layers in Zoho Analytics so leadership and teams can track the right numbers.',
                'summaryTitle' => 'Reporting that people can actually use',
                'summaryBody' => [
                    'We connect data sources and create trusted dashboards by business function.',
                    'Reports are designed for fast review, not technical complexity.',
                ],
                'capabilities' => [
                    ['title' => 'Data source integration', 'copy' => 'Combine Zoho apps and selected external systems.'],
                    ['title' => 'Dashboard design', 'copy' => 'Simple KPI views for leadership and operations.'],
                    ['title' => 'Scheduled reporting', 'copy' => 'Automate report delivery to key stakeholders.'],
                    ['title' => 'Data model support', 'copy' => 'Improve consistency across tables and metrics.'],
                ],
                'useCases' => [
                    ['title' => 'Reports are manual and slow', 'copy' => 'Automate core reports with trusted data.'],
                    ['title' => 'Different teams see different numbers', 'copy' => 'Create one shared KPI definition layer.'],
                    ['title' => 'Leaders need faster visibility', 'copy' => 'Build role based dashboards with drill downs.'],
                    ['title' => 'Data is spread in many apps', 'copy' => 'Bring it together in one reporting space.'],
                ],
                'faqs' => [
                    ['q' => 'Can Analytics connect to non Zoho tools?', 'a' => 'Yes. We can use supported connectors and imports.'],
                    ['q' => 'Can we get department wise dashboards?', 'a' => 'Yes. We design dashboards by team and role.'],
                    ['q' => 'Do you help with metric definitions?', 'a' => 'Yes. We define clear KPI logic with your teams.'],
                ],
                'related' => ['crm', 'books', 'inventory', 'projects'],
                'seoDescription' => 'Tekvista Zoho Analytics services for dashboard setup, KPI reporting, and data integration.',
                'seoKeywords' => 'zoho analytics implementation, zoho dashboard services, zoho bi consulting',
            ],
            'recruit' => [
                'name' => 'Zoho Recruit',
                'logo' => asset('images/tekvista/logos/zoho/recruit.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Hiring workflow for sourcing, screening, and candidate communication.',
                'heroTitle' => 'Speed up hiring with Zoho Recruit workflows.',
                'heroSummary' => 'We set up Zoho Recruit for job openings, candidate tracking, and hiring team collaboration.',
                'summaryTitle' => 'Simple hiring process digitization',
                'summaryBody' => [
                    'We structure candidate stages and ownership across recruiters and managers.',
                    'Your team can track hiring progress and response times clearly.',
                ],
                'capabilities' => [
                    ['title' => 'Candidate pipeline setup', 'copy' => 'Stages, owners, and score rules for each opening.'],
                    ['title' => 'Job and form templates', 'copy' => 'Standard templates for consistent hiring flow.'],
                    ['title' => 'Communication tracking', 'copy' => 'Manage candidate emails and status updates centrally.'],
                    ['title' => 'Hiring reports', 'copy' => 'Source quality, closure time, and conversion metrics.'],
                ],
                'useCases' => [
                    ['title' => 'Hiring steps are unclear', 'copy' => 'Create one clear process for all openings.'],
                    ['title' => 'Candidate updates get missed', 'copy' => 'Use status alerts and stage reminders.'],
                    ['title' => 'Manager feedback is delayed', 'copy' => 'Set clear handoffs and ownership.'],
                    ['title' => 'Recruitment metrics are missing', 'copy' => 'Track quality and speed in dashboards.'],
                ],
                'faqs' => [
                    ['q' => 'Can Recruit work with Zoho People?', 'a' => 'Yes. We can connect hiring to employee onboarding flow.'],
                    ['q' => 'Can multiple hiring teams use one setup?', 'a' => 'Yes. We can set role based team structures.'],
                    ['q' => 'Do you help with training recruiters?', 'a' => 'Yes. We run user training and admin enablement.'],
                ],
                'related' => ['people', 'crm', 'cliq', 'analytics'],
                'seoDescription' => 'Tekvista Zoho Recruit services for hiring workflow setup, candidate tracking, and reporting.',
                'seoKeywords' => 'zoho recruit implementation, zoho recruitment services, zoho recruit partner',
            ],
            'sign' => [
                'name' => 'Zoho Sign',
                'logo' => asset('images/tekvista/logos/zoho/sign.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Digital signatures for contracts, approvals, and faster document closure.',
                'heroTitle' => 'Close approvals faster with Zoho Sign.',
                'heroSummary' => 'We set up Zoho Sign for secure digital signing workflows across sales, HR, legal, and operations.',
                'summaryTitle' => 'Digital signing that fits daily operations',
                'summaryBody' => [
                    'We design template based signature workflows with tracking and reminders.',
                    'Your team can reduce document delays and manual follow up effort.',
                ],
                'capabilities' => [
                    ['title' => 'Template setup', 'copy' => 'Create reusable signing templates for common documents.'],
                    ['title' => 'Signing workflows', 'copy' => 'Define signer sequence and approval order.'],
                    ['title' => 'Reminders and tracking', 'copy' => 'Auto reminders and real time document status.'],
                    ['title' => 'App integrations', 'copy' => 'Connect signatures with CRM and process workflows.'],
                ],
                'useCases' => [
                    ['title' => 'Paper based approvals are slow', 'copy' => 'Move to fast digital signature workflows.'],
                    ['title' => 'Document status is unclear', 'copy' => 'Track who signed and what is pending.'],
                    ['title' => 'Multiple teams need signature flows', 'copy' => 'Standardize templates across departments.'],
                    ['title' => 'Contract closure delays', 'copy' => 'Reduce turnaround time with reminders.'],
                ],
                'faqs' => [
                    ['q' => 'Can we use custom signing templates?', 'a' => 'Yes. We create templates for your document types.'],
                    ['q' => 'Can Sign connect with Zoho CRM?', 'a' => 'Yes. We can integrate signing with sales workflows.'],
                    ['q' => 'Can we track pending documents easily?', 'a' => 'Yes. Status tracking is part of the setup.'],
                ],
                'related' => ['crm', 'books', 'flow', 'campaigns'],
                'seoDescription' => 'Tekvista Zoho Sign services for digital signature setup, templates, and approval workflows.',
                'seoKeywords' => 'zoho sign implementation, digital signature zoho, zoho sign partner',
            ],
            'cliq' => [
                'name' => 'Zoho Cliq',
                'logo' => asset('images/tekvista/logos/zoho/cliq.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Team chat and quick collaboration for faster internal communication.',
                'heroTitle' => 'Improve team communication with Zoho Cliq.',
                'heroSummary' => 'We set up Zoho Cliq channels, team structure, and app connections so communication stays organized.',
                'summaryTitle' => 'Team messaging with better structure',
                'summaryBody' => [
                    'We help define channel naming, ownership, and usage guidelines.',
                    'Cliq can connect with other Zoho apps for instant alerts and updates.',
                ],
                'capabilities' => [
                    ['title' => 'Channel architecture', 'copy' => 'Create clear spaces by team, project, or function.'],
                    ['title' => 'Alert integrations', 'copy' => 'Push workflow alerts from CRM, Desk, and other apps.'],
                    ['title' => 'User and policy setup', 'copy' => 'Define member roles, retention, and access controls.'],
                    ['title' => 'Adoption guidelines', 'copy' => 'Set simple communication best practices for teams.'],
                ],
                'useCases' => [
                    ['title' => 'Team communication is scattered', 'copy' => 'Use one structured messaging platform.'],
                    ['title' => 'Too many email chains', 'copy' => 'Shift quick collaboration to organized channels.'],
                    ['title' => 'Need real time business alerts', 'copy' => 'Send important updates directly to channels.'],
                    ['title' => 'Remote team coordination', 'copy' => 'Improve response and coordination across locations.'],
                ],
                'faqs' => [
                    ['q' => 'Can Cliq integrate with other Zoho apps?', 'a' => 'Yes. We can configure role based alerts and updates.'],
                    ['q' => 'Can channels be set by department?', 'a' => 'Yes. We can structure by team and function.'],
                    ['q' => 'Do you help with rollout guidelines?', 'a' => 'Yes. We provide practical usage and governance guidance.'],
                ],
                'related' => ['workplace', 'people', 'projects', 'flow'],
                'seoDescription' => 'Tekvista Zoho Cliq services for collaboration setup, channels, and app notifications.',
                'seoKeywords' => 'zoho cliq setup, zoho collaboration services, zoho cliq partner',
            ],
            'bigin' => [
                'name' => 'Bigin by Zoho CRM',
                'logo' => asset('images/tekvista/logos/zoho/bigin.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1552581234-26160f608093?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Simple CRM for small and growing sales teams.',
                'heroTitle' => 'Start sales tracking quickly with Bigin by Zoho CRM.',
                'heroSummary' => 'We set up Bigin for teams that need a simple CRM with pipeline tracking, follow ups, and visibility without heavy complexity.',
                'summaryTitle' => 'Lightweight CRM setup that teams can use fast',
                'summaryBody' => [
                    'We configure Bigin pipeline stages, fields, and reminders around your sales process.',
                    'Your team gets a quick CRM launch with clean tracking and easy adoption.',
                ],
                'capabilities' => [
                    ['title' => 'Pipeline setup', 'copy' => 'Simple stages with clear ownership and next actions.'],
                    ['title' => 'Contact and company tracking', 'copy' => 'Centralized customer records for day to day work.'],
                    ['title' => 'Task and follow up reminders', 'copy' => 'Automate reminders to reduce missed follow ups.'],
                    ['title' => 'Basic sales dashboards', 'copy' => 'Quick visibility into pipeline and closures.'],
                ],
                'useCases' => [
                    ['title' => 'Sales team is using spreadsheets', 'copy' => 'Move to a simple CRM without long rollout time.'],
                    ['title' => 'Need basic pipeline discipline', 'copy' => 'Track leads and deals in one clear view.'],
                    ['title' => 'Follow ups are getting missed', 'copy' => 'Set owner wise task and reminder workflows.'],
                    ['title' => 'Business wants quick CRM start', 'copy' => 'Launch in days with practical configuration.'],
                ],
                'faqs' => [
                    ['q' => 'Can Bigin be upgraded to Zoho CRM later?', 'a' => 'Yes. We can plan a phased path as your needs grow.'],
                    ['q' => 'Can we migrate existing contacts?', 'a' => 'Yes. We support migration and validation.'],
                    ['q' => 'Will users get onboarding help?', 'a' => 'Yes. We provide role based user onboarding.'],
                ],
                'related' => ['crm', 'campaigns', 'sign', 'mail'],
                'seoDescription' => 'Tekvista Bigin by Zoho CRM services for quick CRM setup, pipeline tracking, and adoption.',
                'seoKeywords' => 'bigin zoho setup, bigin crm implementation, bigin by zoho partner',
            ],
            'mail' => [
                'name' => 'Zoho Mail',
                'logo' => asset('images/tekvista/logos/zoho/mail.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Business email setup, migration, and policy controls for secure communication.',
                'heroTitle' => 'Set up reliable business email with Zoho Mail.',
                'heroSummary' => 'We migrate mailboxes, configure domains, and apply security policies for day to day email operations.',
                'summaryTitle' => 'Email migration with fewer surprises',
                'summaryBody' => [
                    'We plan migration batches to reduce business disruption.',
                    'Your IT team gets DNS guidance, policy setup, and admin handover.',
                ],
                'capabilities' => [
                    ['title' => 'Domain and DNS setup', 'copy' => 'SPF, DKIM, MX, and mailbox policy configuration.'],
                    ['title' => 'Mailbox migration', 'copy' => 'Move users and messages with validation checks.'],
                    ['title' => 'Security controls', 'copy' => 'Access policy, spam protection, and account safety rules.'],
                    ['title' => 'Admin support', 'copy' => 'Role setup and post migration monitoring support.'],
                ],
                'useCases' => [
                    ['title' => 'Current mail platform is costly', 'copy' => 'Move to Zoho Mail with practical planning.'],
                    ['title' => 'Need better domain controls', 'copy' => 'Apply proper DNS and authentication policies.'],
                    ['title' => 'User migration fear', 'copy' => 'Use phased migration with validation.'],
                    ['title' => 'Need managed support after migration', 'copy' => 'Get ongoing admin and issue support options.'],
                ],
                'faqs' => [
                    ['q' => 'Can you migrate from Google Workspace or M365?', 'a' => 'Yes. We support both migration paths.'],
                    ['q' => 'Do you configure SPF and DKIM?', 'a' => 'Yes. DNS security setup is included.'],
                    ['q' => 'Do you support users after go live?', 'a' => 'Yes. We provide post migration support plans.'],
                ],
                'related' => ['workplace', 'campaigns', 'sign', 'cliq'],
                'seoDescription' => 'Tekvista Zoho Mail services for migration, DNS setup, security policy, and admin support.',
                'seoKeywords' => 'zoho mail migration, zoho mail setup partner, zoho email services',
            ],
            'campaigns' => [
                'name' => 'Zoho Campaigns',
                'logo' => asset('images/tekvista/logos/zoho/campaigns.svg'),
                'heroImage' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1600&q=80',
                'cardSummary' => 'Email marketing journeys, list management, and campaign performance tracking.',
                'heroTitle' => 'Run better email marketing with Zoho Campaigns.',
                'heroSummary' => 'We set up Zoho Campaigns for list hygiene, campaign journeys, and clear performance reporting.',
                'summaryTitle' => 'Marketing campaigns with clear execution',
                'summaryBody' => [
                    'We organize audience lists and campaign templates for consistent execution.',
                    'Your team gets better visibility into opens, clicks, and conversions.',
                ],
                'capabilities' => [
                    ['title' => 'Audience and list setup', 'copy' => 'Segment contacts and clean list quality.'],
                    ['title' => 'Campaign journey setup', 'copy' => 'Build scheduled emails and drip workflows.'],
                    ['title' => 'Template and approval flow', 'copy' => 'Create reusable campaign templates with review steps.'],
                    ['title' => 'Performance dashboards', 'copy' => 'Track delivery, engagement, and conversion.'],
                ],
                'useCases' => [
                    ['title' => 'Campaign execution is inconsistent', 'copy' => 'Use reusable templates and workflows.'],
                    ['title' => 'List quality is poor', 'copy' => 'Set list rules and periodic cleanup.'],
                    ['title' => 'No clear campaign reporting', 'copy' => 'Track outcomes with role based dashboards.'],
                    ['title' => 'Need CRM linked marketing', 'copy' => 'Connect campaigns with Zoho CRM data.'],
                ],
                'faqs' => [
                    ['q' => 'Can Campaigns integrate with Zoho CRM?', 'a' => 'Yes. We can sync and segment CRM contacts.'],
                    ['q' => 'Can you set campaign journeys?', 'a' => 'Yes. We create basic and advanced drip flows.'],
                    ['q' => 'Can we track conversions?', 'a' => 'Yes. We configure meaningful campaign metrics.'],
                ],
                'related' => ['crm', 'mail', 'analytics', 'sign'],
                'seoDescription' => 'Tekvista Zoho Campaigns services for email marketing setup, automation, and performance tracking.',
                'seoKeywords' => 'zoho campaigns setup, zoho email marketing services, zoho campaigns partner',
            ],
        ];

        return collect($services)->mapWithKeys(function (array $service, string $slug) use ($defaultPhases, $defaultGovernance): array {
            $name = $service['name'];

            return [
                $slug => [
                    'slug' => $slug,
                    'name' => $name,
                    'logo' => $service['logo'],
                    'logoAlt' => $name.' color logo',
                    'heroImage' => $service['heroImage'] ?? null,
                    'cardSummary' => $service['cardSummary'],
                    'heroKicker' => $name.' Services',
                    'heroTitle' => $service['heroTitle'],
                    'heroSummary' => $service['heroSummary'],
                    'primaryIntent' => 'Talk about '.$name,
                    'summaryTitle' => $service['summaryTitle'],
                    'summaryBody' => $service['summaryBody'],
                    'capabilities' => $service['capabilities'],
                    'useCases' => $service['useCases'],
                    'deliveryPhases' => $service['deliveryPhases'] ?? $defaultPhases,
                    'governance' => $service['governance'] ?? $defaultGovernance,
                    'faqs' => $service['faqs'],
                    'related' => $service['related'],
                    'seoTitle' => $name.' Services | Tekvista',
                    'seoDescription' => $service['seoDescription'],
                    'seoKeywords' => $service['seoKeywords'],
                ],
            ];
        })->all();
    }

    private function odooServicePages(): array
    {
        $defaultPhases = [
            ['title' => '1. Scope and process mapping', 'copy' => 'We map your current process and target Odoo module setup.'],
            ['title' => '2. Configure and customize', 'copy' => 'We configure modules, access, and required business logic.'],
            ['title' => '3. Data migration and testing', 'copy' => 'We migrate records and test with your real scenarios.'],
            ['title' => '4. Go live and stabilize', 'copy' => 'We support teams during launch and optimization.'],
        ];

        $defaultGovernance = [
            'Role based access for every business function.',
            'Approval flows for key financial and operational actions.',
            'Release testing before production updates.',
            'Simple support workflow for post launch issues.',
        ];

        $services = [
            'crm' => [
                'name' => 'Odoo CRM',
                'logo' => asset('images/tekvista/logos/odoo/crm.png'),
                'cardSummary' => 'Lead and opportunity tracking with clean sales stages.',
                'heroTitle' => 'Manage leads and deals with Odoo CRM.',
                'heroSummary' => 'Tekvista sets up Odoo CRM so your sales process becomes easier to track and improve.',
                'summaryTitle' => 'Odoo CRM in plain and practical setup',
                'summaryBody' => [
                    'We define lead stages, ownership, and next actions clearly.',
                    'Sales leaders get better visibility into team activity and pipeline health.',
                ],
                'capabilities' => [
                    ['title' => 'Pipeline structure', 'copy' => 'Stage design and ownership rules for opportunities.'],
                    ['title' => 'Lead qualification flow', 'copy' => 'Route and prioritize leads by business fit.'],
                    ['title' => 'Sales activity tracking', 'copy' => 'Calls, meetings, and follow up reminders.'],
                    ['title' => 'Dashboard reporting', 'copy' => 'Simple pipeline and closure views for managers.'],
                ],
                'useCases' => [
                    ['title' => 'Leads are not followed on time', 'copy' => 'Set reminders and clear ownership.'],
                    ['title' => 'Pipeline visibility is low', 'copy' => 'Track opportunities in one dashboard.'],
                    ['title' => 'Sales data is spread out', 'copy' => 'Centralize records and communication.'],
                    ['title' => 'Forecasting is weak', 'copy' => 'Use consistent stage based pipeline data.'],
                ],
                'faqs' => [
                    ['q' => 'Can Odoo CRM integrate with Sales and Invoicing?', 'a' => 'Yes. We can connect end to end flow.'],
                    ['q' => 'Can we migrate old CRM data?', 'a' => 'Yes. We handle mapping and validation.'],
                    ['q' => 'Will team training be included?', 'a' => 'Yes. We provide user and admin training.'],
                ],
                'related' => ['sales', 'accounting', 'projects'],
                'seoDescription' => 'Tekvista Odoo CRM services for pipeline setup, lead management, and reporting.',
                'seoKeywords' => 'odoo crm implementation, odoo crm services, odoo crm partner india',
            ],
            'sales' => [
                'name' => 'Odoo Sales',
                'logo' => asset('images/tekvista/logos/odoo/sales.png'),
                'cardSummary' => 'Quotation to order workflow with approvals and pricing control.',
                'heroTitle' => 'Streamline your quote to order process with Odoo Sales.',
                'heroSummary' => 'We configure Odoo Sales to make quotation, order, and approval steps easier for your team.',
                'summaryTitle' => 'Simple and controlled sales operations',
                'summaryBody' => [
                    'We set up products, price lists, and quotation templates.',
                    'Your team can convert approved quotes into orders quickly.',
                ],
                'capabilities' => [
                    ['title' => 'Quotation templates', 'copy' => 'Standard quote formats for faster response.'],
                    ['title' => 'Pricing and discount controls', 'copy' => 'Define rules and approval checks.'],
                    ['title' => 'Order flow automation', 'copy' => 'Move from quote to order with less manual work.'],
                    ['title' => 'Sales performance reporting', 'copy' => 'Track order value and conversion trends.'],
                ],
                'useCases' => [
                    ['title' => 'Quote process is inconsistent', 'copy' => 'Use templates and rules for consistency.'],
                    ['title' => 'Approvals are delayed', 'copy' => 'Set clear approval flow for exceptions.'],
                    ['title' => 'Order handoff is manual', 'copy' => 'Automate handoff to inventory and accounting.'],
                    ['title' => 'Need better sales tracking', 'copy' => 'Build usable reports for sales managers.'],
                ],
                'faqs' => [
                    ['q' => 'Can Sales link with Inventory?', 'a' => 'Yes. We connect quote to delivery workflows.'],
                    ['q' => 'Can we control discounts?', 'a' => 'Yes. Approval rules can be set by role.'],
                    ['q' => 'Do you set custom sales reports?', 'a' => 'Yes. We build simple role based dashboards.'],
                ],
                'related' => ['crm', 'inventory', 'accounting'],
                'seoDescription' => 'Tekvista Odoo Sales services for quotation, pricing control, order flow, and reporting.',
                'seoKeywords' => 'odoo sales setup, odoo sales module services, odoo implementation partner',
            ],
            'accounting' => [
                'name' => 'Odoo Accounting',
                'logo' => asset('images/tekvista/logos/odoo/accounting.png'),
                'cardSummary' => 'Accounting workflows for invoices, payments, and monthly close.',
                'heroTitle' => 'Simplify accounting operations with Odoo Accounting.',
                'heroSummary' => 'We configure Odoo Accounting for clean finance processes and easier monthly reporting.',
                'summaryTitle' => 'Finance process setup for daily clarity',
                'summaryBody' => [
                    'We set up chart of accounts, taxes, journals, and approval controls.',
                    'Finance teams get clear receivable, payable, and closure views.',
                ],
                'capabilities' => [
                    ['title' => 'Accounting foundation', 'copy' => 'Chart, journal, tax, and fiscal settings.'],
                    ['title' => 'Invoice and payment workflows', 'copy' => 'Receivable and payable process automation.'],
                    ['title' => 'Reconciliation support', 'copy' => 'Simplified matching and review workflows.'],
                    ['title' => 'Finance reports', 'copy' => 'Profitability, cash flow, and balance insights.'],
                ],
                'useCases' => [
                    ['title' => 'Manual accounting work is heavy', 'copy' => 'Automate repeat finance steps.'],
                    ['title' => 'Approval controls are weak', 'copy' => 'Define role based checks and flow.'],
                    ['title' => 'Collections need discipline', 'copy' => 'Track dues and reminders in system.'],
                    ['title' => 'Close process takes too long', 'copy' => 'Use structured month end reporting.'],
                ],
                'faqs' => [
                    ['q' => 'Can Accounting connect with Sales and Purchase?', 'a' => 'Yes. We configure connected workflows.'],
                    ['q' => 'Can we migrate opening balances?', 'a' => 'Yes. We support migration and checks.'],
                    ['q' => 'Do you help during month end after go live?', 'a' => 'Yes. Stabilization support is available.'],
                ],
                'related' => ['sales', 'purchase', 'inventory'],
                'seoDescription' => 'Tekvista Odoo Accounting services for finance configuration, invoicing, and reporting.',
                'seoKeywords' => 'odoo accounting implementation, odoo finance services, odoo accounting partner',
            ],
            'inventory' => [
                'name' => 'Odoo Inventory',
                'logo' => asset('images/tekvista/logos/odoo/inventory.png'),
                'cardSummary' => 'Inventory control across items, locations, and stock movement.',
                'heroTitle' => 'Manage stock movement better with Odoo Inventory.',
                'heroSummary' => 'We set up Odoo Inventory for item tracking, warehouse operations, and order fulfillment visibility.',
                'summaryTitle' => 'Warehouse flow with clear tracking',
                'summaryBody' => [
                    'We define item masters, locations, and stock rules.',
                    'Operations teams get visibility into inward, outward, and available stock.',
                ],
                'capabilities' => [
                    ['title' => 'Stock master setup', 'copy' => 'Item units, categories, and warehouse structures.'],
                    ['title' => 'Inbound and outbound flow', 'copy' => 'Control purchase receipts and delivery processing.'],
                    ['title' => 'Reorder rules', 'copy' => 'Set min max levels and replenishment alerts.'],
                    ['title' => 'Stock reporting', 'copy' => 'Aging, movement, and availability views.'],
                ],
                'useCases' => [
                    ['title' => 'Stockouts happen frequently', 'copy' => 'Use reorder rules and alerts.'],
                    ['title' => 'Warehouse visibility is low', 'copy' => 'Track stock by location and status.'],
                    ['title' => 'Dispatch process is delayed', 'copy' => 'Use clear pick and delivery workflows.'],
                    ['title' => 'Manual stock updates cause errors', 'copy' => 'Track every movement inside Odoo.'],
                ],
                'faqs' => [
                    ['q' => 'Can Inventory connect with Sales and Purchase?', 'a' => 'Yes. End to end setup is supported.'],
                    ['q' => 'Can we handle multiple locations?', 'a' => 'Yes. Multi warehouse setup is available.'],
                    ['q' => 'Do you support barcode use cases?', 'a' => 'Yes. We can plan barcode based operations.'],
                ],
                'related' => ['sales', 'purchase', 'manufacturing'],
                'seoDescription' => 'Tekvista Odoo Inventory services for stock setup, warehouse workflows, and reporting.',
                'seoKeywords' => 'odoo inventory implementation, odoo warehouse setup, odoo stock services',
            ],
            'manufacturing' => [
                'name' => 'Odoo Manufacturing',
                'logo' => asset('images/tekvista/logos/odoo/manufacturing.png'),
                'cardSummary' => 'Production planning, BOM setup, and manufacturing order control.',
                'heroTitle' => 'Run production flow better with Odoo Manufacturing.',
                'heroSummary' => 'We configure Odoo Manufacturing for BOM management, work orders, and production visibility.',
                'summaryTitle' => 'Production process in a clear system',
                'summaryBody' => [
                    'We set up products, BOMs, and manufacturing steps.',
                    'Operations teams can track production status and material usage.'],
                'capabilities' => [
                    ['title' => 'BOM setup', 'copy' => 'Define components and production structure.'],
                    ['title' => 'Work order flow', 'copy' => 'Track each production step and responsibility.'],
                    ['title' => 'Material planning', 'copy' => 'Link production needs with stock availability.'],
                    ['title' => 'Production reporting', 'copy' => 'Monitor output, delays, and process efficiency.'],
                ],
                'useCases' => [
                    ['title' => 'Production status is hard to track', 'copy' => 'Use work order stage visibility.'],
                    ['title' => 'Material shortages stop production', 'copy' => 'Improve planning with inventory linkage.'],
                    ['title' => 'BOM updates are inconsistent', 'copy' => 'Use controlled revision handling.'],
                    ['title' => 'Need better output reports', 'copy' => 'Track planned versus actual production.'],
                ],
                'faqs' => [
                    ['q' => 'Can manufacturing connect with inventory?', 'a' => 'Yes. Material flow is linked in setup.'],
                    ['q' => 'Can we manage multiple BOM versions?', 'a' => 'Yes. Controlled BOM handling is possible.'],
                    ['q' => 'Do you support go live for plant teams?', 'a' => 'Yes. We provide floor level rollout support.'],
                ],
                'related' => ['inventory', 'purchase', 'maintenance'],
                'seoDescription' => 'Tekvista Odoo Manufacturing services for BOM setup, work order management, and production tracking.',
                'seoKeywords' => 'odoo manufacturing implementation, odoo mrp services, odoo production setup',
            ],
            'projects' => [
                'name' => 'Odoo Projects',
                'logo' => asset('images/tekvista/logos/odoo/projects.png'),
                'cardSummary' => 'Project tasks, timelines, and delivery tracking in one workspace.',
                'heroTitle' => 'Track project execution clearly with Odoo Projects.',
                'heroSummary' => 'We set up Odoo Projects for planning, task ownership, and delivery progress tracking.',
                'summaryTitle' => 'Project management without complexity',
                'summaryBody' => [
                    'We define project templates, milestones, and team ownership.',
                    'Managers get fast status visibility for better review meetings.',
                ],
                'capabilities' => [
                    ['title' => 'Project template setup', 'copy' => 'Reusable structures for repeat project types.'],
                    ['title' => 'Task ownership flow', 'copy' => 'Assign work with deadlines and dependencies.'],
                    ['title' => 'Time and progress tracking', 'copy' => 'Track effort and completion by stage.'],
                    ['title' => 'Project reports', 'copy' => 'Simple dashboards for delays and milestones.'],
                ],
                'useCases' => [
                    ['title' => 'No clear task ownership', 'copy' => 'Define roles and due dates in one system.'],
                    ['title' => 'Status updates are manual', 'copy' => 'Use dashboards for live project updates.'],
                    ['title' => 'Project files are spread out', 'copy' => 'Keep records inside each project.'],
                    ['title' => 'Delivery tracking is weak', 'copy' => 'Track milestone and task completion clearly.'],
                ],
                'faqs' => [
                    ['q' => 'Can projects link with sales orders?', 'a' => 'Yes. We can connect sales and delivery flow.'],
                    ['q' => 'Can each team have custom boards?', 'a' => 'Yes. We can configure team wise views.'],
                    ['q' => 'Can we track billable effort?', 'a' => 'Yes. We can configure time tracking workflows.'],
                ],
                'related' => ['crm', 'sales', 'hr'],
                'seoDescription' => 'Tekvista Odoo Projects services for project planning, task tracking, and delivery reporting.',
                'seoKeywords' => 'odoo project implementation, odoo project module setup, odoo project services',
            ],
            'purchase' => [
                'name' => 'Odoo Purchase',
                'logo' => asset('images/tekvista/logos/odoo/purchase.png'),
                'cardSummary' => 'Purchase requests, vendor orders, and approval control.',
                'heroTitle' => 'Improve procurement flow with Odoo Purchase.',
                'heroSummary' => 'We configure Odoo Purchase for requisition, approvals, and vendor order tracking.',
                'summaryTitle' => 'Procurement with better process control',
                'summaryBody' => [
                    'We define approval hierarchy and purchase workflows.',
                    'Procurement teams get clear status from request to receipt.',
                ],
                'capabilities' => [
                    ['title' => 'Vendor master setup', 'copy' => 'Supplier records, terms, and category structure.'],
                    ['title' => 'Purchase approval rules', 'copy' => 'Role based limits and approval routing.'],
                    ['title' => 'PO workflow automation', 'copy' => 'Request, quote comparison, and order release.'],
                    ['title' => 'Procurement reporting', 'copy' => 'Track cycle time, spend, and pending approvals.'],
                ],
                'useCases' => [
                    ['title' => 'Approvals are delayed', 'copy' => 'Set clear approval sequence and alerts.'],
                    ['title' => 'PO tracking is weak', 'copy' => 'Monitor every stage in one dashboard.'],
                    ['title' => 'Vendor data is inconsistent', 'copy' => 'Clean and standardize supplier records.'],
                    ['title' => 'Spend visibility is low', 'copy' => 'Generate category wise procurement insights.'],
                ],
                'faqs' => [
                    ['q' => 'Can Purchase connect with Inventory and Accounting?', 'a' => 'Yes. Full process linkage can be configured.'],
                    ['q' => 'Can we set approval limits by role?', 'a' => 'Yes. Role based thresholds are supported.'],
                    ['q' => 'Can we track vendor performance?', 'a' => 'Yes. We can build vendor review reports.'],
                ],
                'related' => ['inventory', 'accounting', 'manufacturing'],
                'seoDescription' => 'Tekvista Odoo Purchase services for procurement setup, approvals, and vendor order tracking.',
                'seoKeywords' => 'odoo purchase implementation, odoo procurement services, odoo purchase module setup',
            ],
            'recruitment' => [
                'name' => 'Odoo Recruitment',
                'logo' => asset('images/tekvista/logos/odoo/recruitment.png'),
                'cardSummary' => 'Hiring process from job posting to offer workflow.',
                'heroTitle' => 'Organize hiring better with Odoo Recruitment.',
                'heroSummary' => 'We set up Odoo Recruitment for candidate stages, interview flow, and hiring visibility.',
                'summaryTitle' => 'Hiring process in one structured system',
                'summaryBody' => [
                    'We build role wise recruitment pipelines and candidate tracking.',
                    'HR teams get better control over interview and offer timelines.',
                ],
                'capabilities' => [
                    ['title' => 'Job and stage setup', 'copy' => 'Role specific hiring pipeline configuration.'],
                    ['title' => 'Interview workflow', 'copy' => 'Schedule, feedback, and status updates.'],
                    ['title' => 'Candidate communication', 'copy' => 'Track responses and follow ups in one place.'],
                    ['title' => 'Hiring reports', 'copy' => 'Source, closure time, and conversion tracking.'],
                ],
                'useCases' => [
                    ['title' => 'Hiring status is unclear', 'copy' => 'Use stage based candidate tracking.'],
                    ['title' => 'Interview coordination is hard', 'copy' => 'Centralize scheduling and feedback.'],
                    ['title' => 'Recruitment metrics are missing', 'copy' => 'Track outcomes in standard dashboards.'],
                    ['title' => 'Many teams are hiring at once', 'copy' => 'Use role and team wise pipelines.'],
                ],
                'faqs' => [
                    ['q' => 'Can this connect with Odoo HR?', 'a' => 'Yes. Recruitment to employee flow can be linked.'],
                    ['q' => 'Can each department have separate stages?', 'a' => 'Yes. Stage design can be role specific.'],
                    ['q' => 'Do you train HR users?', 'a' => 'Yes. We include onboarding for HR teams.'],
                ],
                'related' => ['hr', 'projects', 'crm'],
                'seoDescription' => 'Tekvista Odoo Recruitment services for hiring workflow setup, interview tracking, and reporting.',
                'seoKeywords' => 'odoo recruitment implementation, odoo hiring module services, odoo recruitment partner',
            ],
            'website-ecommerce' => [
                'name' => 'Odoo Website and eCommerce',
                'logo' => asset('images/tekvista/logos/odoo/website-ecommerce.png'),
                'cardSummary' => 'Website and online store setup connected with Odoo operations.',
                'heroTitle' => 'Launch connected online selling with Odoo Website and eCommerce.',
                'heroSummary' => 'We set up Odoo website and store flows linked with product, stock, and order operations.',
                'summaryTitle' => 'Online experience with backend connection',
                'summaryBody' => [
                    'We configure pages, product catalogs, cart, and checkout basics.',
                    'Your store workflows can connect with sales, inventory, and accounting.',
                ],
                'capabilities' => [
                    ['title' => 'Website structure setup', 'copy' => 'Core pages, menus, and content blocks.'],
                    ['title' => 'Product and store setup', 'copy' => 'Catalog, pricing, and order configuration.'],
                    ['title' => 'Checkout and payment flow', 'copy' => 'Configure order capture and payment basics.'],
                    ['title' => 'Store performance tracking', 'copy' => 'Basic analytics and conversion monitoring.'],
                ],
                'useCases' => [
                    ['title' => 'Need one platform for site and operations', 'copy' => 'Run store and backend from Odoo.'],
                    ['title' => 'Catalog updates are manual', 'copy' => 'Manage products from centralized records.'],
                    ['title' => 'Order processing is disconnected', 'copy' => 'Connect web orders with fulfillment flow.'],
                    ['title' => 'Need faster launch timeline', 'copy' => 'Use Odoo framework for quick rollout.'],
                ],
                'faqs' => [
                    ['q' => 'Can store orders sync with inventory?', 'a' => 'Yes. We configure connected order flow.'],
                    ['q' => 'Can we manage content ourselves later?', 'a' => 'Yes. We provide admin handover and training.'],
                    ['q' => 'Can you help with ongoing improvements?', 'a' => 'Yes. We support enhancement phases.'],
                ],
                'related' => ['sales', 'inventory', 'accounting'],
                'seoDescription' => 'Tekvista Odoo website and ecommerce services for store setup and connected business workflows.',
                'seoKeywords' => 'odoo ecommerce implementation, odoo website setup services, odoo online store partner',
            ],
            'pos' => [
                'name' => 'Odoo Point of Sale',
                'logo' => asset('images/tekvista/logos/odoo/pos.png'),
                'cardSummary' => 'Retail POS setup with billing, products, and store level tracking.',
                'heroTitle' => 'Run store billing smoothly with Odoo POS.',
                'heroSummary' => 'We configure Odoo POS for products, counters, billing, and daily sales visibility.',
                'summaryTitle' => 'Fast POS operations with better control',
                'summaryBody' => [
                    'We set up POS terminals, product catalogs, and pricing rules.',
                    'Retail teams get easier billing and store level reporting.',
                ],
                'capabilities' => [
                    ['title' => 'POS terminal setup', 'copy' => 'Configure counters, users, and billing profiles.'],
                    ['title' => 'Product and pricing rules', 'copy' => 'Manage items, variants, and tax flow.'],
                    ['title' => 'Sales sync setup', 'copy' => 'Sync POS sales with inventory and accounting.'],
                    ['title' => 'Store reports', 'copy' => 'Track daily sales and cashier performance.'],
                ],
                'useCases' => [
                    ['title' => 'Store billing is slow', 'copy' => 'Use optimized POS screens and flows.'],
                    ['title' => 'Stock mismatch after sales', 'copy' => 'Sync POS with inventory records.'],
                    ['title' => 'Multi store tracking is hard', 'copy' => 'Get location wise sales visibility.'],
                    ['title' => 'Need daily closure controls', 'copy' => 'Set shift and reconciliation workflows.'],
                ],
                'faqs' => [
                    ['q' => 'Can POS run across multiple stores?', 'a' => 'Yes. Multi store setup is supported.'],
                    ['q' => 'Can POS sales sync with accounting?', 'a' => 'Yes. We configure required integration flow.'],
                    ['q' => 'Do you support user training for counters?', 'a' => 'Yes. We provide practical POS onboarding.'],
                ],
                'related' => ['inventory', 'sales', 'accounting'],
                'seoDescription' => 'Tekvista Odoo POS services for retail billing setup, sales sync, and store tracking.',
                'seoKeywords' => 'odoo pos implementation, odoo retail pos services, odoo pos setup partner',
            ],
            'hr' => [
                'name' => 'Odoo HR',
                'logo' => asset('images/tekvista/logos/odoo/hr.png'),
                'cardSummary' => 'Employee records, leave, attendance, and HR process tracking.',
                'heroTitle' => 'Manage HR operations clearly with Odoo HR.',
                'heroSummary' => 'We set up Odoo HR so employee lifecycle and policy workflows are easier to manage.',
                'summaryTitle' => 'HR workflows in one practical platform',
                'summaryBody' => [
                    'We configure employee master data, leave policies, and approvals.',
                    'HR teams get cleaner records and easier manager coordination.',
                ],
                'capabilities' => [
                    ['title' => 'Employee master setup', 'copy' => 'Organize records and role structures.'],
                    ['title' => 'Leave and attendance flow', 'copy' => 'Policy setup with approval routing.'],
                    ['title' => 'Document and update workflows', 'copy' => 'Standardize key HR forms and actions.'],
                    ['title' => 'HR reporting', 'copy' => 'Track attendance and workforce trends.'],
                ],
                'useCases' => [
                    ['title' => 'HR data is inconsistent', 'copy' => 'Create one trusted employee record source.'],
                    ['title' => 'Leave approvals are manual', 'copy' => 'Automate requests and manager approvals.'],
                    ['title' => 'Manager visibility is low', 'copy' => 'Use role wise dashboards and reports.'],
                    ['title' => 'Growing workforce', 'copy' => 'Scale HR process with less manual effort.'],
                ],
                'faqs' => [
                    ['q' => 'Can Odoo HR link with Recruitment?', 'a' => 'Yes. Recruitment to HR handoff can be configured.'],
                    ['q' => 'Can policies be customized?', 'a' => 'Yes. We configure by role and business rules.'],
                    ['q' => 'Do you provide HR admin training?', 'a' => 'Yes. We include HR admin enablement sessions.'],
                ],
                'related' => ['recruitment', 'projects', 'maintenance'],
                'seoDescription' => 'Tekvista Odoo HR services for employee records, leave workflows, and HR reporting.',
                'seoKeywords' => 'odoo hr implementation, odoo hr module services, odoo hr partner',
            ],
            'maintenance' => [
                'name' => 'Odoo Maintenance',
                'logo' => asset('images/tekvista/logos/odoo/maintenance.png'),
                'cardSummary' => 'Asset and maintenance requests with planned service tracking.',
                'heroTitle' => 'Track equipment maintenance with Odoo Maintenance.',
                'heroSummary' => 'We set up Odoo Maintenance for preventive tasks, breakdown requests, and service records.',
                'summaryTitle' => 'Asset uptime with simple maintenance workflows',
                'summaryBody' => [
                    'We define assets, teams, and maintenance schedules.',
                    'Operations teams can track open requests and completion status clearly.',
                ],
                'capabilities' => [
                    ['title' => 'Asset register setup', 'copy' => 'Organize equipment and ownership details.'],
                    ['title' => 'Preventive maintenance plans', 'copy' => 'Schedule recurring checks and service tasks.'],
                    ['title' => 'Breakdown request flow', 'copy' => 'Track issues, assignments, and closure.'],
                    ['title' => 'Maintenance dashboards', 'copy' => 'View uptime, open tasks, and response trends.'],
                ],
                'useCases' => [
                    ['title' => 'Equipment issues are tracked in email', 'copy' => 'Move to ticket based maintenance flow.'],
                    ['title' => 'Preventive checks are missed', 'copy' => 'Set schedule reminders and ownership.'],
                    ['title' => 'No asset service history', 'copy' => 'Keep history inside each asset record.'],
                    ['title' => 'Need better uptime visibility', 'copy' => 'Track trends through simple dashboards.'],
                ],
                'faqs' => [
                    ['q' => 'Can we manage preventive and corrective tasks together?', 'a' => 'Yes. Both flows can be configured.'],
                    ['q' => 'Can maintenance link with inventory spares?', 'a' => 'Yes. We can connect parts with inventory.'],
                    ['q' => 'Do you support field team onboarding?', 'a' => 'Yes. We train users and supervisors by role.'],
                ],
                'related' => ['manufacturing', 'inventory', 'hr'],
                'seoDescription' => 'Tekvista Odoo Maintenance services for preventive maintenance setup and asset tracking.',
                'seoKeywords' => 'odoo maintenance implementation, odoo asset maintenance services, odoo maintenance module',
            ],
        ];

        return collect($services)->mapWithKeys(function (array $service, string $slug) use ($defaultPhases, $defaultGovernance): array {
            $name = $service['name'];

            return [
                $slug => [
                    'slug' => $slug,
                    'name' => $name,
                    'logo' => $service['logo'],
                    'logoAlt' => $name.' color icon',
                    'heroImage' => $service['heroImage'] ?? null,
                    'cardSummary' => $service['cardSummary'],
                    'heroKicker' => $name.' Services',
                    'heroTitle' => $service['heroTitle'],
                    'heroSummary' => $service['heroSummary'],
                    'primaryIntent' => 'Talk about '.$name,
                    'summaryTitle' => $service['summaryTitle'],
                    'summaryBody' => $service['summaryBody'],
                    'capabilities' => $service['capabilities'],
                    'useCases' => $service['useCases'],
                    'deliveryPhases' => $service['deliveryPhases'] ?? $defaultPhases,
                    'governance' => $service['governance'] ?? $defaultGovernance,
                    'faqs' => $service['faqs'],
                    'related' => $service['related'],
                    'seoTitle' => $name.' Services | Tekvista',
                    'seoDescription' => $service['seoDescription'],
                    'seoKeywords' => $service['seoKeywords'],
                ],
            ];
        })->all();
    }
    private function pageData(): array
    {
        $services = [
            ['name' => 'IT Consultancy', 'route' => 'it-consultancy', 'tagline' => 'Practical IT planning.', 'summary' => 'We help you choose the right technology and rollout plan for your business.'],
            ['name' => 'Cybersecurity', 'route' => 'cybersecurity', 'tagline' => 'Keep systems safe.', 'summary' => 'Protect users, devices, and data with layered security controls and monitoring.'],
            ['name' => 'Cloud Solutions', 'route' => 'cloud', 'tagline' => 'Cloud that scales with you.', 'summary' => 'Move workloads to cloud with better uptime, security, and cost control.'],
            ['name' => 'Networking Solutions', 'route' => 'networking', 'tagline' => 'Reliable network foundation.', 'summary' => 'Build stable and secure office, branch, and remote connectivity.'],
            ['name' => 'IT Support', 'route' => 'it-support', 'tagline' => 'Fast help for day to day IT.', 'summary' => 'Resolve incidents quickly and keep teams productive with managed IT support.'],
            ['name' => 'Software Solutions', 'route' => 'software-solutions', 'tagline' => 'Software built for your workflow.', 'summary' => 'Create custom business apps and integrations that solve real process gaps.'],
            ['name' => 'AV Solutions', 'route' => 'av-solutions', 'tagline' => 'Meeting and display systems that work.', 'summary' => 'Set up boardroom AV, video meetings, and digital signage with end to end support.'],
            ['name' => 'Zoho Solutions', 'route' => 'zoho', 'tagline' => 'Zoho setup and support partner.', 'summary' => 'Plan, implement, and support Zoho apps for sales, finance, HR, support, and operations.'],
            ['name' => 'Odoo Solutions', 'route' => 'odoo', 'tagline' => 'Odoo services for growing businesses.', 'summary' => 'Implement Odoo modules for CRM, sales, accounting, inventory, manufacturing, and more.'],
            ['name' => 'Mailing Solutions', 'route' => 'mailing', 'tagline' => 'Secure business email setup.', 'summary' => 'Deploy and manage Microsoft 365, Google Workspace, and Zoho Mail for your teams.'],
            ['name' => 'Email Security', 'route' => 'email-security', 'tagline' => 'Reduce email threats.', 'summary' => 'Block phishing and spam with better email filtering and domain protection.'],
            ['name' => 'Systems & Infra', 'route' => 'infrastructure', 'tagline' => 'Strong IT backbone.', 'summary' => 'Plan and support servers, storage, virtualization, and core infrastructure.'],
            ['name' => 'AI Integration', 'route' => 'ai-integration', 'tagline' => 'AI where it adds real value.', 'summary' => 'Use AI tools in practical workflows to save time and improve decisions.'],
        ];

        return [
            'visuals' => [
                'hero' => asset('images/tekvista/server-room.png'),
                'strategy' => 'https://images.pexels.com/photos/6913224/pexels-photo-6913224.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'workspace' => asset('images/tekvista/Hero_Image.png'),
                'engineering' => 'https://images.pexels.com/photos/3867849/pexels-photo-3867849.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'support' => 'https://images.pexels.com/photos/6774939/pexels-photo-6774939.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'ops' => 'https://images.pexels.com/photos/5990030/pexels-photo-5990030.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'about' => asset('images/tekvista/About.png'),
                'ai' => asset('images/tekvista/AI.png'),
                'csr' => asset('images/tekvista/CSR.png'),
                'infra' => asset('images/tekvista/Infrastructure.png'),
                'security' => asset('images/tekvista/Cybersecurity.png'),
                'emailSecurity' => asset('images/tekvista/Email-Security.png'),
                'network' => 'https://images.pexels.com/photos/442150/pexels-photo-442150.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'zoho' => 'https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'odoo' => 'https://images.pexels.com/photos/735911/pexels-photo-735911.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'mail' => asset('images/tekvista/Mailing-Solutions.png'),
                'av' => asset('images/tekvista/AV-Solutions.png'),
            ],
            'services' => $services,
            'zohoProductLinks' => collect($this->zohoServicePages())
                ->map(fn (array $service): array => ['slug' => $service['slug'], 'label' => $service['name'], 'logo' => $service['logo'] ?? null])
                ->values()
                ->all(),
            'odooProductLinks' => collect($this->odooServicePages())
                ->map(fn (array $service): array => ['slug' => $service['slug'], 'label' => $service['name'], 'logo' => $service['logo'] ?? null])
                ->values()
                ->all(),
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
            'legalPolicies' => collect($this->legalPolicies())
                ->map(fn (array $policy, string $slug) => ['slug' => $slug, 'title' => $policy['title']])
                ->values()
                ->all(),
            'csrPoints' => [
                'Tekvista supports school infrastructure initiatives at Shree BadriKedar Dhanuka Adarsh Vidya Mandir, Churu.',
                'CSR focus includes safe and modern classroom environments for long-term student outcomes.',
                'Projects emphasize quality education access, digital enablement, and community-first development.',
                'Our CSR model aligns sustainable business growth with practical social impact in education.',
            ],
            'avOems' => [
                ['name' => 'LG', 'logo' => asset('images/tekvista/logos/lg.svg'), 'service' => 'Commercial displays, video walls, and digital signage deployment.'],
                ['name' => 'Samsung', 'logo' => asset('images/tekvista/logos/samsung.svg'), 'service' => 'Professional signage, meeting room displays, and collaboration screens.'],
                ['name' => 'Sony', 'logo' => asset('images/tekvista/logos/sony.svg'), 'service' => 'Professional displays, projectors, and enterprise visual communication systems.'],
                ['name' => 'Epson', 'logo' => asset('images/tekvista/logos/epson.svg'), 'service' => 'Business and education projector rollout with lifecycle support.'],
                ['name' => 'Panasonic', 'logo' => asset('images/tekvista/logos/panasonic.svg'), 'service' => 'Display infrastructure and integrated AV installation services.'],
                ['name' => 'JBL', 'logo' => asset('images/tekvista/logos/jbl.svg'), 'service' => 'Conference room audio, PA, and speech-focused acoustic systems.'],
                ['name' => 'Bose', 'logo' => asset('images/tekvista/logos/bose.svg'), 'service' => 'Enterprise audio collaboration and meeting room sound optimization.'],
            ],
        ];
    }
}
