@extends('layout')

@section('content')
<section class="mx-auto max-w-xl px-4 py-14 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">Account Access</p>
        <h1 class="mt-2 text-3xl font-black text-[var(--text)]">Login to TekVista Dashboard</h1>
        <p class="mt-2 text-sm text-[var(--muted)]">Secure login for enterprise blog and content operations.</p>

        <form method="POST" action="{{ route('login.submit') }}" class="mt-6 grid gap-4">
            @csrf
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Email
                <input type="email" name="email" value="{{ old('email') }}" required class="input-field">
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Password
                <input type="password" name="password" required class="input-field">
            </label>
            <label class="inline-flex items-center gap-2 text-sm text-[var(--muted)]"><input type="checkbox" name="remember"> Remember me</label>
            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="btn-primary justify-center">Login</button>
        </form>
    </div>
</section>
@endsection
