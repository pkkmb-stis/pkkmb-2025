<x-sidebar>
    <x-sidebar.head>
        Informasi Umum
    </x-sidebar.head>

    <x-sidebar.body>
        @can(PERMISSION_SHOW_GALLERY)
            <x-sidebar.menu active="{{ $menu == 'Gallery' }}" icon="fa-solid fa-photo-video" href="{{ route('gallery') }}">
                Gallery
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_BERITA)
            <x-sidebar.menu active="{{ $menu == 'Berita Harian' }}" icon=" fa-solid fa-envelope-open-text"
                href="{{ route('berita') }}">
                Berita Harian
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_PENGUMUMAN)
            <x-sidebar.menu active="{{ $menu == 'Pengumuman' }}" icon=" fa-solid fa-bullhorn" href="{{ route('pengumuman') }}">
                Pengumuman
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_TIMELINE)
            <x-sidebar.menu active="{{ $menu == 'Timeline' }}" icon=" fa-solid fa-calendar-check" href="{{ route('timeline') }}">
                Timeline
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_FAQ)
            <x-sidebar.menu active="{{ $menu == 'FAQ' }}" icon=" fa-solid fa-question-circle" href="{{ route('faq') }}">
                FAQ
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_FORMULIR)
            <x-sidebar.menu active="{{ $menu == 'Formulir' }}" icon=" fa-solid fa-file-alt" href="{{ route('formulir') }}">
                Formulir
            </x-sidebar.menu>
        @endcan

        @can(PERMISSION_SHOW_MATERI)
            <x-sidebar.menu active="{{ $menu == 'Materi' }}" icon=" fa-solid fa-book " href="{{ route('materi') }}">
                Materi PKKMB
            </x-sidebar.menu>
        @endcan

    </x-sidebar.body>

</x-sidebar>
