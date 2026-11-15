@props(['status','kind'=>'bim'])
@php
 $map = $kind==='mhs' ? ['Aktif'=>'bg-green-100 text-green-700','Selesai'=>'bg-blue-100 text-blue-700']
      : ['Selesai'=>'bg-green-100 text-green-700','Proses'=>'bg-yellow-100 text-yellow-700','Menunggu'=>'bg-blue-100 text-blue-700'];
@endphp
<span class="px-2.5 py-0.5 rounded text-xs font-semibold {{ $map[$status] ?? 'bg-slate-100 text-slate-600' }}">{{ $status }}</span>
