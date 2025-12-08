<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Identifiants invalides'])->withInput();
        }

        if (!Hash::check($data['password'], $user->mot_de_passe)) {
            return back()->withErrors(['password' => 'Identifiants invalides'])->withInput();
        }

        // Store minimal session info
        session(['admin_user_id' => $user->id_utilisateur]);
        // Optionally store user name
        session(['admin_user_name' => $user->nom . ' ' . ($user->prenom ?? '')]);

        return redirect()->route('admin.accueil');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_user_id','admin_user_name']);
        return redirect()->route('login');
    }
}
