@php
    $route = request()->route()?->getName();
    $waBase = 'https://wa.me/919051433313?text=';
    $ctaMap = [
        'cybersecurity' => ['title' => 'Need a Security Posture Review?', 'copy' => 'Get a targeted assessment for endpoint risk, access control, and incident response readiness.', 'intent' => 'Request Cybersecurity Assessment'],
        'cloud' => ['title' => 'Planning Enterprise Cloud and Tally Hosting?', 'copy' => 'Design migration waves, Tally cloud architecture, backup policy, and cost governance in one rollout.', 'intent' => 'Plan Cloud and Tally Hosting Rollout'],
        'networking' => ['title' => 'Upgrade Your Network Architecture', 'copy' => 'Design LAN/WAN and SD-WAN with visibility, security, and performance goals.', 'intent' => 'Get Networking Consultation'],
        'av-solutions' => ['title' => 'Design AV for Boardrooms and Campuses', 'copy' => 'Plan conferencing, signage, and control systems for productive collaboration spaces.', 'intent' => 'Discuss AV Solutions Project'],
        'zoho' => ['title' => 'Implement Zoho with Process Clarity', 'copy' => 'We align CRM, mail, and automation around your business workflow.', 'intent' => 'Discuss Zoho Implementation'],
        'odoo' => ['title' => 'Roll Out Odoo in Phases', 'copy' => 'Plan module-by-module implementation for lower risk and faster adoption.', 'intent' => 'Book Odoo Discovery Session'],
        'mailing' => ['title' => 'Secure Business Mail for Every Team', 'copy' => 'Set up Microsoft, Google, or Zoho mail with migration and policy controls.', 'intent' => 'Configure Enterprise Mailing Platform'],
        'blog.index' => ['title' => 'Need Help Applying These Insights?', 'copy' => 'Talk to our team and convert strategy into implementation milestones.', 'intent' => 'Book Strategy Consultation'],
        'blog.show' => ['title' => 'Want This Implemented in Your Organization?', 'copy' => 'Get a practical rollout plan based on your current systems and goals.', 'intent' => 'Discuss Implementation Plan'],
        'services' => ['title' => 'Build a Full Enterprise IT Roadmap', 'copy' => 'Combine security, cloud, networking, and business platforms into one scalable operating model.', 'intent' => 'Request Enterprise Roadmap'],
    ];

    $cta = $ctaMap[$route] ?? null;
@endphp

@if ($cta)
<section class="mx-auto mt-14 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Contextual Consultation</p>
        <h2 class="mt-2 text-3xl font-black text-[var(--text)]">{{ $cta['title'] }}</h2>
        <p class="mt-3 max-w-3xl text-sm leading-7 text-[var(--muted)]">{{ $cta['copy'] }}</p>
        <div class="mt-5 flex flex-wrap gap-3">
            <a href="{{ route('contact', ['intent' => $cta['intent']]) }}" class="btn-primary"><i class="bi bi-send-check-fill"></i>{{ $cta['intent'] }}</a>
            <a href="{{ $waBase . rawurlencode('Hello Tekvista Team, we want to discuss: '.$cta['intent'].'. Please reply in English.') }}" class="btn-secondary" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i>WhatsApp Team</a>
        </div>
    </div>
</section>
@endif
