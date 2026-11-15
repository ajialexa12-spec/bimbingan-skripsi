@extends('layouts.app')
@section('title','Riwayat Bimbingan')
@section('breadcrumb','Dashboard / Riwayat Bimbingan')
@section('content')
<div class="flex justify-between items-center mb-4"><h1 class="text-2xl font-bold">Monitoring Bimbingan</h1>
<form method="GET"><select name="mahasiswa" class="inp !w-60" onchange="this.form.submit()">@foreach($all as $a)<option value="{{ $a->id }}" @selected($mhs && $mhs->id==$a->id)>{{ $a->nama }} ({{ $a->nim }})</option>@endforeach</select></form></div>
@if($mhs)
<div class="bg-white rounded-lg shadow-sm p-4 mb-4">
  <div class="flex justify-between items-start"><div class="flex items-center gap-3"><span class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-2xl"><i class="bi bi-person-fill"></i></span>
    <div><div class="font-bold">{{ $mhs->nama }}</div><div class="text-sm text-slate-500">NIM: {{ $mhs->nim }}</div><div class="text-xs text-slate-500">Pembimbing: {{ $mhs->dosen->nama }}</div></div></div>
    <div class="text-sm">Status: <x-badge :status="$mhs->status" kind="mhs"/></div></div>
  <div class="mt-4 bg-slate-50 rounded p-3 text-sm"><div class="font-semibold">Judul Skripsi</div>{{ $mhs->skripsi->judul ?? 'Belum ada judul' }}</div>
</div>
<div class="bg-white rounded-lg shadow-sm p-4 mb-4"><div class="font-bold text-sm mb-2">Progress Skripsi</div>
  <div class="flex items-center gap-3"><div class="flex-1 h-3 bg-slate-200 rounded"><div class="h-3 bg-brand rounded" style="width:{{ $mhs->skripsi->progress ?? 0 }}%"></div></div><span class="font-bold text-sm">{{ $mhs->skripsi->progress ?? 0 }}%</span></div></div>
<div class="bg-white rounded-lg shadow-sm p-4"><div class="font-bold text-sm mb-3">Riwayat Bimbingan</div>
  @forelse($riwayat as $b)
  <div class="flex items-center justify-between py-2 border-l-2 border-brand pl-4 relative"><span class="absolute -left-[5px] w-2 h-2 bg-brand rounded-full"></span>
    <div class="text-sm"><span class="text-slate-600">{{ $b->tanggal->translatedFormat('d M Y') }}</span> &nbsp;–&nbsp; <span class="font-semibold">{{ $b->topik }}</span></div>
    <x-badge :status="$b->status"/></div>
  @empty<p class="text-sm text-slate-500">Belum ada riwayat bimbingan.</p>@endforelse
</div>
@else<p class="text-slate-500">Belum ada data mahasiswa.</p>@endif
@endsection
