<div class="flex justify-between px-5 py-2 md:hidden">
    {{-- Tombol Munculkan Navbar HP --}}
    <div class="container-badge burger-container">
        <button
            class="text-xl leading-none bg-transparent border border-transparent border-solid rounded opacity-50 cursor-pointer text-putih-100"
            type="button" x-on:click="openSidebar = !openSidebar">
            <i x-show="!openSidebar" class="fa-solid fa-bars"></i>
            <i x-show="openSidebar" class="fa-solid fa-times"></i>

        </button>
        @can(PERMISSION_SHOW_KENDALA)
            <span class="animate-pulse">@livewire('admin.maba.kendala.pengaduan-badge')</span>
        @endcan
    </div>

    {{-- Dropdown Foto di HP --}}
    <ul class="z-50 flex flex-wrap items-center list-none">
        <li class="relative inline-block">
            @include('admin._partials.dropdown')
        </li>
    </ul>
</div>

{{-- Brand Tampilan Laptop --}}
<a class="items-center justify-center hidden h-full py-3 overflow-hidden text-sm font-bold uppercase whitespace-nowrap md:flex"
    href="{{ route('home.index') }}">
    <img src="{{ LOGO }}" alt="Logo" width="40" height="40" class="rounded-full">
    <span class="ml-2 text-base font-normal text-white font-aringgo">PKKMB-PKBN 2025</span>
</a>
