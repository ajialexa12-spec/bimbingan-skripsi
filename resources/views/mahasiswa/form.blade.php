@extends('layouts.app')
@php $edit = isset($mahasiswa); $v = fn($k,$d='') => old($k, $edit ? $mahasiswa->$k : $d); @endphp
@section('title', $edit ? 'Edit Mahasiswa' : 'Tambah Mahasiswa')
@section('breadcrumb')Dashboard / <a href="{{ route('mahasiswa.index') }}">Mahasiswa</a> / {{ $edit ? 'Edit' : 'Tambah' }}@endsection
@section('content')
<x-form-card :title="$edit ? 'Edit Mahasiswa' : 'Tambah Mahasiswa'" :action="$edit ? route('mahasiswa.update',$mahasiswa) : route('mahasiswa.store')" :back="route('mahasiswa.index')" :edit="$edit">
  <label class="lbl !mt-0">Nama Lengkap <span class="text-red-500">*</span></label><input name="nama" value="{{ $v('nama') }}" class="inp" placeholder="Masukkan nama lengkap" required>
  <label class="lbl">NIM <span class="text-red-500">*</span></label><input name="nim" value="{{ $v('nim') }}" class="inp" placeholder="Masukkan NIM" required>
  <label class="lbl">Email <span class="text-red-500">*</span></label><input type="email" name="email" value="{{ $v('email') }}" class="inp" placeholder="Masukkan email" required>
  <label class="lbl">Program Studi <span class="text-red-500">*</span></label>
  <select name="program_studi" class="inp" required><option value="">Pilih program studi</option>@foreach(['Sistem Informasi','Teknik Informatika','Manajemen Informatika','Teknik Komputer'] as $p)<option @selected($v('program_studi')==$p)>{{ $p }}</option>@endforeach</select>
  <label class="lbl">Dosen Pembimbing <span class="text-red-500">*</span></label>
  <select name="dosen_id" class="inp" required><option value="">Pilih dosen pembimbing</option>@foreach($dosens as $d)<option value="{{ $d->id }}" @selected($v('dosen_id')==$d->id)>{{ $d->nama }}</option>@endforeach</select>
  <label class="lbl">Status</label>
  <select name="status" class="inp">@foreach(['Aktif','Selesai'] as $st)<option @selected($v('status','Aktif')==$st)>{{ $st }}</option>@endforeach</select>
</x-form-card>
@endsection
