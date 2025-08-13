<div class="flex items-center">
    <span class="flex items-center text-sm">
        <small
            class="mr-3 text-xs lg:text-base md:text-sm sm:text-base text-putih-100 md:text-black">{{ auth()->user()->name }}</small>
        <img alt="Profil" class="object-cover w-12 h-12 rounded-full shadow-lg cursor-pointer" src="{{ $ava }}"
            @click="openDropdown = true" />
    </span>
</div>

<div x-cloak x-show="openDropdown" @click.away="openDropdown = false"
    class="absolute right-0 z-50 py-2 text-base bg-white divide-y rounded shadow-lg text-coklat-1 top-10 max-w-52">
    <a href="{{ route('home.index') }}"
        class="block w-full py-2 font-bold transition px-7 hover:bg-base-brown-400 whitespace-nowrap">Halaman
        Utama</a>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit"
            class="block w-full py-2 font-bold transition px-7 hover:bg-base-brown-400">Logout</button>
    </form>
</div>
