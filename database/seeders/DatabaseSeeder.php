<?php
namespace Database\Seeders;
use App\Models\{User, Dosen, Mahasiswa, Skripsi, Bimbingan};
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::create(['name' => 'Administrator', 'email' => 'admin@bimbingskripsi.test', 'nim' => 'ADMIN', 'password' => 'password', 'role' => 'admin']);
        $d1 = Dosen::create(['nama' => 'Dr. Ahmad, M.T.', 'nidn' => '00123456', 'email' => 'ahmad@kampus.ac.id']);
        $d2 = Dosen::create(['nama' => 'Dr. Budi, M.Kom.', 'nidn' => '00123457', 'email' => 'budi@kampus.ac.id']);
        $d3 = Dosen::create(['nama' => 'Dr. Citra, S.Si., M.T.', 'nidn' => '00123458', 'email' => 'citra@kampus.ac.id']);
        $m1 = Mahasiswa::create(['nama' => 'Andi Pratama', 'nim' => '2023001', 'email' => 'andi@mail.com', 'program_studi' => 'Sistem Informasi', 'dosen_id' => $d1->id, 'status' => 'Aktif']);
        $m2 = Mahasiswa::create(['nama' => 'Siti Rahma', 'nim' => '2023002', 'email' => 'siti@mail.com', 'program_studi' => 'Teknik Informatika', 'dosen_id' => $d2->id, 'status' => 'Aktif']);
        $m3 = Mahasiswa::create(['nama' => 'Rina Fitri', 'nim' => '2023003', 'email' => 'rina@mail.com', 'program_studi' => 'Sistem Informasi', 'dosen_id' => $d1->id, 'status' => 'Selesai']);
        Skripsi::create(['mahasiswa_id' => $m1->id, 'judul' => 'Sistem Informasi Bimbingan Skripsi Berbasis Web', 'status' => 'Proses', 'progress' => 75]);
        Skripsi::create(['mahasiswa_id' => $m2->id, 'judul' => 'Aplikasi Monitoring Tugas Akhir Mahasiswa', 'status' => 'Proses', 'progress' => 40]);
        Skripsi::create(['mahasiswa_id' => $m3->id, 'judul' => 'Rancang Bangun Sistem Perpustakaan Digital', 'status' => 'Selesai', 'progress' => 100]);
        $rows = [
            [$m1, $d1, '2026-01-12', 'Bab 1', 'Selesai'], [$m2, $d2, '2026-02-10', 'Bab 1', 'Selesai'],
            [$m3, $d1, '2026-03-05', 'Bab 2', 'Selesai'], [$m1, $d1, '2026-04-15', 'Bab 2', 'Selesai'],
            [$m2, $d2, '2026-05-20', 'Bab 3', 'Selesai'], [$m3, $d1, '2026-06-08', 'Bab 4', 'Selesai'],
            [$m1, $d1, '2026-10-15', 'Revisi Proposal', 'Menunggu'], [$m1, $d1, '2026-10-20', 'Pembahasan Bab III', 'Selesai'],
            [$m2, $d2, '2026-11-05', 'Revisi', 'Proses'], [$m1, $d1, '2026-11-06', 'Bab 3', 'Selesai'],
        ];
        foreach ($rows as [$m, $d, $tgl, $topik, $st]) {
            Bimbingan::create(['mahasiswa_id' => $m->id, 'dosen_id' => $d->id, 'tanggal' => $tgl, 'jam' => '10:00', 'topik' => $topik, 'status' => $st]);
        }
    }
}
