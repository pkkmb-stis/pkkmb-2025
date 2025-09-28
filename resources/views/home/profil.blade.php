<x-home-layout menu="Profil_Saya" title="Profil Saya">
    <div class="w-full px-8 pb-4 pt-24 sm:px-16 md:px-20 md:pt-28 lg:pt-32 xl:px-16">
        <div class="flex h-full w-full flex-row items-end justify-center gap-4 translate-y-[-10px]">
            <img src="{{ asset('img/maskot/2025/maskot 5.png') }}" alt="wave" class="z-10 w-36 sm:w-48 -translate-x-4 transform translate-y-[-10px]">
            <div class="flex h-full flex-col items-center justify-center">
                <div class="flex flex-row items-center justify-center gap-4 mt-14 transform translate-y-[-10px]">
                    <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}"
                        alt="Elemen 4" class="w-24 sm:w-28 -mr-28 z-10 -mt-8">
                    <h1
                        class="flex items-center justify-center rounded-full px-10 py-3 sm:px-16 lg:py-4 lg:pb-6
                            font-brasikaDisplay text-center text-sm font-thin leading-normal
                            drop-shadow-md sm:text-2xl lg:text-3xl xl:text-4xl z-0 relative border-4"
                        style="color:#1E2A4A; background-color:#FFF3E6; border-color:#1E2A4A;">
                        PROFIL SAYA
                    </h1>
                    <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}"
                        alt="Elemen 4" class="w-24 sm:w-28 -ml-28 z-10 -mt-8 scale-x-[-1]">
                </div>
            </div>
            <img src="{{ asset('img/maskot/2025/maskot 2.png') }}" alt="wave" class="z-10 w-32 sm:w-40 translate-x-4 transform translate-y-[-10px]">
        </div>
    </div>

    <div class="my-8 w-full">
        <x-card class="mx-auto w-full rounded-3xl bg-opacity-40 py-8 shadow-none sm:px-2 md:p-10 lg:w-[98%]">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto_1fr] gap-0 relative" x-data="{ menuActive: '{{ $menu }}' }">
                
                <div class="col-span-1 rounded-t-xl lg:rounded-l-xl lg:rounded-tr-none pt-6 bg-profil-left shadow-xl order-1 relative z-10">
                    <livewire:home.profil.info />
                </div>

                <div class="hidden lg:block w-16 xl:w-20 relative order-2" style="background-image: url('{{ asset('img/pattern/2025/Pattern profil.png') }}'); background-size: cover; background-position: center; background-repeat: repeat-y;">
                </div>

                <div class="col-span-1 bg-putih-400/70 p-4 sm:p-6 shadow-xl rounded-b-xl lg:rounded-r-xl lg:rounded-bl-none order-3 relative z-10">
                   
                    <div class="mb-5 flex flex-col sm:flex-row justify-center font-bachelor text-[0.65rem] font-normal sm:text-sm gap-0">
                        <div class="flex w-full sm:w-auto">
                            <div class="cursor-pointer flex-1 sm:flex-none rounded-l-xl border-4 border-merah-1 px-3 sm:px-4 py-1 text-center shadow-md transition-all"
                                x-on:click="menuActive = 'edit'"
                                x-bind:class="menuActive == 'edit' ? 'text-white bg-merah-1' : 'text-merah-1 hover:text-merah-2 transition'">
                                Edit Profil
                            </div>

                            @if (auth()->user()->is_maba || auth()->user()->hasRole(ROLE_PANITIA))
                                <div class="{{ auth()->user()->is_maba ? '' : 'rounded-r-xl' }} cursor-pointer flex-1 sm:flex-none border-4 border-merah-1 px-3 sm:px-4 py-1 text-center shadow-md transition-all"
                                    x-on:click="menuActive = 'poin'"
                                    x-bind:class="menuActive == 'poin' ? 'bg-merah-1 text-white' : 'text-merah-1 hover:text-merah-2 transition'">
                                    Daftar Poin
                                </div>
                            @endif

                            @if (auth()->user()->is_maba)
                                <div class="cursor-pointer flex-1 sm:flex-none rounded-r-xl border-4 border-merah-1 px-3 sm:px-4 py-1 text-center shadow-md transition-all"
                                    x-on:click="menuActive = 'nilai'"
                                    x-bind:class="menuActive == 'nilai' ? 'bg-merah-1 text-white' : 'text-merah-1 hover:text-merah-2 transition'">
                                    Nilai
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 divide-y-2 lg:divide-y-0 lg:divide-x-2"
                        x-show="menuActive == 'edit'">
                        <div class="pb-5 lg:pb-0 lg:pr-4">
                            <livewire:home.profil.edit />
                        </div>
                        <div class="pt-5 lg:pt-0 lg:pl-4">
                            <livewire:home.profil.password />
                        </div>
                    </div>

                    @if (auth()->user()->is_maba || auth()->user()->hasRole(ROLE_PANITIA))
                        <div class="divide-y-2" x-show="menuActive == 'poin'">
                            <livewire:home.profil.poin />
                        </div>
                    @endif

                    @if (auth()->user()->is_maba)
                        <div class="w-full" x-show="menuActive == 'nilai'">
                            @include('home.profil.nilai')
                        </div>
                    @endif
                </div>
            </div>
        </x-card>
    </div>

    @push('float')
        @livewire('home.dashboard.materi')
        @include('home.dashboard.penugasan')
    @endpush
</x-home-layout>
