<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function redirectAfterLogin()
    {
        $user = auth()->user();
        return match ($user->role) {
            'admin' => redirect()->route('dashboard.admin'),
            'guru'  => redirect()->route('dashboard.guru'),
            'siswa' => redirect()->route('dashboard.siswa'),
            default => redirect('/'),
        };
    }
}
