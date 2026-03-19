<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($validatedData)) {
            return back()->withErrors(['password' => 'Invalid credentials.'])->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        return redirect(route('ideas.index'))->with('success', 'Logged in successfully!');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('session.create'))->with('success', 'Logged out successfully!');
    }
}
