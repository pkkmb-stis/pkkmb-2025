<x-admin-layout menu="{{ $menu }}" title="User Detail">

    @if ($halaman == "detail")
    <div class="divide-y-2">
        <div class="grid xl:grid-cols-12 grid-cols-1 gap-4 pb-7">
            <div class="xl:col-span-5 col-span-1">
                @include('admin.maba.user.detail.description')
            </div>
            <div class="xl:col-span-7 col-span-1">
                @livewire('admin.maba.user.detail.edit', ['user' => $user])
            </div>
        </div>

        @if ($user->is_maba || $user->hasRole(ROLE_PANITIA))
        <div class="py-7">
            @livewire('admin.maba.user.detail.list-presensi',['user' => $user])
        </div>

        <div class="py-7">
            @livewire('admin.maba.user.detail.list-kendala',['user' => $user])
        </div>
        @endif

        @if ($user->is_maba)
        <div class="py-7">
            @livewire('admin.maba.user.detail.nilai',['user' => $user])
        </div>
        @endif


        @if ($user->getPermissionNames()->contains(PERMISSION_AKSES_ADMIN) &&
        auth()->user()->can(PERMISSION_UPDATE_AKSES_ADMIN))
        <div class="pt-7">
            <div class="grid sm:grid-cols-2 sm:gap-6 gap-y-6 mb-8">
                @livewire('admin.maba.user.detail.role', ['user' => $user])
                @livewire('admin.maba.user.detail.permission', ['user' => $user])
            </div>
        </div>
        @endif

    </div>

    @elseif ($halaman == "poin")
    @livewire('admin.maba.user.detail.poin', ['idUser' => $idUser])
    @endif

</x-admin-layout>
