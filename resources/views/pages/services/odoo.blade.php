@extends('layout')

@section('content')
<section class="service-hero">
    <img src="{{ $visuals['odoo'] }}" alt="Odoo ERP implementation" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(110deg,rgba(5,7,13,0.95),rgba(5,7,13,0.78),rgba(5,7,13,0.45))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">Odoo Solutions</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Odoo ERP that unifies finance, operations, and growth.</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">Module selection, implementation, customization, and integration services for enterprise-grade Odoo delivery.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-3">
    <article class="neo-card p-5"><h2 class="text-xl font-black">Core ERP Launch</h2><p class="mt-3 text-sm text-[var(--muted)]">Accounting, CRM, inventory, and procurement in controlled phases.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Custom Workflows</h2><p class="mt-3 text-sm text-[var(--muted)]">Business-specific module extensions and reporting experiences.</p></article>
    <article class="neo-card p-5"><h2 class="text-xl font-black">Integration Services</h2><p class="mt-3 text-sm text-[var(--muted)]">Odoo connected with mail, payment, and third-party business tools.</p></article>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <div class="logo-chip"><img src="{{ asset('images/tekvista/logos/odoo.svg') }}" alt="Odoo"></div>
    </div>
</section>
@endsection
