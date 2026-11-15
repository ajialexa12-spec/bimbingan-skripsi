@props(['add','edit'])
<div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4" @keydown.escape.window="open=false">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 max-h-[90vh] overflow-y-auto" @click.outside="open=false">
    <div class="flex justify-between items-center mb-2"><h3 class="font-bold text-lg" x-text="editing?'{{ $edit }}':'{{ $add }}'"></h3><button type="button" @click="open=false" class="text-xl">&times;</button></div>
    <form :action="action" method="POST">@csrf
      <template x-if="editing"><input type="hidden" name="_method" value="PUT"></template>
      {{ $slot }}
      <div class="flex justify-end gap-2 mt-6">
        <button type="button" @click="open=false" class="px-4 py-2 text-sm font-semibold rounded-md bg-slate-200">Batal</button>
        <button class="btn"><i class="bi bi-floppy-fill"></i> Simpan Data</button>
      </div>
    </form>
  </div>
</div>
<style>[x-cloak]{display:none!important}</style>
