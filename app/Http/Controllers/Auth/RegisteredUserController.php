<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
	/**
	 * Display the registration view.
	 */
	public function create(): View
	{
		return view('auth.register');
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'role' => ['required', 'string', 'in:guru,siswa'],
			'password' => ['required', 'confirmed', Rules\Password::defaults()],
		]);

		$email = Str::slug($request->name).'.'.Str::random(6).'@user.local';

		$user = User::create([
			'name' => $request->name,
			'email' => $email,
			'password' => Hash::make($request->password),
			'role' => $request->role,
		]);

		// If guru, create Guru record
		if ($request->role === 'guru') {
			// Generate unique NIP
			do {
				$nip = 'G-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
			} while (\App\Models\Guru::where('nip', $nip)->exists());
			
			\App\Models\Guru::create([
				'nama' => $request->name,
				'nip' => $nip,
				'user_id' => $user->id,
			]);
		}
		// Siswa record will be created/linked on first Absensi submission

		event(new Registered($user));

		Auth::login($user);

		return redirect(route('dashboard', absolute: false));
	}
}
