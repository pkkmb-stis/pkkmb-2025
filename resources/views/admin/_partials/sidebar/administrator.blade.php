<x-sidebar>
    <x-sidebar.head>
        Administrator
    </x-sidebar.head>

    <x-sidebar.body>
        @can(PERMISSION_SHOW_ADMIN)
        <x-sidebar.menu active="{{ $menu == 'Admin' }}" icon=" fas fa-user-plus" href="{{ route('user.admin') }}">
            Admin
        </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_ROLE)
        <x-sidebar.menu active="{{ $menu == 'Role' }}" icon=" fas fa-user-cog" href="{{ route('user.role') }}">
            Role & Permission
        </x-sidebar.menu>
        @endcan
    </x-sidebar.body>

</x-sidebar>
