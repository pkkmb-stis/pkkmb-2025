<x-admin-layout menu="Nilai" title="Input Nilai">
    @if($halaman == "utama")
    
    @livewire('admin.maba.nilai.show')
    @endif

    @if ($halaman == "detail")
    @livewire('admin.maba.nilai.detail', ['user' => $user->id])
    @endif
</x-admin-layout>
