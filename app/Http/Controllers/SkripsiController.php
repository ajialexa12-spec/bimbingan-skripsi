<?php
namespace App\Http\Controllers;
use App\Models\{Skripsi, Mahasiswa};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SkripsiController extends Controller {
    private function rules(): array {
        return ['mahasiswa_id' => 'required|exists:mahasiswas,id', 'judul' => 'required|string|max:500',
            'status' => 'required|in:Proses,Menunggu,Selesai', 'progress' => 'required|integer|min:0|max:100',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240'];
    }
    public function index(Request $r) {
        $data = Skripsi::with('mahasiswa.dosen')
            ->when($r->q, fn ($q) => $q->where('judul', 'like', "%{$r->q}%")->orWhereHas('mahasiswa', fn ($m) => $m->where('nama', 'like', "%{$r->q}%")))
            ->orderBy('id')->paginate(5)->withQueryString();
        return view('skripsi.index', compact('data'));
    }
    public function create() { return view('skripsi.form', ['mahasiswas' => Mahasiswa::orderBy('nama')->get()]); }
    public function store(Request $r) {
        $data = $r->validate($this->rules());
        if ($r->hasFile('file_pdf')) $data['file_pdf'] = $r->file('file_pdf')->store('skripsi', 'public');
        Skripsi::create($data);
        return redirect()->route('skripsi.index')->with('success', 'Data skripsi berhasil ditambahkan.');
    }
    public function edit(Skripsi $skripsi) { return view('skripsi.form', ['skripsi' => $skripsi, 'mahasiswas' => Mahasiswa::orderBy('nama')->get()]); }
    public function update(Request $r, Skripsi $skripsi) {
        $data = $r->validate($this->rules());
        if ($r->hasFile('file_pdf')) {
            if ($skripsi->file_pdf) Storage::disk('public')->delete($skripsi->file_pdf);
            $data['file_pdf'] = $r->file('file_pdf')->store('skripsi', 'public');
        } else {
            unset($data['file_pdf']); // tidak upload baru -> pertahankan PDF lama
        }
        $skripsi->update($data);
        return redirect()->route('skripsi.index')->with('success', 'Data skripsi berhasil diperbarui.');
    }
    public function destroy(Skripsi $skripsi) {
        if ($skripsi->file_pdf) Storage::disk('public')->delete($skripsi->file_pdf);
        $skripsi->delete();
        return back()->with('success', 'Data skripsi berhasil dihapus.');
    }
}
