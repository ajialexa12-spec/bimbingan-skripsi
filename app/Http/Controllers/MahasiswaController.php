<?php
namespace App\Http\Controllers;
use App\Models\{Mahasiswa, Dosen};
use Illuminate\Http\Request;
class MahasiswaController extends Controller {
    private function rules($id = null): array {
        return ['nama' => 'required|string|max:255', 'nim' => 'required|unique:mahasiswas,nim,' . $id, 'email' => 'required|email',
            'program_studi' => 'required', 'dosen_id' => 'required|exists:dosens,id', 'status' => 'nullable|in:Aktif,Selesai'];
    }
    public function index(Request $r) {
        $data = Mahasiswa::with('dosen')
            ->when($r->q, fn ($q) => $q->where(fn ($w) => $w->where('nama', 'like', "%{$r->q}%")->orWhere('nim', 'like', "%{$r->q}%")))
            ->when($r->status, fn ($q) => $q->where('status', $r->status))
            ->orderBy('id')->paginate(5)->withQueryString();
        return view('mahasiswa.index', compact('data'));
    }
    public function create() { return view('mahasiswa.form', ['dosens' => Dosen::orderBy('nama')->get()]); }
    public function store(Request $r) {
        Mahasiswa::create($r->validate($this->rules()) + ['status' => $r->status ?? 'Aktif']);
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }
    public function edit(Mahasiswa $mahasiswa) { return view('mahasiswa.form', ['mahasiswa' => $mahasiswa, 'dosens' => Dosen::orderBy('nama')->get()]); }
    public function update(Request $r, Mahasiswa $mahasiswa) {
        $mahasiswa->update($r->validate($this->rules($mahasiswa->id)));
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }
    public function destroy(Mahasiswa $mahasiswa) {
        $mahasiswa->delete();
        return back()->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
