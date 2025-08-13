<x-sidebar>
    <x-sidebar.head>
        Maba
    </x-sidebar.head>

    <x-sidebar.body>
        @can(PERMISSION_SHOW_USER)
            <x-sidebar.menu active="{{ $menu == 'User' }}" icon="fas fa-users" href="{{ route('user.show') }}">
                User
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_EVENT)
            <x-sidebar.menu active="{{ $menu == 'Absensi' }}" icon="fas fa-user-check" href="{{ route('absensi') }}">
                Presensi
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_NILAI)
            <x-sidebar.menu active="{{ $menu == 'Nilai' }}" icon="fas fa-list-ol" href="{{ route('input-nilai') }}">
                Input Nilai
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_POIN)
            <x-sidebar.menu active="{{ $menu == 'Poin' }}" icon="fas fa-gavel" href="{{ route('poin.table') }}">
                Input Poin
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_POIN)
            <x-sidebar.menu active="{{ $menu == 'Poin User' }}" icon="fas fa-user-pen" href="{{ route('poin.user') }}">
                Poin User
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_POIN_KELOMPOK)
            <x-sidebar.menu active="{{ $menu == 'Poin Kelompok' }}" icon="fas fa-scale-balanced"
                href="{{ route('poin.poin-kelompok') }}">
                Poin Kelompok
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_KENDALA)
            <x-sidebar.menu active="{{ $menu == 'Pengaduan' }}" icon="fas fa-exclamation-triangle"
                href="{{ route('kendala') }}" id="pengaduan">
                Pengaduan
            </x-sidebar.menu>
        @endcan


    </x-sidebar.body>

</x-sidebar>
