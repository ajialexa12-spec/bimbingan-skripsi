<?php
namespace App\Http\Controllers;
use App\Models\{Bimbingan, Dosen, Mahasiswa, Skripsi};
class LaporanController extends Controller {
    public function index() {
        return view('laporan.index', [
            'dosens' => Dosen::withCount('bimbingans', 'mahasiswas')->get(),
            'perStatus' => Bimbingan::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status'),
            'skripsis' => Skripsi::with('mahasiswa.dosen')->get(),
            'totalMhs' => Mahasiswa::count(),
        ]);
    }
    public function export() {
        $rows = Bimbingan::with(['mahasiswa', 'dosen'])->orderBy('tanggal')->get();
        return response()->streamDownload(function () use ($rows) {
            $f = fopen('php://output', 'w');
            fputcsv($f, ['Tanggal', 'NIM', 'Mahasiswa', 'Dosen', 'Topik', 'Status']);
            foreach ($rows as $b) fputcsv($f, [$b->tanggal->format('Y-m-d'), $b->mahasiswa->nim, $b->mahasiswa->nama, $b->dosen->nama, $b->topik, $b->status]);
            fclose($f);
        }, 'laporan-bimbingan.csv', ['Content-Type' => 'text/csv']);
    }
}
