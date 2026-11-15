<?php
namespace App\Http\Controllers;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class DosenController extends Controller {
    private function rules($id = null): array {
        return ['nama' => 'required|string|max:255', 'nidn' => 'required|unique:dosens,nidn,' . $id, 'email' => 'nullable|email',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'];
    }
    public function index(Request $r) {
        $data = Dosen::withCount('bimbingans')
            ->when($r->q, fn ($q) => $q->where('nama', 'like', "%{$r->q}%")->orWhere('nidn', 'like', "%{$r->q}%"))
            ->orderBy('id')->paginate(5)->withQueryString();
        return view('dosen.index', compact('data'));
    }
    public function create() { return view('dosen.form'); }
    public function store(Request $r) {
        $data = $r->validate($this->rules());
        if ($r->hasFile('foto')) $data['foto'] = $r->file('foto')->store('dosen', 'public');
        Dosen::create($data);
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }
    public function edit(Dosen $dosen) { return view('dosen.form', compact('dosen')); }
    public function update(Request $r, Dosen $dosen) {
        $data = $r->validate($this->rules($dosen->id));
        if ($r->hasFile('foto')) {
            if ($dosen->foto) Storage::disk('public')->delete($dosen->foto);
            $data['foto'] = $r->file('foto')->store('dosen', 'public');
        } else {
            unset($data['foto']); // tidak upload baru -> pertahankan foto lama
        }
        $dosen->update($data);
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }
    public function destroy(Dosen $dosen) {
        if ($dosen->foto) Storage::disk('public')->delete($dosen->foto);
        $dosen->delete();
        return back()->with('success', 'Data dosen berhasil dihapus.');
    }
}
