@extends('layout')

@section('content')
<section class="mx-auto max-w-xl px-4 py-14 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Create Account</p>
        <h1 class="mt-2 text-3xl font-black text-[var(--text)]">Register for TekVista CMS</h1>
        <p class="mt-2 text-sm text-[var(--muted)]">Enterprise-ready authoring access for SEO-focused content workflows.</p>

        <form method="POST" action="{{ route('register.submit') }}" class="mt-6 grid gap-4">
            @csrf
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Full name
                <input type="text" name="name" value="{{ old('name') }}" required class="input-field">
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Email
                <input type="email" name="email" value="{{ old('email') }}" required class="input-field">
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Username
                <input type="text" name="username" value="{{ old('username') }}" required class="input-field" minlength="3" maxlength="60" placeholder="author_handle">
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Password
                <input type="password" name="password" required class="input-field" minlength="8">
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Confirm password
                <input type="password" name="password_confirmation" required class="input-field" minlength="8">
            </label>
            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="btn-primary justify-center">Register</button>
        </form>
    </div>
</section>
@endsection
