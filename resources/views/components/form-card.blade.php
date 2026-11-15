@props(['title','action','back','edit'=>false])
<div class="max-w-2xl">
  <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>
  <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm p-6">@csrf
    @if($edit) @method('PUT') @endif
    {{ $slot }}
    <div class="flex justify-end gap-2 mt-8 pt-4 border-t">
      <a href="{{ $back }}" class="px-4 py-2 text-sm font-semibold rounded-md bg-slate-200 hover:bg-slate-300">Batal</a>
      <button class="btn"><i class="bi bi-floppy-fill"></i> Simpan Data</button>
    </div>
  </form>
</div>
