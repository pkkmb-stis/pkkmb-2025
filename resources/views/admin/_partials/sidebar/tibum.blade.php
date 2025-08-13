<x-sidebar>
    <x-sidebar.head>
        Tibum
    </x-sidebar.head>

    <x-sidebar.body>
        @can(PERMISSION_SHOW_JENISPOIN)
        <x-sidebar.menu active="{{ $menu == 'Atur Poin' }}" icon="fas fa-th-list" href="{{ route('jenispoin.table')}}">
            Atur Poin
        </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_PENEBUSAN)
        <x-sidebar.menu active="{{ $menu == 'Penebusan' }}" icon="fas fa-pray" href="{{route('penebusan.index')}}">
            Penebusan
        </x-sidebar.menu>
        @endcan

    </x-sidebar.body>


</x-sidebar>
