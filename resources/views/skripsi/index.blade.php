@extends('layouts.app')
@section('title','Data Skripsi')
@section('breadcrumb','Dashboard / Skripsi')
@section('content')
<div class="flex justify-between items-center mb-4"><h1 class="text-2xl font-bold">Data Skripsi (Judul)</h1><a href="{{ route('skripsi.create') }}" class="btn"><i class="bi bi-plus-lg"></i> Tambah Skripsi</a></div>
<form class="mb-4" method="GET"><div class="relative"><i class="bi bi-search absolute left-3 top-2.5 text-slate-400"></i><input name="q" value="{{ request('q') }}" placeholder="Cari judul / mahasiswa..." class="inp pl-9"></div></form>
<div class="bg-white rounded-lg shadow-sm overflow-x-auto"><table class="w-full"><thead class="bg-slate-50 border-b"><tr><th class="th">No</th><th class="th">Mahasiswa</th><th class="th">Judul Skripsi</th><th class="th">Progress</th><th class="th">Status</th><th class="th">Aksi</th></tr></thead><tbody>
@forelse($data as $s)
<tr class="border-b last:border-0"><td class="td">{{ $data->firstItem()+$loop->index }}</td><td class="td">{{ $s->mahasiswa->nama }}<div class="text-xs text-slate-500">{{ $s->mahasiswa->nim }}</div></td><td class="td">{{ $s->judul }}@if($s->file_pdf)<div><a href="{{ asset('storage/'.$s->file_pdf) }}" target="_blank" class="text-xs text-blue-600"><i class="bi bi-file-earmark-pdf-fill text-red-500"></i> Lihat PDF</a></div>@endif</td>
<td class="td"><div class="w-28 h-2 bg-slate-200 rounded"><div class="h-2 bg-brand rounded" style="width:{{ $s->progress }}%"></div></div><span class="text-xs">{{ $s->progress }}%</span></td><td class="td"><x-badge :status="$s->status"/></td>
<td class="td"><div class="flex gap-3 items-center">
  <a href="{{ route('riwayat.index',['mahasiswa'=>$s->mahasiswa_id]) }}" class="text-blue-600"><i class="bi bi-eye-fill"></i></a>
  <a href="{{ route('skripsi.edit',$s) }}" class="text-slate-700" title="Edit"><i class="bi bi-pencil-fill"></i></a>
  <form method="POST" action="{{ route('skripsi.destroy',$s) }}" onsubmit="return confirm('Hapus skripsi ini?')">@csrf @method('DELETE')<button class="text-red-500"><i class="bi bi-trash-fill"></i></button></form></div></td></tr>
@empty<tr><td colspan="6" class="td text-center text-slate-500">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
<div class="mt-4">{{ $data->links() }}</div>
@endsection
