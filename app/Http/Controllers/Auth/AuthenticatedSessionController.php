<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    // tampilkan form login
    public function create()
    {
        return view('auth.login'); // pastikan login.blade.php di resources/views/auth
    }

    // proses login
    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        // login pakai email + password
        if (! Auth::attempt($request->only('email','password'), $request->filled('remember'))) {
            return back()->withErrors([
                'email' => 'Email atau password salah!',
            ])->withInput();
        }

        $request->session()->regenerate();

        // redirect sesuai role
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'user') {
            return redirect()->route('user.dashboard');
        }

        return redirect()->route('home'); // fallback
    }

    // logout
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
