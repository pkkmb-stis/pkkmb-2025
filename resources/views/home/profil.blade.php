<x-home-layout menu="Profil_Saya" title="Profil Saya">
    <div class="w-full px-8 pb-4 pt-24 sm:px-16 md:px-20 md:pt-28 lg:pt-32 xl:px-16">
        <div class="flex h-full w-full flex-row items-end justify-center gap-4">
            <img src="{{ asset('img/maskot/kambe timeline.png') }}" alt="wave" class="z-10 w-24 sm:w-32">
            <div class="grid justify-items-center">
                <img src="{{ asset('img/asset/2024/Elemen 4.png') }}" alt="Elemen 4">
                <h1 class="rounded-lg bg-base-grey-100 px-6 py-2 text-center font-aringgo text-sm font-thin leading-normal text-merah-1 sm:px-12 lg:text-3xl xl:text-4xl"
                    style="filter: drop-shadow(0 0 0.25rem #800000);">
                    PROFIL SAYA
                </h1>
                <img src="{{ asset('img/asset/2024/Elemen 4.png') }}" alt="Elemen 4" class="rotate-180">
            </div>
            <img src="{{ asset('img/maskot/pika timeline.png') }}" alt="wave" class="z-10 w-24 sm:w-32">
        </div>
    </div>
    </div>

    <div class="my-8 w-full">
        <x-card class="mx-auto w-full rounded-3xl bg-opacity-40 py-8 shadow-none sm:px-2 md:p-10 lg:w-[98%]">

            <div class="grid grid-cols-1 gap-0 md:grid-cols-12 md:gap-0" x-data="{ menuActive: '{{ $menu }}' }">

                <div class="col-span-1 rounded-l-xl bg-merah-1/70 pt-6 shadow-xl md:col-span-4 lg:col-span-4">
                    <livewire:home.profil.info />
                </div>

                <div class="col-span-1 bg-putih-400/70 p-6 shadow-xl md:col-span-8 lg:col-span-8">
                    <div class="mb-5 flex justify-center font-bachelor text-[0.65rem] font-normal sm:text-sm">

                        <div class="cursor-pointer rounded-l-xl border-4 border-merah-1 px-4 py-1 text-center shadow-md transition-all"
                            x-on:click="menuActive = 'edit'"
                            x-bind:class="menuActive == 'edit' ? ' text-white bg-merah-1' :
                                'text-merah-1 hover:text-merah-2 transition'">
                            Edit Profil
                        </div>


                        @if (auth()->user()->is_maba ||
                                auth()->user()->hasRole(ROLE_PANITIA))
                            <div class="{{ auth()->user()->is_maba ? '' : 'rounded-r-xl' }} cursor-pointer border-4 border-merah-1 px-4 py-1 text-center shadow-md transition-all"
                                x-on:click="menuActive = 'poin'"
                                x-bind:class="menuActive == 'poin' ? 'bg-merah-1 text-white ' :
                                    'text-merah-1 hover:text-merah-2 transition'">
                                Daftar Poin
                            </div>
                        @endif

                        @if (auth()->user()->is_maba)
                            <div class="cursor-pointer rounded-r-xl border-4 border-merah-1 px-10 py-1 text-center shadow-md transition-all"
                                x-on:click="menuActive = 'nilai'"
                                x-bind:class="menuActive == 'nilai' ? 'bg-merah-1 text-white' :
                                    'text-merah-1 hover:text-merah-2 transition'">
                                Nilai
                            </div>
                        @endif

                    </div>

                    <div class="grid justify-center gap-4 divide-y-2 lg:grid-cols-2"
                        x-bind:class="menuActive == 'edit' || 'hidden'">
                        <div class="pb-5 lg:ml-4">
                            <livewire:home.profil.edit />
                        </div>
                        <div class="lg:ml-4">
                            <livewire:home.profil.password />
                        </div>
                    </div>

                    @if (auth()->user()->is_maba ||
                            auth()->user()->hasRole(ROLE_PANITIA))
                        <div class="divide-y-2" x-bind:class="menuActive == 'poin' || 'hidden'">
                            <livewire:home.profil.poin />
                        </div>
                    @endif

                    @if (auth()->user()->is_maba)
                        <div class="w-full" x-bind:class="menuActive == 'nilai' || 'hidden'">
                            @include('home.profil.nilai')
                        </div>
                    @endif
                </div>
            </div>



        </x-card>
    </div>
    </div>

    @push('float')
        @livewire('home.dashboard.materi')
        @include('home.dashboard.penugasan')
    @endpush
</x-home-layout>
