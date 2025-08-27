<x-sidebar>
    <x-sidebar.head>
        Maba
    </x-sidebar.head>

    <x-sidebar.body>
        @can(PERMISSION_SHOW_USER)
            <x-sidebar.menu active="{{ $menu == 'User' }}" icon="fa-solid fa-users" href="{{ route('user.show') }}">
                User
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_EVENT)
            <x-sidebar.menu active="{{ $menu == 'Absensi' }}" icon="fa-solid fa-user-check" href="{{ route('absensi') }}">
                Presensi
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_NILAI)
            <x-sidebar.menu active="{{ $menu == 'Nilai' }}" icon="fa-solid fa-list-ol" href="{{ route('input-nilai') }}">
                Input Nilai
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_POIN)
            <x-sidebar.menu active="{{ $menu == 'Poin' }}" icon="fa-solid fa-gavel" href="{{ route('poin.table') }}">
                Input Poin
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_POIN)
            <x-sidebar.menu active="{{ $menu == 'Poin User' }}" icon="fa-solid fa-user-pen" href="{{ route('poin.user') }}">
                Poin User
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_POIN_KELOMPOK)
            <x-sidebar.menu active="{{ $menu == 'Poin Kelompok' }}" icon="fa-solid fa-scale-balanced"
                href="{{ route('poin.poin-kelompok') }}">
                Poin Kelompok
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_KENDALA)
            <x-sidebar.menu active="{{ $menu == 'Pengaduan' }}" icon="fa-solid fa-exclamation-triangle"
                href="{{ route('kendala') }}" id="pengaduan">
                Pengaduan
            </x-sidebar.menu>
        @endcan


    </x-sidebar.body>

</x-sidebar>
