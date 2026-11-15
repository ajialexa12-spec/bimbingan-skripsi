@extends('layouts.app')
@php $edit = isset($dosen); $v = fn($k,$d='') => old($k, $edit ? $dosen->$k : $d); @endphp
@section('title', $edit ? 'Edit Dosen' : 'Tambah Dosen')
@section('breadcrumb')Dashboard / <a href="{{ route('dosen.index') }}">Dosen</a> / {{ $edit ? 'Edit' : 'Tambah' }}@endsection
@section('content')
<x-form-card :title="$edit ? 'Edit Dosen' : 'Tambah Dosen'" :action="$edit ? route('dosen.update',$dosen) : route('dosen.store')" :back="route('dosen.index')" :edit="$edit">
  <label class="lbl !mt-0">Nama Dosen <span class="text-red-500">*</span></label><input name="nama" value="{{ $v('nama') }}" class="inp" placeholder="Masukkan nama dosen" required>
  <label class="lbl">NIDN <span class="text-red-500">*</span></label><input name="nidn" value="{{ $v('nidn') }}" class="inp" placeholder="Masukkan NIDN" required>
  <label class="lbl">Email</label><input type="email" name="email" value="{{ $v('email') }}" class="inp" placeholder="Masukkan email">
  <label class="lbl">Foto Dosen <span class="text-xs text-slate-500">(PNG/JPG, maks 2MB)</span></label>
  @if($edit && $dosen->foto)<img src="{{ asset('storage/'.$dosen->foto) }}" class="w-20 h-20 rounded-full object-cover mb-2" alt="Foto {{ $dosen->nama }}">@endif
  <input type="file" name="foto" accept=".png,.jpg,.jpeg,image/png,image/jpeg" class="inp">
  @error('foto')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
  @if($edit && $dosen->foto)<div class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti foto.</div>@endif
</x-form-card>
@endsection
