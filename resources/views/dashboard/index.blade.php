@extends('layouts.app')
@section('title','Dashboard Admin')
@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var labels = {{ \Illuminate\Support\Js::from($labels) }};
  var data = {{ \Illuminate\Support\Js::from($data) }};
  var max = Math.max.apply(null, data.concat([10]));
  new Chart(document.getElementById('grafik'), {
    type: 'bar',
    data: { labels: labels, datasets: [{ data: data, backgroundColor: '#2563eb', borderRadius: 2, barPercentage: 0.45 }] },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true, suggestedMax: Math.ceil(max / 10) * 10, ticks: { precision: 0, stepSize: 10 }, grid: { color: '#eef2f7' } }, x: { grid: { display: false } } } }
  });
});
</script>
@endpush
@section('content')
<h1 class="text-2xl font-bold">Dashboard Admin</h1>
<p class="text-sm text-slate-600 mb-5">Selamat datang Aji Alexa, {{ auth()->user()->name }}! 👋</p>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">
@foreach($stats as $s)
  <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4">
    <i class="bi {{ $s['icon'] }} text-2xl {{ $s['color'] }}"></i>
    <div class="text-2xl lg:text-3xl font-bold mt-1 leading-none">{{ $s['value'] }}</div>
    <div class="text-sm text-slate-700 mt-1">{{ $s['label'] }}</div>
    <div class="text-xs font-semibold mt-2 {{ $s['trend']>=0?'text-green-600':'text-red-500' }}"><i class="bi {{ $s['trend']>=0?'bi-arrow-up':'bi-arrow-down' }}"></i> {{ $s['trend']>=0?'+':'' }}{{ $s['trend'] }}%</div>
  </div>
@endforeach
</div>

<div class="grid lg:grid-cols-5 gap-4 mt-4">
  <div class="lg:col-span-3 bg-white rounded-lg border border-slate-200 shadow-sm p-5">
    <h3 class="font-bold text-sm mb-3">Grafik Aktivitas Bimbingan</h3>
    <div class="relative h-64"><canvas id="grafik"></canvas></div>
  </div>
  <div class="lg:col-span-2 bg-white rounded-lg border border-slate-200 shadow-sm p-5">
    <h3 class="font-bold text-sm mb-2">Bimbingan Terbaru</h3>
    @forelse($terbaru as $b)
      <div class="flex items-center justify-between gap-3 py-3 border-b border-slate-100 last:border-0">
        <div class="flex items-center gap-3 min-w-0">
          <span class="w-8 h-8 shrink-0 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm"><i class="bi bi-person-fill"></i></span>
          <div class="min-w-0"><div class="text-sm font-semibold truncate">{{ $b->mahasiswa->nama }} – {{ $b->topik }}</div>
          <div class="text-xs text-slate-500">{{ $b->tanggal->isToday() ? 'Hari ini' : ($b->tanggal->isYesterday() ? 'Kemarin' : $b->tanggal->translatedFormat('d M Y')) }}, {{ substr($b->jam ?? '00:00',0,5) }}</div></div>
        </div>
        <x-badge :status="$b->status"/>
      </div>
    @empty
      <p class="text-sm text-slate-500 py-4">Belum ada bimbingan.</p>
    @endforelse
  </div>
</div>
@endsection
