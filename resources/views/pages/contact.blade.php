@extends('layout')

@section('content')
@php
    $whatsAppContactUrl = 'https://wa.me/919051433313?text=' . rawurlencode('Hello Tekvista Team, we need enterprise IT consultation. Please reply in English.');
@endphp
<section class="relative isolate overflow-hidden">
    <img src="{{ $visuals['support'] }}" alt="India-based business technology team discussing support requirements" class="absolute inset-0 -z-20 h-full w-full object-cover">
    <div class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(5,7,13,0.84),rgba(5,7,13,0.6),rgba(5,7,13,0.24))]"></div>
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="section-kicker">IT intake console</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight text-white sm:text-6xl">Start with the fastest path: form, phone or WhatsApp</h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-[#d5edf6]">Share your requirement and Tekvista can route it into consulting, infrastructure, cybersecurity, cloud, software or support follow-up.</p>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 pb-6 sm:px-6 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-[0.8fr_1.2fr]">
        <aside class="light-panel p-6">
            <p class="section-kicker text-[#00796b]">Contact routes</p>
            <div class="mt-5 grid gap-4 text-sm leading-7 text-[#314556]">
                <p><span class="font-black text-[#07111f]">Address:</span> {{ $contact['address'] }}</p>
                <p><span class="font-black text-[#07111f]">Phone:</span> <a href="tel:+919432246063" class="font-bold text-[#007bd1]">{{ $contact['phone'] }}</a> / {{ $contact['landline'] }}</p>
                <p><span class="font-black text-[#07111f]">Email:</span> <a href="mailto:{{ $contact['email'] }}" class="font-bold text-[#007bd1]">{{ $contact['email'] }}</a></p>
            </div>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ $whatsAppContactUrl }}" target="_blank" rel="noopener" class="btn-primary">WhatsApp</a>
                <a href="tel:+919432246063" class="inline-flex items-center justify-center rounded-xl border border-[#0a8f99]/18 bg-white/70 px-4 py-3 text-sm font-black text-[#07111f]">Call Office</a>
            </div>
            <div class="mt-6 overflow-hidden rounded-xl border border-[#0a8f99]/18">
                <iframe title="Tekvista office map" src="{{ $contact['map'] }}" class="h-72 w-full" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </aside>

        <section class="neo-card p-6">
            <div class="flex items-center justify-between gap-4 border-b border-[var(--line)] pb-4">
                <div>
                    <p class="section-kicker">Request payload</p>
                    <h2 class="mt-2 text-2xl font-black text-[var(--text)]">Tell us what needs to work better</h2>
                </div>
                <span class="hidden rounded-full bg-[var(--accent)]/14 px-3 py-1 font-mono text-xs font-bold text-[var(--accent)] sm:inline-flex">DB + WhatsApp</span>
            </div>

            @if (session('status'))
                <div class="mt-5 rounded-lg border border-[var(--line-strong)] bg-[var(--accent)]/10 px-4 py-3 text-sm font-semibold text-[var(--muted-strong)]">{{ session('status') }}</div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="mt-5 grid gap-4" id="contact-form">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="grid gap-2 text-sm font-bold text-[var(--text)]">
                        Name
                        <input name="name" value="{{ old('name') }}" required class="input-field" autocomplete="name">
                        @error('name') <span class="text-xs text-[#ffb4b4]">{{ $message }}</span> @enderror
                    </label>
                    <label class="grid gap-2 text-sm font-bold text-[var(--text)]">
                        Email
                        <input name="email" type="email" value="{{ old('email') }}" required class="input-field" autocomplete="email">
                        @error('email') <span class="text-xs text-[#ffb4b4]">{{ $message }}</span> @enderror
                    </label>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="grid gap-2 text-sm font-bold text-[var(--text)]">
                        Company
                        <input name="company" value="{{ old('company') }}" class="input-field" autocomplete="organization">
                    </label>
                    <label class="grid gap-2 text-sm font-bold text-[var(--text)]">
                        Phone
                        <input name="phone" value="{{ old('phone') }}" class="input-field" autocomplete="tel">
                    </label>
                </div>
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">
                    Service interest
                    <select name="service" class="input-field">
                        <option value="">Service interest</option>
                        @foreach ($services as $service)
                            <option value="{{ $service['name'] }}" @selected(old('service', request('intent')) === $service['name'])>{{ $service['name'] }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">
                    Project note
                    <textarea name="message" required rows="6" class="input-field">{{ old('message', request('intent') ? 'I want to discuss: '.request('intent') : '') }}</textarea>
                    @error('message') <span class="text-xs text-[#ffb4b4]">{{ $message }}</span> @enderror
                </label>
                <div class="flex flex-wrap gap-3">
                    <button class="btn-primary" type="submit">Submit to Tekvista</button>
                    <button type="button" data-whatsapp-form class="btn-secondary">Send on WhatsApp</button>
                </div>
            </form>
        </section>
    </div>
</section>
@endsection
