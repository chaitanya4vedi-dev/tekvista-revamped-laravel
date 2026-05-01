@extends('layout')

@section('content')
<section class="mx-auto max-w-5xl px-4 py-14 sm:px-6 lg:px-8">
    <div class="neo-card p-6 sm:p-8">
        <p class="section-kicker">User Profile</p>
        <h1 class="mt-2 text-3xl font-black text-[var(--text)]">Enterprise Author Profile Settings</h1>
        <p class="mt-2 text-sm text-[var(--muted)]">Your public author details are displayed on every blog post you publish.</p>

        @if (session('status'))
            <div class="mt-4 rounded-xl border border-emerald-300 bg-emerald-50 px-3 py-2 text-sm text-emerald-800">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="mt-6 grid gap-4">
            @csrf
            @method('PATCH')
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Full name
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="input-field" maxlength="120">
                </label>
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Username
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" required class="input-field" maxlength="60" placeholder="author_handle">
                </label>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Email
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="input-field" maxlength="160">
                </label>
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Timezone
                    <input type="text" name="timezone" value="{{ old('timezone', $user->timezone ?: 'Asia/Kolkata') }}" required class="input-field" maxlength="64" placeholder="Asia/Kolkata">
                </label>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Job title
                    <input type="text" name="job_title" value="{{ old('job_title', $user->job_title) }}" class="input-field" maxlength="120">
                </label>
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Department
                    <input type="text" name="department" value="{{ old('department', $user->department) }}" class="input-field" maxlength="120">
                </label>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Phone
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="input-field" maxlength="40">
                </label>
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Location
                    <input type="text" name="location" value="{{ old('location', $user->location) }}" class="input-field" maxlength="160" placeholder="Kolkata, India">
                </label>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Website URL
                    <input type="url" name="website_url" value="{{ old('website_url', $user->website_url) }}" class="input-field" maxlength="255">
                </label>
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">LinkedIn URL
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}" class="input-field" maxlength="255">
                </label>
            </div>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Avatar URL
                <input type="url" name="avatar_url" value="{{ old('avatar_url', $user->avatar_url) }}" class="input-field" maxlength="500">
            </label>
            <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Bio
                <textarea name="bio" class="input-field" rows="4" maxlength="1500">{{ old('bio', $user->bio) }}</textarea>
            </label>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">New password (optional)
                    <input type="password" name="password" class="input-field" minlength="8" maxlength="120">
                </label>
                <label class="grid gap-2 text-sm font-bold text-[var(--text)]">Confirm new password
                    <input type="password" name="password_confirmation" class="input-field" minlength="8" maxlength="120">
                </label>
            </div>
            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="btn-primary justify-center">Save Profile</button>
        </form>
    </div>
</section>
@endsection
