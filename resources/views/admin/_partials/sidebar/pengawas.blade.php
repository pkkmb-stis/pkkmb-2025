<x-sidebar>
    <x-sidebar.head>
        Pengawas
    </x-sidebar.head>

    <x-sidebar.body>
        
        @can(PERMISSION_SHOW_LAPORAN_KEGIATAN)
        <x-sidebar.menu active="{{ $menu == 'Laporan Kegiatan' }}" icon="fa-solid fa-exclamation-triangle"
            href="{{ route('laporankegiatan') }}">
            Laporan Kegiatan
        </x-sidebar.menu>
        @endcan

    </x-sidebar.body>

</x-sidebar>
