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

    private function pageData(): array
    {
        $services = [
            ['name' => 'IT Consultancy', 'route' => 'it-consultancy', 'tagline' => 'Strategic Technology Advisory.', 'summary' => 'Advisory for architecture, procurement, modernization roadmaps, and enterprise technology governance.'],
            ['name' => 'Cybersecurity', 'route' => 'cybersecurity', 'tagline' => 'Enterprise-Grade Security Architecture.', 'summary' => 'Protecting your digital assets with advanced endpoint security, zero-trust frameworks, and continuous threat monitoring.'],
            ['name' => 'Cloud Solutions', 'route' => 'cloud', 'tagline' => 'Resilient Cloud Architectures.', 'summary' => 'Scalable infrastructure designed for performance, rapid deployment, and optimized operational costs.'],
            ['name' => 'Networking Solutions', 'route' => 'networking', 'tagline' => 'High-Performance Connectivity.', 'summary' => 'Enterprise networking designs ensuring stable performance, observability, and controlled growth.'],
            ['name' => 'IT Support', 'route' => 'it-support', 'tagline' => 'Business-Continuity IT Operations.', 'summary' => 'SLA-aligned support operations, proactive monitoring, and issue resolution for critical workloads.'],
            ['name' => 'Software Solutions', 'route' => 'software-solutions', 'tagline' => 'Custom Application Engineering.', 'summary' => 'Business software, workflow tools, and integrations designed around operational requirements.'],
            ['name' => 'AV Solutions', 'route' => 'av-solutions', 'tagline' => 'Immersive Collaboration Experiences.', 'summary' => 'Boardroom AV, video conferencing, digital signage, and control systems integrated for enterprise communication.'],
            ['name' => 'Zoho Solutions', 'route' => 'zoho', 'tagline' => 'Streamlined Business Operations.', 'summary' => 'Comprehensive integration, customization, and support for the full suite of Zoho applications.'],
            ['name' => 'Odoo Solutions', 'route' => 'odoo', 'tagline' => 'Enterprise Resource Planning.', 'summary' => 'End-to-end implementation of Odoo ERP, centralizing finance, inventory, manufacturing, and sales into one platform.'],
            ['name' => 'Mailing Solutions', 'route' => 'mailing', 'tagline' => 'Secure Enterprise Communication.', 'summary' => 'Implementing and managing industry-leading mailing platforms, including Microsoft 365, Google Workspace, and Zoho Mail.'],
            ['name' => 'Email Security', 'route' => 'email-security', 'tagline' => 'Threat-Safe Mail Exchange.', 'summary' => 'Phishing defense, secure email gateway deployment, DMARC alignment, and continuous mailbox threat hardening.'],
            ['name' => 'Systems & Infra', 'route' => 'infrastructure', 'tagline' => 'Scalable backbone for modern teams', 'summary' => 'Servers, storage, virtualization, data-center planning, monitoring and resilient architecture for enterprise workloads.'],
            ['name' => 'AI Integration', 'route' => 'ai-integration', 'tagline' => 'Applied AI for Enterprise Teams.', 'summary' => 'Integrating AI-enabled workflows to improve productivity, decision support, and process automation.'],
        ];

        return [
            'visuals' => [
                'hero' => asset('images/tekvista/server-room.png'),
                'strategy' => 'https://images.pexels.com/photos/6913224/pexels-photo-6913224.jpeg?auto=compress&cs=tinysrgb&w=1400',
                'workspace' => asset('images/tekvista/Hero_Image.png'),
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
