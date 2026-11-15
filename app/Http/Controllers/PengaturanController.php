<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
class PengaturanController extends Controller {
    public function index() { return view('pengaturan.index', ['user' => Auth::user()]); }
    public function update(Request $r) {
        $u = Auth::user();
        $d = $r->validate(['name' => 'required|string|max:255', 'email' => 'required|email|unique:users,email,' . $u->id,
            'current_password' => 'nullable|required_with:password', 'password' => 'nullable|min:6|confirmed']);
        if ($r->filled('password')) {
            if (!Hash::check($r->current_password, $u->password)) return back()->withErrors(['current_password' => 'Password lama salah.']);
            $u->password = $r->password;
        }
        $u->name = $d['name']; $u->email = $d['email']; $u->save();
        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
