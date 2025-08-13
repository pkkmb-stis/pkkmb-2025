@include('admin._partials.sidebar.dashboard')

@can(PERMISSION_AKSES_MENU_ADMINISTRATOR)
    @include('admin._partials.sidebar.administrator')
@endcan

@can(PERMISSION_AKSES_MENU_LAPK)
    @include('admin._partials.sidebar.lapk')
@endcan

@can(PERMISSION_AKSES_MENU_TIBUM)
    @include('admin._partials.sidebar.tibum')
@endcan

@can(PERMISSION_AKSES_MENU_MABA)
    @include('admin._partials.sidebar.maba')
@endcan

@can(PERMISSION_AKSES_MENU_INFORMASI)
    @include('admin._partials.sidebar.informasi')
@endcan

@can(PERMISSION_SHOW_LAPORAN_KEGIATAN)
    @include('admin._partials.sidebar.pengawas')
@endcan
