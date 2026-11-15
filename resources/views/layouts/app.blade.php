<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title') - BimbingSkripsi</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>tailwind.config={theme:{extend:{colors:{navy:'#1b3a6b',brand:'#1e5bc6'},fontFamily:{sans:['Inter','Segoe UI','sans-serif']}}}}</script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
<style type="text/tailwindcss">
  .inp{ @apply w-full border border-slate-300 rounded-md px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand; }
  .lbl{ @apply block text-sm font-semibold text-slate-700 mb-1 mt-3; }
  .btn{ @apply inline-flex items-center gap-2 bg-brand hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-md; }
  .th{ @apply px-4 py-3 text-left font-semibold text-slate-700 text-sm; } .td{ @apply px-4 py-3 text-sm text-slate-700; }
</style>
@stack('head')
</head>
<body class="bg-slate-100 font-sans text-slate-800">
@php
 $menu=[['dashboard','Dashboard','bi-house-door-fill','dashboard'],['mahasiswa.index','Mahasiswa','bi-people-fill','mahasiswa*'],['dosen.index','Dosen','bi-person-badge-fill','dosen*'],['skripsi.index','Skripsi','bi-file-earmark-text-fill','skripsi*'],['jadwal.index','Jadwal Bimbingan','bi-calendar-event','jadwal*'],['riwayat.index','Riwayat Bimbingan','bi-clock-history','riwayat*'],['laporan.index','Laporan','bi-file-earmark-bar-graph','laporan*'],['pengaturan.index','Pengaturan','bi-gear-fill','pengaturan*']];
@endphp
<div class="flex min-h-screen" x-data="{side:false}">
  <aside class="fixed lg:static inset-y-0 left-0 z-30 w-60 bg-navy text-white flex flex-col transform transition lg:translate-x-0" :class="side?'translate-x-0':'-translate-x-full'">
    <div class="flex items-center gap-2 px-5 py-5 font-bold"><i class="bi bi-mortarboard-fill text-2xl"></i> BimbingSkripsi</div>
    <nav class="flex-1 px-3 space-y-1">
      @foreach($menu as [$rt,$lb,$ic,$pat])
        <a href="{{ route($rt) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm {{ request()->routeIs($pat)?'bg-brand font-semibold':'text-slate-200 hover:bg-white/10' }}"><i class="bi {{ $ic }}"></i>{{ $lb }}</a>
      @endforeach
    </nav>
    <form method="POST" action="{{ route('logout') }}" class="p-3 border-t border-white/10">@csrf
      <button class="flex items-center gap-3 px-3 py-2.5 text-sm w-full text-slate-200 hover:bg-white/10 rounded-md"><i class="bi bi-box-arrow-left"></i>Logout</button>
    </form>
  </aside>
  <div class="flex-1 min-w-0">
    <header class="bg-white h-14 flex items-center justify-between px-5 shadow-sm">
      <button class="text-xl lg:hidden" @click="side=!side"><i class="bi bi-list"></i></button><span class="hidden lg:block text-xl"><i class="bi bi-list"></i></span>
      <div class="flex items-center gap-5">
        <span class="relative text-slate-600"><i class="bi bi-bell-fill"></i><span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span></span>
        <div class="flex items-center gap-2 text-sm font-semibold"><span class="w-8 h-8 rounded-full bg-slate-300 flex items-center justify-center"><i class="bi bi-person-fill"></i></span>{{ auth()->user()->name === 'Administrator' ? 'Admin' : auth()->user()->name }}<i class="bi bi-chevron-down text-xs"></i></div>
      </div>
    </header>
    <main class="p-6">
      @hasSection('breadcrumb')<div class="text-xs text-slate-500 mb-3">@yield('breadcrumb')</div>@endif
      @if(session('success'))<div class="mb-4 rounded-md bg-green-50 border border-green-200 text-green-700 px-4 py-2 text-sm" x-data x-init="setTimeout(()=>$el.remove(),4000)">{{ session('success') }}</div>@endif
      @if($errors->any())<div class="mb-4 rounded-md bg-red-50 border border-red-200 text-red-700 px-4 py-2 text-sm"><ul class="list-disc pl-4">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
      @yield('content')
    </main>
  </div>
</div>
</body></html>
