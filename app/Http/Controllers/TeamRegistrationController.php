<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class TeamRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        $teams = Team::all(); // Ambil semua tim untuk pilihan
        return view('auth.register', compact('teams'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'team_id' => 'required|exists:teams,id',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Menambahkan user ke tim yang dipilih
        $user->teams()->attach($request->team_id);

        // Log in user
        auth()->login($user);

        return redirect()->route('dashboard');
    }
}
