@extends('layouts.app')
@section('title','Jadwal Bimbingan')
@section('breadcrumb','Dashboard / Jadwal Bimbingan')
@section('content')
<div class="flex justify-between items-center mb-4"><h1 class="text-2xl font-bold">Jadwal Bimbingan</h1><a href="{{ route('jadwal.create') }}" class="btn"><i class="bi bi-plus-lg"></i> Tambah Jadwal</a></div>
<form class="mb-4" method="GET"><select name="status" class="inp !w-48" onchange="this.form.submit()"><option value="">Semua Status</option>@foreach(['Menunggu','Proses','Selesai'] as $st)<option @selected(request('status')==$st)>{{ $st }}</option>@endforeach</select></form>
<div class="bg-white rounded-lg shadow-sm overflow-x-auto"><table class="w-full"><thead class="bg-slate-50 border-b"><tr><th class="th">No</th><th class="th">Tanggal</th><th class="th">Mahasiswa</th><th class="th">Dosen</th><th class="th">Topik</th><th class="th">Status</th><th class="th">Aksi</th></tr></thead><tbody>
@forelse($data as $b)
<tr class="border-b last:border-0"><td class="td">{{ $data->firstItem()+$loop->index }}</td><td class="td">{{ $b->tanggal->translatedFormat('d M Y') }} {{ substr($b->jam,0,5) }}</td><td class="td">{{ $b->mahasiswa->nama }}</td><td class="td">{{ $b->dosen->nama }}</td><td class="td">{{ $b->topik }}</td><td class="td"><x-badge :status="$b->status"/></td>
<td class="td"><div class="flex gap-3 items-center">
  <a href="{{ route('jadwal.edit',$b->id) }}" class="text-slate-700" title="Edit"><i class="bi bi-pencil-fill"></i></a>
  <form method="POST" action="{{ route('jadwal.destroy',$b->id) }}" onsubmit="return confirm('Hapus jadwal ini?')">@csrf @method('DELETE')<button class="text-red-500"><i class="bi bi-trash-fill"></i></button></form></div></td></tr>
@empty<tr><td colspan="7" class="td text-center text-slate-500">Belum ada jadwal.</td></tr>@endforelse
</tbody></table></div>
<div class="mt-4">{{ $data->links() }}</div>
@endsection
