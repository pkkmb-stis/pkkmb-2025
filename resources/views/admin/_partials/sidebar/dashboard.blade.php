<x-sidebar>
    <x-sidebar.body>
        <x-sidebar.menu active="{{ $menu == 'Dashboard' }}" icon="fa-solid fa-tachometer-alt"
            href="{{ route('dashboard') }}">
            Dashboard
        </x-sidebar.menu>
    </x-sidebar.body>
</x-sidebar>
