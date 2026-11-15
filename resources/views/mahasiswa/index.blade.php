@extends('layouts.app')
@section('title','Data Mahasiswa')
@section('breadcrumb','Dashboard / Mahasiswa')
@section('content')
<div class="flex justify-between items-center mb-4"><h1 class="text-2xl font-bold">Data Mahasiswa</h1><a href="{{ route('mahasiswa.create') }}" class="btn"><i class="bi bi-plus-lg"></i> Tambah Mahasiswa</a></div>
<form class="flex gap-3 mb-4" method="GET">
  <div class="relative flex-1"><i class="bi bi-search absolute left-3 top-2.5 text-slate-400"></i><input name="q" value="{{ request('q') }}" placeholder="Cari mahasiswa..." class="inp pl-9"></div>
  <select name="status" class="inp !w-44" onchange="this.form.submit()"><option value="">Filter Status</option><option @selected(request('status')=='Aktif')>Aktif</option><option @selected(request('status')=='Selesai')>Selesai</option></select>
</form>
<div class="bg-white rounded-lg shadow-sm overflow-x-auto"><table class="w-full"><thead class="bg-slate-50 border-b"><tr><th class="th">No</th><th class="th">Nama</th><th class="th">NIM</th><th class="th">Pembimbing</th><th class="th">Status</th><th class="th">Aksi</th></tr></thead><tbody>
@forelse($data as $m)
<tr class="border-b last:border-0"><td class="td">{{ $data->firstItem()+$loop->index }}</td><td class="td">{{ $m->nama }}</td><td class="td">{{ $m->nim }}</td><td class="td">{{ $m->dosen->nama }}</td><td class="td"><x-badge :status="$m->status" kind="mhs"/></td>
<td class="td"><div class="flex gap-3 items-center">
  <a href="{{ route('riwayat.index',['mahasiswa'=>$m->id]) }}" class="text-blue-600" title="Detail"><i class="bi bi-eye-fill"></i></a>
  <a href="{{ route('mahasiswa.edit',$m) }}" class="text-slate-700" title="Edit"><i class="bi bi-pencil-fill"></i></a>
  <form method="POST" action="{{ route('mahasiswa.destroy',$m) }}" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')<button class="text-red-500"><i class="bi bi-trash-fill"></i></button></form></div></td></tr>
@empty<tr><td colspan="6" class="td text-center text-slate-500">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
<div class="mt-4">{{ $data->links() }}</div>
@endsection
