<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('pages.profile.edit', [
            'title' => 'Tekvista | Profile Settings',
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'string', 'min:3', 'max:60', 'regex:/^[a-z0-9_\.]+$/i', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'email:rfc', 'max:160', Rule::unique('users', 'email')->ignore($user->id)],
            'job_title' => ['nullable', 'string', 'max:120'],
            'department' => ['nullable', 'string', 'max:120'],
            'phone' => ['nullable', 'string', 'max:40'],
            'location' => ['nullable', 'string', 'max:160'],
            'timezone' => ['required', 'timezone:all'],
            'website_url' => ['nullable', 'url:http,https', 'max:255'],
            'linkedin_url' => ['nullable', 'url:http,https', 'max:255'],
            'avatar_url' => ['nullable', 'url:http,https', 'max:500'],
            'bio' => ['nullable', 'string', 'max:1500'],
            'password' => ['nullable', 'confirmed', 'min:8', 'max:120'],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->fill($validated);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');
    }
}
