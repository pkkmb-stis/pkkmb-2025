<!-- Navbar -->
<nav
    class="fixed top-0 left-0 right-0 z-20 px-4 py-2 mx-3 my-2 transition-all duration-500 shadow-xl rounded-2xl bg-2025-5 bg-opacity-80 backdrop-blur-lg backdrop-filter sm:mx-4 sm:my-2 sm:px-8 md:mx-4 md:my-2 md:px-12 lg:mx-4 lg:my-2 lg:px-16 xl:mx-4 xl:my-2 xl:px-24">
    <div class="flex items-center justify-between gap-4 font-semibold text-2025-1">

        {{-- Menu HP --}}
        <div class="block lg:hidden" x-data="{ showMenuHp: false }">
            <i class="text-xl transition cursor-pointer fa fa-bars hover:text-2025-2" aria-hidden="true"
                x-on:click="showMenuHp = true"></i>
            <div x-cloak
                class="fixed top-0 left-0 z-40 flex h-screen mb-2 transition-all duration-300 ease rounded-2xl bg-2025-1 bg-opacity-95 lg:hidden"
                x-show="showMenuHp" x-on:click.away="showMenuHp = false" x-transition:enter-start="-left-72"
                x-transition:enter-end="left-0" x-transition:leave-start="left-0" x-transition:leave-end="-left-72">

                <div class="flex flex-col pt-5 font-aringgo text-base-white">
                    <span class="absolute right-0 pr-4 cursor-pointer" @click="showMenuHp = false">
                        <i class="text-lg fa-solid fa-close"></i>
                    </span>
                    <a class="px-10 mb-4 text-center" href="{{ route('home.index') }}">
                        <img src="{{ LOGO }}" alt="LOGO" class="w-20 mx-auto" />
                        <span class="font-bold font-brasikaDisplay">PKKMB-PKBN 2025</span>
                    </a>

                    @auth
                        <a href="{{ route('home.dashboard') }}"
                            class="{{ $menu == 'Dashboard' ? 'bg-2025-1 text-2025-5' : '' }} mt-3 px-10 py-2 text-center text-lg font-light transition hover:bg-2025-1 hover:text-2025-5">Dashboard</a>

                        <a href="{{ route('home.profil') }}"
                            class="{{ $menu == 'Profil_Saya' ? 'bg-2025-1 text-2025-5' : '' }} mt-3 px-10 py-2 text-center text-lg font-light transition hover:bg-2025-1 hover:text-2025-5">Profil
                            Saya</a>
                    @endauth

                    <a href="{{ route('home.timeline') }}"
                        class="{{ $menu == 'Timeline' ? 'bg-2025-1 text-2025-5' : '' }} mt-3 px-10 py-2 text-center text-lg font-light transition hover:bg-2025-1 hover:text-2025-5">
                        <i class="mr-2 fa-regular fa-clock"></i>
                        Timeline</a>
                    <a href="{{ route('home.galeri') }}"
                        class="{{ $menu == 'Galeri' ? 'bg-2025-1 text-2025-5' : '' }} mt-3 px-10 py-2 text-center text-lg font-light transition hover:bg-2025-1 hover:text-2025-5">
                        <i class="mr-2 fa-solid fa-image"></i>
                        Galeri</a>
                    <a href="{{ route('home.ppo') }}"
                        class="{{ $menu == 'Panitia' ? 'bg-2025-1 text-2025-5' : '' }} mt-3 px-10 py-2 text-center text-lg font-light transition hover:bg-2025-1 hover:text-2025-5">
                        <i class="mr-2 fa-solid fa-address-card"></i>
                        Panitia</a>
                    <a href="{{ route('home.tentang') }}"
                        class="{{ $menu == 'Tentang' ? 'bg-2025-1 text-2025-5' : '' }} mt-3 px-10 py-2 text-center text-lg font-light transition hover:bg-2025-1 hover:text-2025-5">
                        <i class="mr-2 fa-solid fa-circle-info"></i>
                        Tentang</a>
                </div>
            </div>
        </div>
        {{-- End Menu HP --}}

        {{-- Menu Desktop --}}
        <a href="{{ route('home.index') }}" class="flex items-center">
            <img src="{{ LOGO }}" alt="LOGO" class="hidden w-10 mr-2 lg:inline-block" />
            <span
                class="gap-2 text-sm font-bold leading-none font-brasikaDisplay hover:text-2025-2 lg:flex lg:flex-col lg:items-start lg:justify-start">
                <span>PKKMB-PKBN</span>
                <span>2025</span>
            </span>
        </a>

        <ul class="items-center hidden font-semibold font-brasikaDisplay lg:flex">
            @auth
                <li class="mx-8">
                    <a href="{{ route('home.dashboard') }}"
                        class="{{ $menu == 'Dashboard' ? 'shadow-lg text-2025-1' : 'hover:text-2025-1 active:text-2025-1' }} 
                            relative z-0 inline-block rounded-xl px-4 py-2 transition-all duration-300 group hover:shadow-lg active:shadow-lg">
                        
                        <span class="absolute inset-0 z-[-1] rounded-xl 
                                    bg-[linear-gradient(to_right,#FEF2DE,#FBE2B8,#FEF2DE)] 
                                    transition-transform duration-300 ease-in-out 
                                    group-hover:scale-x-100 group-active:scale-x-100 
                                    {{ $menu == 'Dashboard' ? 'scale-x-100' : 'scale-x-0' }}"></span>
                        
                        <span>Dashboard</span>
                    </a>
                </li>
            @endauth

            <li class="mx-8">
                <a href="{{ route('home.timeline') }}"
                    class="{{ $menu == 'Timeline' ? 'shadow-lg text-2025-1' : 'hover:text-2025-1 active:text-2025-1' }} 
                        relative z-0 inline-block rounded-xl px-4 py-2 transition-all duration-300 group hover:shadow-lg active:shadow-lg">
                    
                    <span class="absolute inset-0 z-[-1] rounded-xl 
                                bg-[linear-gradient(to_right,#FEF2DE,#FBE2B8,#FEF2DE)] 
                                transition-transform duration-300 ease-in-out 
                                group-hover:scale-x-100 group-active:scale-x-100 
                                {{ $menu == 'Timeline' ? 'scale-x-100' : 'scale-x-0' }}"></span>
                    
                    <span>Timeline</span>
                </a>
            </li>
            <li class="mx-8">
                <a href="{{ route('home.galeri') }}"
                    class="{{ $menu == 'Galeri' ? 'shadow-lg text-2025-1' : 'hover:text-2025-1 active:text-2025-1' }} 
                        relative z-0 inline-block rounded-xl px-4 py-2 transition-all duration-300 group hover:shadow-lg active:shadow-lg">
                    
                    <span class="absolute inset-0 z-[-1] rounded-xl 
                                bg-[linear-gradient(to_right,#FEF2DE,#FBE2B8,#FEF2DE)] 
                                transition-transform duration-300 ease-in-out 
                                group-hover:scale-x-100 group-active:scale-x-100 
                                {{ $menu == 'Galeri' ? 'scale-x-100' : 'scale-x-0' }}"></span>
                    
                    <span>Galeri</span>
                </a>
            </li>
            <li class="mx-8">
                <a href="{{ route('home.ppo') }}"
                    class="{{ $menu == 'Panitia' ? 'shadow-lg text-2025-1' : 'hover:text-2025-1 active:text-2025-1' }} 
                        relative z-0 inline-block rounded-xl px-4 py-2 transition-all duration-300 group hover:shadow-lg active:shadow-lg">
                    
                    <span class="absolute inset-0 z-[-1] rounded-xl 
                                bg-[linear-gradient(to_right,#FEF2DE,#FBE2B8,#FEF2DE)] 
                                transition-transform duration-300 ease-in-out 
                                group-hover:scale-x-100 group-active:scale-x-100 
                                {{ $menu == 'Panitia' ? 'scale-x-100' : 'scale-x-0' }}"></span>
                    
                    <span>Panitia</span>
                </a>
            </li>
            <li class="mx-8">
                <a href="{{ route('home.tentang') }}"
                    class="{{ $menu == 'Tentang' ? 'shadow-lg text-2025-1' : 'hover:text-2025-1 active:text-2025-1' }} 
                        relative z-0 inline-block rounded-xl px-4 py-2 transition-all duration-300 group hover:shadow-lg active:shadow-lg">
                    
                    <span class="absolute inset-0 z-[-1] rounded-xl 
                                bg-[linear-gradient(to_right,#FEF2DE,#FBE2B8,#FEF2DE)] 
                                transition-transform duration-300 ease-in-out 
                                group-hover:scale-x-100 group-active:scale-x-100 
                                {{ $menu == 'Tentang' ? 'scale-x-100' : 'scale-x-0' }}"></span>
                    
                    <span>Tentang</span>
                </a>
            </li>
        </ul>

        <div class="flex items-center">
            @auth
                <div x-data="{ dropDownOpen: false }" class="relative">
                    <div class="container-badge icon-container">
                        <livewire:home.profil.foto />

                        @can(PERMISSION_SHOW_KENDALA)
                            <span class="animate-pulse">@livewire('admin.maba.kendala.pengaduan-badge')</span>
                        @endcan
                    </div>
                    <div x-cloak x-show="dropDownOpen" x-on:click.away="dropDownOpen = false"
                        class="absolute right-0 pb-2 rounded-md shadow-lg top-12 whitespace-nowrap bg-gray-50 text-coklat-1">

                        <div class="divide-y">
                            <div class="px-3 py-2 pt-3 text-center cursor-not-allowed">
                                <p class="text-sm">{{ auth()->user()->name }}</p>
                                @if (auth()->user()->is_maba)
                                    <small class="italic">{{ auth()->user()->nama_statistik }} |
                                        {{ auth()->user()->username }}</small>
                                @endif
                            </div>

                            <a class="block px-12 py-2 font-bold text-center transition text-md hover:bg-2025-2 hover:text-base-white"
                                href="{{ route('home.profil') }}">Profil Saya</a>

                            @can(PERMISSION_AKSES_ADMIN)
                                <a class="flex items-center justify-between px-12 py-2 font-bold text-center transition text-md hover:bg-2025-2 hover:text-base-white"
                                    href="{{ route('dashboard') }}">
                                    <!-- Teks Halaman Admin -->
                                    <span>Halaman Admin</span>

                                    <!-- Badge Pengaduan -->
                                    @can(PERMISSION_SHOW_KENDALA)
                                        <div class="container-badge adminBadge-container">
                                            @livewire('admin.maba.kendala.pengaduan-badge')
                                        </div>
                                    @endcan
                                </a>
                            @endcan


                            <form action="{{ route('logout') }}" method="post" class="p-0 m-0">
                                @csrf
                                <button type="submit"
                                    class="w-full px-12 py-2 font-bold text-center transition border-b text-md hover:bg-2025-2 hover:text-base-white">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a class="px-5 py-1 font-bold font-poppins transition border-2 rounded-full border-2025-1 bg-2025-1 font-poppins text-base-white hover:bg-white hover:text-2025-1" 
                    href="{{ route('login') }}">
                    Masuk
                </a>
            @endauth
        </div>
        {{-- End Menu Desktop --}}
    </div>
</nav>
<!-- end Navbar -->
