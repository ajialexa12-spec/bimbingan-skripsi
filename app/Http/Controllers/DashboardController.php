<?php
namespace App\Http\Controllers;
use App\Models\{Mahasiswa, Dosen, Skripsi, Bimbingan};
class DashboardController extends Controller {
    private function trend($model): int {
        $now = $model::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $prev = $model::whereMonth('created_at', now()->subMonth()->month)->whereYear('created_at', now()->subMonth()->year)->count();
        if ($prev == 0) return $now > 0 ? 100 : 0;
        return (int) round((($now - $prev) / $prev) * 100);
    }
    public function __invoke() {
        $stats = [
            ['label' => 'Mahasiswa', 'value' => Mahasiswa::count(), 'trend' => $this->trend(Mahasiswa::class), 'icon' => 'bi-people-fill', 'color' => 'text-blue-600'],
            ['label' => 'Dosen', 'value' => Dosen::count(), 'trend' => $this->trend(Dosen::class), 'icon' => 'bi-mortarboard-fill', 'color' => 'text-green-600'],
            ['label' => 'Skripsi Aktif', 'value' => Skripsi::where('status', '!=', 'Selesai')->count(), 'trend' => $this->trend(Skripsi::class), 'icon' => 'bi-book-fill', 'color' => 'text-orange-500'],
            ['label' => 'Total Bimbingan', 'value' => Bimbingan::count(), 'trend' => $this->trend(Bimbingan::class), 'icon' => 'bi-chat-dots-fill', 'color' => 'text-purple-600'],
        ];
        $labels = []; $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $d = now()->subMonths($i);
            $labels[] = $d->translatedFormat('M');
            $data[] = Bimbingan::whereMonth('tanggal', $d->month)->whereYear('tanggal', $d->year)->count();
        }
        $terbaru = Bimbingan::with('mahasiswa')->latest('tanggal')->latest('id')->take(3)->get();
        return view('dashboard.index', compact('stats', 'labels', 'data', 'terbaru'));
    }
}
