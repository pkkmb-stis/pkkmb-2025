<div class="block border-solid md:min-w-full md:hidden">
    <div class="flex items-center justify-between px-5 py-1 my-1 bg-2025-1">
        <!-- Logo Menu HP -->
        <div class="flex items-center justify-center text-sm whitespace-nowrap">
            <a href="{{ route('home.index') }}">
                <img src="{{ LOGO }}" alt="Logo" width="45" height="45" class="rounded-full">
            </a>
            <span class="ml-2 text-gray-100 uppercase text-md font-bohemianSoul">{{ $title }}</span>
        </div>

        <!-- Tombol Tutup Menu Hp -->
        <button type="button"
            class="text-xl leading-none text-gray-100 bg-transparent border border-transparent border-solid rounded opacity-50 cursor-pointer md:hidden"
            x-on:click="openSidebar = false">
            <i class="fa-solid fa-times"></i>
        </button>

    </div>
</div>
