<x-sidebar>
    <x-sidebar.head>
        LAPK
    </x-sidebar.head>

    <x-sidebar.body>
        @can(PERMISSION_SHOW_KELOMPOK)
        <x-sidebar.menu active="{{ $menu == 'Atur Kelompok' }}" icon="fa-solid fa-user-friends"
            href="{{ route('lapk.kelompok') }}">
            Atur Kelompok
        </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_INDIKATOR_PENILAIAN)
        <x-sidebar.menu active="{{ $menu == 'Indikator' }}" icon="fa-solid fa-list-alt" href="{{ route('lapk.indikator') }}">
            Indikator Penilaian
        </x-sidebar.menu>
        @endcan

    </x-sidebar.body>

</x-sidebar>
