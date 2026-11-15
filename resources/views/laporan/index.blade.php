@extends('layouts.app')
@section('title','Laporan')
@section('breadcrumb','Dashboard / Laporan')
@section('content')
<div class="flex justify-between items-center mb-4"><h1 class="text-2xl font-bold">Laporan Bimbingan</h1>
  <div class="flex gap-2 print:hidden"><button onclick="window.print()" class="btn !bg-slate-600"><i class="bi bi-printer"></i> Cetak</button><a href="{{ route('laporan.export') }}" class="btn"><i class="bi bi-download"></i> Export CSV</a></div></div>
<div class="grid sm:grid-cols-4 gap-4 mb-4">
  <div class="bg-white rounded-lg shadow-sm p-4"><div class="text-sm text-slate-500">Total Mahasiswa</div><div class="text-2xl font-bold">{{ $totalMhs }}</div></div>
  @foreach(['Selesai','Proses','Menunggu'] as $s)<div class="bg-white rounded-lg shadow-sm p-4"><div class="text-sm text-slate-500">Bimbingan {{ $s }}</div><div class="text-2xl font-bold">{{ $perStatus[$s] ?? 0 }}</div></div>@endforeach
</div>
<div class="bg-white rounded-lg shadow-sm overflow-x-auto mb-4"><div class="px-4 pt-4 font-bold text-sm">Rekap per Dosen</div><table class="w-full"><thead class="border-b"><tr><th class="th">Dosen</th><th class="th">NIDN</th><th class="th">Mahasiswa Bimbingan</th><th class="th">Total Pertemuan</th></tr></thead><tbody>
@foreach($dosens as $d)<tr class="border-b last:border-0"><td class="td">{{ $d->nama }}</td><td class="td">{{ $d->nidn }}</td><td class="td">{{ $d->mahasiswas_count }}</td><td class="td">{{ $d->bimbingans_count }}</td></tr>@endforeach</tbody></table></div>
<div class="bg-white rounded-lg shadow-sm overflow-x-auto"><div class="px-4 pt-4 font-bold text-sm">Rekap Skripsi</div><table class="w-full"><thead class="border-b"><tr><th class="th">Mahasiswa</th><th class="th">Judul</th><th class="th">Pembimbing</th><th class="th">Progress</th><th class="th">Status</th></tr></thead><tbody>
@foreach($skripsis as $s)<tr class="border-b last:border-0"><td class="td">{{ $s->mahasiswa->nama }}</td><td class="td">{{ $s->judul }}</td><td class="td">{{ $s->mahasiswa->dosen->nama }}</td><td class="td">{{ $s->progress }}%</td><td class="td"><x-badge :status="$s->status"/></td></tr>@endforeach</tbody></table></div>
@endsection
