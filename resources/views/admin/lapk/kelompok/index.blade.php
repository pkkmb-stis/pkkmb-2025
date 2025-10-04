<x-admin-layout menu="Atur Kelompok" title="Kelompok PKKMB 2025">
    @if ($halaman == "utama")
    <!-- <div class="flex items-center justify-between mb-3">
        <h5 class="text-lg font-medium text-gray-600">Daftar Kelompok</h5>
        @can(PERMISSION_ADD_KELOMPOK)
        @livewire('admin.lapk.kelompok.add')
        @endcan
    </div-->
    @livewire('admin.lapk.kelompok.show')
    @endif

    @if ($halaman == "detail")
    @livewire('admin.lapk.kelompok.detail', ['kelompok' => $kelompok])
    @endif
</x-admin-layout>
