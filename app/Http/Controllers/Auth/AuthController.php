<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login', ['title' => 'Tekvista | Login']);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:rfc'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (!Auth::attempt($credentials, (bool) $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('blog.manage.index'));
    }

    public function showRegister(): View
    {
        return view('auth.register', ['title' => 'Tekvista | Register']);
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'string', 'min:3', 'max:60', 'regex:/^[a-z0-9_\\.]+$/i', 'unique:users,username'],
            'email' => ['required', 'email:rfc', 'max:160', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8', 'max:120'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'username' => Str::lower($validated['username']),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'timezone' => 'Asia/Kolkata',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('blog.manage.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
