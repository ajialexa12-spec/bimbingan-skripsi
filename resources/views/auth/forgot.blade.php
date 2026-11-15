<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Lupa Password</title>
<script src="https://cdn.tailwindcss.com"></script></head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4">
<form method="POST" action="{{ route('password.update') }}" class="bg-white rounded-xl shadow-lg w-full max-w-sm p-8 space-y-3">@csrf
  <h1 class="text-xl font-bold text-blue-900">Reset Password</h1>
  @if($errors->any())<div class="rounded bg-red-50 text-red-700 text-sm px-3 py-2">{{ $errors->first() }}</div>@endif
  <input name="email" type="email" value="{{ old('email') }}" placeholder="Email akun" class="w-full border rounded-md px-3 py-2 text-sm" required>
  <input name="password" type="password" placeholder="Password baru" class="w-full border rounded-md px-3 py-2 text-sm" required>
  <input name="password_confirmation" type="password" placeholder="Ulangi password baru" class="w-full border rounded-md px-3 py-2 text-sm" required>
  <button class="w-full bg-blue-700 text-white font-semibold rounded-md py-2.5">Ubah Password</button>
  <a href="{{ route('login') }}" class="block text-center text-sm text-blue-600">Kembali ke Login</a>
</form></body></html>
