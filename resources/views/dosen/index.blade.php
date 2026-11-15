@extends('layouts.app')
@section('title','Data Dosen')
@section('breadcrumb','Dashboard / Dosen')
@section('content')
<div class="flex justify-between items-center mb-4"><h1 class="text-2xl font-bold">Data Dosen</h1><a href="{{ route('dosen.create') }}" class="btn"><i class="bi bi-plus-lg"></i> Tambah Dosen</a></div>
<form class="mb-4" method="GET"><div class="relative"><i class="bi bi-search absolute left-3 top-2.5 text-slate-400"></i><input name="q" value="{{ request('q') }}" placeholder="Cari dosen..." class="inp pl-9"></div></form>
<div class="bg-white rounded-lg shadow-sm overflow-x-auto"><table class="w-full"><thead class="bg-slate-50 border-b"><tr><th class="th">No</th><th class="th">Nama Dosen</th><th class="th">NIDN</th><th class="th">Jumlah Bimbingan</th><th class="th">Aksi</th></tr></thead><tbody>
@forelse($data as $d)
<tr class="border-b last:border-0"><td class="td">{{ $data->firstItem()+$loop->index }}</td><td class="td"><div class="flex items-center gap-3">@if($d->foto)<img src="{{ asset('storage/'.$d->foto) }}" class="w-9 h-9 rounded-full object-cover" alt="">@else<span class="w-9 h-9 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center"><i class="bi bi-person-fill"></i></span>@endif{{ $d->nama }}</div></td><td class="td">{{ $d->nidn }}</td><td class="td">{{ $d->bimbingans_count }}</td>
<td class="td"><div class="flex gap-3 items-center">
  <a href="{{ route('jadwal.index') }}" class="text-blue-600"><i class="bi bi-eye-fill"></i></a>
  <a href="{{ route('dosen.edit',$d) }}" class="text-slate-700" title="Edit"><i class="bi bi-pencil-fill"></i></a>
  <form method="POST" action="{{ route('dosen.destroy',$d) }}" onsubmit="return confirm('Hapus dosen ini?')">@csrf @method('DELETE')<button class="text-red-500"><i class="bi bi-trash-fill"></i></button></form></div></td></tr>
@empty<tr><td colspan="5" class="td text-center text-slate-500">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
<div class="mt-4">{{ $data->links() }}</div>
@endsection
