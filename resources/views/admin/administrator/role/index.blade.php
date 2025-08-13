<x-admin-layout menu="Role" title="Role and Permission Management">
    <div class="grid xl:grid-cols-2 gap-6">
        @if ($detail)
        @livewire('admin.administrator.role.detail', ['role' => $role])
        @else
        @livewire('admin.administrator.role.show')
        @endif

        @livewire('admin.administrator.role.permission')
    </div>
</x-admin-layout>
