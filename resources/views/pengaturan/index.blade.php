@extends('layouts.app')
@section('title','Pengaturan')
@section('breadcrumb','Dashboard / Pengaturan')
@section('content')
<h1 class="text-2xl font-bold mb-4">Pengaturan Akun</h1>
<form method="POST" action="{{ route('pengaturan.update') }}" class="bg-white rounded-lg shadow-sm p-6 max-w-lg">@csrf @method('PUT')
  <label class="lbl !mt-0">Nama</label><input name="name" value="{{ old('name',$user->name) }}" class="inp" required>
  <label class="lbl">Email</label><input type="email" name="email" value="{{ old('email',$user->email) }}" class="inp" required>
  <hr class="my-5"><div class="text-sm text-slate-500">Isi hanya jika ingin mengganti password.</div>
  <label class="lbl">Password Lama</label><input type="password" name="current_password" class="inp">
  <label class="lbl">Password Baru</label><input type="password" name="password" class="inp">
  <label class="lbl">Ulangi Password Baru</label><input type="password" name="password_confirmation" class="inp">
  <button class="btn mt-5"><i class="bi bi-floppy-fill"></i> Simpan Pengaturan</button>
</form>
@endsection
