<?php
namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
class RiwayatController extends Controller {
    public function index(Request $r) {
        $all = Mahasiswa::orderBy('nama')->get();
        $mhs = $r->mahasiswa ? Mahasiswa::with(['skripsi', 'dosen'])->find($r->mahasiswa) : null;
        $mhs ??= Mahasiswa::with(['skripsi', 'dosen'])->orderBy('id')->first();
        $riwayat = $mhs ? $mhs->bimbingans()->orderByDesc('tanggal')->get() : collect();
        return view('riwayat.index', compact('all', 'mhs', 'riwayat'));
    }
}
