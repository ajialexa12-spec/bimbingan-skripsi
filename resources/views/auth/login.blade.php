<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login - BimbingSkripsi</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4" style="font-family:Inter,sans-serif">
<div class="bg-white rounded-xl shadow-lg w-full max-w-3xl grid md:grid-cols-2 overflow-hidden">
  <div class="bg-gradient-to-br from-sky-100 to-blue-100 p-8 flex flex-col justify-between">
    <div><h1 class="text-2xl font-bold text-slate-800 leading-tight">Sistem Informasi<br>Bimbingan Skripsi</h1>
    <p class="mt-3 text-sm text-slate-600">Kelola proses bimbingan skripsi secara digital, mudah dan terintegrasi.</p></div>
    <div class="text-center text-blue-700 mt-6"><i class="bi bi-mortarboard-fill" style="font-size:96px"></i></div>
  </div>
  <div class="p-8" x-data="{show:false}">
    <div class="text-center mb-5"><i class="bi bi-mortarboard-fill text-3xl text-blue-700"></i><div class="text-xl font-bold text-blue-900">BimbingSkripsi</div></div>
    @if(session('success'))<div class="mb-3 rounded bg-green-50 text-green-700 text-sm px-3 py-2">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="mb-3 rounded bg-red-50 text-red-700 text-sm px-3 py-2">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('login') }}">@csrf
      <label class="text-sm font-semibold">Email atau NIM</label>
      <div class="flex items-center border rounded-md px-3 mt-1 mb-3"><i class="bi bi-envelope text-slate-400"></i><input name="login" value="{{ old('login') }}" placeholder="Masukkan email atau NIM" class="w-full py-2 px-2 text-sm outline-none" required></div>
      <label class="text-sm font-semibold">Password</label>
      <div class="flex items-center border rounded-md px-3 mt-1 mb-3"><i class="bi bi-lock text-slate-400"></i><input :type="show?'text':'password'" name="password" placeholder="Masukkan password" class="w-full py-2 px-2 text-sm outline-none" required><button type="button" @click="show=!show" class="text-slate-400"><i class="bi" :class="show?'bi-eye-slash':'bi-eye'"></i></button></div>
      <label class="flex items-center gap-2 text-sm mb-4"><input type="checkbox" name="remember"> Ingat saya</label>
      <button class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-md py-2.5"><i class="bi bi-arrow-right"></i> Login</button>
      <div class="text-center mt-3"><a href="{{ route('password.request') }}" class="text-sm text-blue-600">Lupa Password?</a></div>
    </form>
  </div>
</div></body></html>
