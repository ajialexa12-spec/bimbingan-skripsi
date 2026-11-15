<?php
namespace App\Http\Controllers;
use App\Models\{Bimbingan, Mahasiswa, Dosen};
use Illuminate\Http\Request;
class JadwalController extends Controller {
    private function rules(): array {
        return ['mahasiswa_id' => 'required|exists:mahasiswas,id', 'dosen_id' => 'required|exists:dosens,id', 'tanggal' => 'required|date',
            'jam' => 'nullable', 'topik' => 'required|string|max:255', 'status' => 'required|in:Menunggu,Proses,Selesai', 'catatan' => 'nullable|string'];
    }
    private function opsi(): array { return ['mahasiswas' => Mahasiswa::orderBy('nama')->get(), 'dosens' => Dosen::orderBy('nama')->get()]; }
    public function index(Request $r) {
        $data = Bimbingan::with(['mahasiswa', 'dosen'])
            ->when($r->status, fn ($q) => $q->where('status', $r->status))
            ->orderByDesc('tanggal')->paginate(6)->withQueryString();
        return view('jadwal.index', compact('data'));
    }
    public function create() { return view('jadwal.form', $this->opsi()); }
    public function store(Request $r) { Bimbingan::create($r->validate($this->rules())); return redirect()->route('jadwal.index')->with('success', 'Jadwal bimbingan berhasil ditambahkan.'); }
    public function edit($jadwal) { return view('jadwal.form', $this->opsi() + ['jadwal' => Bimbingan::findOrFail($jadwal)]); }
    public function update(Request $r, $jadwal) { Bimbingan::findOrFail($jadwal)->update($r->validate($this->rules())); return redirect()->route('jadwal.index')->with('success', 'Jadwal bimbingan berhasil diperbarui.'); }
    public function destroy($jadwal) { Bimbingan::findOrFail($jadwal)->delete(); return back()->with('success', 'Jadwal bimbingan berhasil dihapus.'); }
}
