@extends('layouts.app')
@php $edit = isset($skripsi); $v = fn($k,$d='') => old($k, $edit ? $skripsi->$k : $d); @endphp
@section('title', $edit ? 'Edit Skripsi' : 'Tambah Skripsi')
@section('breadcrumb')Dashboard / <a href="{{ route('skripsi.index') }}">Skripsi</a> / {{ $edit ? 'Edit' : 'Tambah' }}@endsection
@section('content')
<x-form-card :title="$edit ? 'Edit Skripsi' : 'Tambah Skripsi'" :action="$edit ? route('skripsi.update',$skripsi) : route('skripsi.store')" :back="route('skripsi.index')" :edit="$edit">
  <label class="lbl !mt-0">Mahasiswa <span class="text-red-500">*</span></label>
  <select name="mahasiswa_id" class="inp" required><option value="">Pilih mahasiswa</option>@foreach($mahasiswas as $m)<option value="{{ $m->id }}" @selected($v('mahasiswa_id')==$m->id)>{{ $m->nama }} ({{ $m->nim }})</option>@endforeach</select>
  <label class="lbl">Judul Skripsi <span class="text-red-500">*</span></label><textarea name="judul" class="inp" rows="3" placeholder="Masukkan judul skripsi" required>{{ $v('judul') }}</textarea>
  <label class="lbl">Status</label>
  <select name="status" class="inp">@foreach(['Menunggu','Proses','Selesai'] as $st)<option @selected($v('status','Proses')==$st)>{{ $st }}</option>@endforeach</select>
  <label class="lbl">Progress (%)</label><input type="number" min="0" max="100" name="progress" value="{{ $v('progress',0) }}" class="inp">
  <label class="lbl">File Skripsi <span class="text-xs text-slate-500">(PDF, maks 10MB)</span></label>
  @if($edit && $skripsi->file_pdf)<a href="{{ asset('storage/'.$skripsi->file_pdf) }}" target="_blank" class="text-blue-600 text-sm block mb-2"><i class="bi bi-file-earmark-pdf-fill text-red-500"></i> Lihat PDF saat ini</a>@endif
  <input type="file" name="file_pdf" accept=".pdf,application/pdf" class="inp">
  @error('file_pdf')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
  @if($edit && $skripsi->file_pdf)<div class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti file.</div>@endif
</x-form-card>
@endsection
