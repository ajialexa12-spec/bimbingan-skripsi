@extends('layouts.app')
@php $edit = isset($jadwal); $v = fn($k,$d='') => old($k, $edit ? $jadwal->$k : $d); @endphp
@section('title', $edit ? 'Edit Jadwal Bimbingan' : 'Tambah Jadwal Bimbingan')
@section('breadcrumb')Dashboard / <a href="{{ route('jadwal.index') }}">Jadwal Bimbingan</a> / {{ $edit ? 'Edit' : 'Tambah' }}@endsection
@section('content')
<x-form-card :title="$edit ? 'Edit Jadwal Bimbingan' : 'Tambah Jadwal Bimbingan'" :action="$edit ? route('jadwal.update',$jadwal->id) : route('jadwal.store')" :back="route('jadwal.index')" :edit="$edit">
  <label class="lbl !mt-0">Mahasiswa <span class="text-red-500">*</span></label>
  <select name="mahasiswa_id" class="inp" required><option value="">Pilih mahasiswa</option>@foreach($mahasiswas as $m)<option value="{{ $m->id }}" @selected($v('mahasiswa_id')==$m->id)>{{ $m->nama }}</option>@endforeach</select>
  <label class="lbl">Dosen <span class="text-red-500">*</span></label>
  <select name="dosen_id" class="inp" required><option value="">Pilih dosen</option>@foreach($dosens as $d)<option value="{{ $d->id }}" @selected($v('dosen_id')==$d->id)>{{ $d->nama }}</option>@endforeach</select>
  <div class="grid grid-cols-2 gap-4">
    <div><label class="lbl">Tanggal <span class="text-red-500">*</span></label><input type="date" name="tanggal" value="{{ $edit && !old('tanggal') ? $jadwal->tanggal->toDateString() : old('tanggal', now()->toDateString()) }}" class="inp" required></div>
    <div><label class="lbl">Jam</label><input type="time" name="jam" value="{{ $edit && !old('jam') ? substr($jadwal->jam,0,5) : old('jam') }}" class="inp"></div>
  </div>
  <label class="lbl">Topik <span class="text-red-500">*</span></label><input name="topik" value="{{ $v('topik') }}" class="inp" placeholder="Contoh: Bab 3" required>
  <label class="lbl">Status</label>
  <select name="status" class="inp">@foreach(['Menunggu','Proses','Selesai'] as $st)<option @selected($v('status','Menunggu')==$st)>{{ $st }}</option>@endforeach</select>
  <label class="lbl">Catatan</label><textarea name="catatan" class="inp" rows="3">{{ $v('catatan') }}</textarea>
</x-form-card>
@endsection
