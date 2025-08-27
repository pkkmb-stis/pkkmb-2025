<x-home-layout menu="Dashboard" title="Dashboard">
    <div class="px-4 pt-24 pb-16 mt-6 sm:px-6 md:px-8 md:pt-28 lg:px-10">

        <x-card class="px-2 sm:px-5">
            <h5 class="text-xl font-medium font-bohemianSoul md:text-2xl">
                {{ getGreeting() }}, {{ $user->name }}!
            </h5>
            <p class="w-full mt-1 italic leading-tight text-justify text-gray-700 text-md lg:w-3/4">{{ getQuotes() }}
            </p>

            @if ($user->kelompok)
                <div class="mt-3">
                    @if ($user->kelompok->link_group_wa)
                        <x-button class="mx-0.5 rounded-3xl bg-green-500 p-1 hover:bg-green-600" :tagA="true"
                            href="{{ $user->kelompok->link_group_wa }}" target="_blank">
                            <i class="mr-1 fa-brands fa-whatsapp"></i>
                            <span>Group WA</span>
                        </x-button>
                    @endif

                    @if ($user->kelompok->link_zoom)
                        <x-button class="mx-0.5 rounded-3xl bg-blue-500 p-1 hover:bg-blue-600" :tagA="true"
                            href="{{ $user->kelompok->link_zoom }}" target="_blank">
                            <i class="mr-1 fa-solid fa-video"></i>
                            Zoom Kelas
                        </x-button>
                    @endif

                    @if ($user->kelompok->link_classroom)
                        <x-button class="mx-0.5 rounded-3xl bg-lime-500 p-1 hover:bg-lime-600" :tagA="true"
                            href="{{ $user->kelompok->link_classroom }}" target="_blank">
                            <i class="mr-1 fa-solid fa-chalkboard-teacher"></i>
                            Classroom
                        </x-button>
                    @endif
                </div>
            @endif
        </x-card>

        @if (auth()->user()->is_maba || $user->hasRole(ROLE_PANITIA))
            <div class="mt-4">
                {{-- Jika PKBN-MP2K Hybrid --}}
                {{-- Cek jika maba yang login --}}
                {{-- Dapat juga untuk PKBN-MP2K Online --}}
                @if (auth()->user()->is_maba)
                    @if (auth()->user()->kelompok()->first()->jenis_kelompok)
                        @livewire('home.dashboard.absensi.card')
                    @endif
                @endif

                {{-- Dapat juga untuk PKBN-MP2K Offline --}}
                {{-- Cek jika LAPK yang login --}}
                @if (
                    $user->hasRole(ROLE_LAPK) ||
                        $user->hasRole(ROLE_BPH) ||
                        $user->hasRole(ROLE_TIBUM) ||
                        $user->hasRole(ROLE_SUPER_ADMIN))
                    @livewire('home.dashboard.absensi.card')
                @endif
            </div>

            <div>
                @if (auth()->user()->is_maba)
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
                        <div class="col-span-1 lg:col-span-7">
                            <div class="grid grid-cols-1 gap-6">
                                @livewire('home.dashboard.penebusan.list-penebusan')
                                @livewire('home.dashboard.poin.list-poin')
                                @livewire('home.dashboard.absensi.list-absensi')
                                @livewire('home.dashboard.kendala.list-kendala')
                            </div>
                        </div>

                        <div class="col-span-1 lg:col-span-5">
                            @livewire('home.dashboard.poin.chart')
                        </div>
                    </div>
                @elseif (auth()->user()->hasRole(ROLE_PANITIA))
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
                        <div class="col-span-1 lg:col-span-7">
                            @livewire('home.dashboard.absensi.list-absensi')
                        </div>
                        <div class="col-span-1 lg:col-span-5">
                            @livewire('home.dashboard.kendala.list-kendala')
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-5 lg:grid-cols-12">
                        <div class="col-span-1 lg:col-span-7">
                            @livewire('home.dashboard.poin.list-poin')
                        </div>
                        <div class="col-span-1 lg:col-span-5">
                            @livewire('home.dashboard.poin.chart')
                        </div>
                    </div>
                @endif
            </div>

            {{-- Popup after loginnya diilangin dulu, ntar gampang aja kalo diperluin tinggal uncomment --}}
            {{-- @if (session()->has('afterLogin'))
                <div x-data="{ showModalInfografis: true, currentPhotoIndex: 0 }" x-show="showModalInfografis" x-cloak>
                    <x-modal>
                        <div class="relative">
                            <div class="absolute z-10 flex items-center justify-center w-6 h-6 transition-transform transform -translate-y-1/2 bg-white rounded-full cursor-pointer left-2 top-1/2 bg-opacity-90 hover:scale-105"
                                x-on:click="currentPhotoIndex = (currentPhotoIndex - 1 + 4) % 4">
                                <i class="fa fa-chevron-left"></i>
                            </div>
                            <div class="absolute z-10 flex items-center justify-center w-6 h-6 transition-transform transform -translate-y-1/2 bg-white rounded-full cursor-pointer right-2 top-1/2 bg-opacity-90 hover:scale-105"
                                x-on:click="currentPhotoIndex = (currentPhotoIndex + 1) % 4">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                            <div class="absolute z-10 flex items-center justify-center w-6 h-6 transition-transform transform scale-100 bg-white rounded-full cursor-pointer right-5 top-5 bg-opacity-90 hover:scale-105"
                                x-on:click="showModalInfografis = false">
                                <i class="fa fa-times"></i>
                            </div>
                            <div class="w-full h-full overflow-hidden">
                                <img x-bind:src="['{{ asset('img/galeri/kelulusan.png') }}', '{{ asset('img/galeri/poster1.png') }}',
                                    '{{ asset('img/galeri/poster2.png') }}', '{{ asset('img/galeri/poster3.png') }}'
                                ][currentPhotoIndex]"
                                    alt="Syarat Kelulusan" class="h-full transition-transform"
                                    x-transition:enter="transition-transform ease-out duration-300"
                                    x-transition:leave="transition-transform ease-in duration-300">
                            </div>
                        </div>
                    </x-modal>
                </div>
            @endif --}}

            {{-- Otomatis swipe setelah 3 detik --}}
            {{-- @if (session()->has('afterLogin'))
                <div x-data="{ showModalInfografis: true, currentPhotoIndex: 0 }" x-show="showModalInfografis" x-cloak x-init="setInterval(() => { currentPhotoIndex = (currentPhotoIndex + 1) % 4; }, 3000)">
                    <x-modal>
                        <div class="relative px-1">
                            <div class="absolute flex items-center justify-center w-6 h-6 transition-transform transform scale-100 bg-white rounded-full cursor-pointer right-5 top-5 bg-opacity-90 hover:scale-105"
                                x-on:click="showModalInfografis = false">
                                <i class="fa fa-times"></i>
                            </div>
                            <img x-bind:src="['{{ asset('img/galeri/kelulusan.png') }}', '{{ asset('img/galeri/poster1.png') }}',
                                '{{ asset('img/galeri/poster2.png') }}', '{{ asset('img/galeri/poster3.png') }}'
                            ][currentPhotoIndex]"
                                alt="Modal Pop-Up" class="h-full">
                        </div>
                    </x-modal>
                </div>
            @endif --}}

            @push('float')
                @livewire('home.dashboard.materi')
                @include('home.dashboard.penugasan')
            @endpush

            @livewire('home.dashboard.absensi.qrcode-reader')
            @livewire('home.dashboard.absensi.auto-form-keterlambatan')
            @livewire('home.dashboard.absensi.form-keterlambatan')
            @livewire('home.dashboard.kendala.form')
        
        @endif
    </div>
</x-home-layout>
