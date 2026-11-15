<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
    public function showLogin() { return view('auth.login'); }
    public function login(Request $r) {
        $r->validate(['login' => 'required', 'password' => 'required']);
        $field = filter_var($r->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';
        if (Auth::attempt([$field => $r->login, 'password' => $r->password], $r->boolean('remember'))) {
            $r->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors(['login' => 'Email/NIM atau password salah.'])->onlyInput('login');
    }
    public function logout(Request $r) {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('login');
    }
    public function showForgot() { return view('auth.forgot'); }
    public function resetPassword(Request $r) {
        $d = $r->validate(['email' => 'required|email|exists:users,email', 'password' => 'required|min:6|confirmed']);
        User::where('email', $d['email'])->first()->update(['password' => $d['password']]);
        return redirect()->route('login')->with('success', 'Password berhasil diubah, silakan login.');
    }
}
