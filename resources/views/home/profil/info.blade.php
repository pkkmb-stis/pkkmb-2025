<div x-data="{showDetailKelompok : false,showModalQR : false}">
    <div class="md:block items-center gap-3">

        <div class="col-span-4 pb-6 md:pb-0">
            <x-label-input for="photo">
                <img class="w-3/4 mx-auto h-40 object-cover md:mb-5 rounded-2xl cursor-pointer border-4 border-white shadow-lg"
                    src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">

                <input type="file" id="photo" class="hidden" wire:model="photo">
            </x-label-input>
            <p class="text-xs text-white italic" wire:loading wire:target="photo">Uploading ...
        </div>

        <div class="col-span-8">
            <div class="">
               <div class="flex items-center py-2">
                    <div class="rounded-2xl bg-white w-[90%] mx-auto overflow-hidden shadow-md">
                        <div class="text-center text-gray-800 text-sm font-poppins font-semibold bg-amber-100 py-3">
                            <i class="fa fa-id-card text-gray-800 fa-fw mr-2"></i>
                            @if (auth()->user()->hasRole(ROLE_PANITIA))
                                Username
                            @else
                                No Ujian
                            @endif
                        </div>
                        <div class="text-center text-sm font-poppins font-semibold text-gray-800 py-3">{{ $user->username }}</div>
                    </div>
                </div>

                @if ($user->is_maba)
                <div class="flex items-center py-2">
                    <div class="rounded-2xl bg-white w-[90%] mx-auto overflow-hidden shadow-md">
                        <div class="text-center text-gray-800 text-sm font-poppins font-semibold bg-amber-100 py-3">
                            <i class="fa-solid fa-address-card text-gray-800 fa-fw mr-2"></i>
                            NIMB
                        </div>
                        <div class="text-center text-sm font-poppins font-semibold text-gray-800 py-3">{{ $user->nimb ?? '-' }}</div>
                    </div>
                </div>
                @endif

                <div class="flex items-center py-2">
                    <div class="rounded-2xl bg-white w-[90%] mx-auto overflow-hidden shadow-md">
                        <div class="text-center text-gray-800 text-sm font-poppins font-semibold bg-amber-100 py-3">
                            <i class="fa fa-user text-gray-800 fa-fw mr-2"></i>
                            Nama Lengkap</div>
                        <div class="text-center text-sm font-poppins font-semibold text-gray-800 py-3">{{ $user->name }}</div>
                    </div>
                </div>

                <div class="flex items-center py-2">
                    <div class="rounded-2xl bg-white w-[90%] mx-auto overflow-hidden shadow-md">
                        <div class="text-center text-gray-800 text-sm font-poppins font-semibold bg-amber-100 py-3">
                            <i class="fa fa-envelope text-gray-800 fa-fw mr-2"></i>
                            Email</div>
                        <div class="text-center text-sm font-poppins font-semibold text-gray-800 py-3">{{ $user->email }}</div>
                    </div>
                </div>



                @if ($user->is_maba)

                <div class="flex items-center py-2">
                    <div class="rounded-2xl bg-white w-[90%] mx-auto overflow-hidden shadow-md">
                        <div class="text-center text-gray-800 text-sm font-poppins font-semibold bg-amber-100 py-3">
                            <i class="fa fa-grin-tears text-gray-800 fa-fw mr-2"></i>
                            Nama Khas</div>
                        <div class="text-center text-sm font-poppins font-semibold text-gray-800 py-3">{{ $user->nama_statistik ?? '-' }}</div>
                    </div>
                </div>
                @endif

                @if ($kelompok)
                <div>
                    <div class="flex items-center py-2">
                        <div class="rounded-2xl bg-white w-[90%] mx-auto overflow-hidden shadow-md">
                            <div class="text-center text-gray-800 text-sm font-poppins font-semibold bg-amber-100 py-3">
                                <i class="fa fa-user-friends text-gray-800 fa-fw mr-2"></i>
                                Kelompok
                            </div>
                            <div class="text-center text-sm text-gray-800 py-3">
                                <div x-on:click="showDetailKelompok = true"
                                class="text-sm text-gray-800 hover:text-amber-600 font-semibold cursor-pointer">
                                {{ $kelompok->nama }}
                                </div>
                            </div>
                    </div>
                    </div>
                    <p class="text-xs text-white italic block ml-5 2xl:ml-7">
                        Silakan klik nama kelompok untuk melihat
                        detail kelompok
                    </p>
                </div>
                @endif

            </div>
        </div>
    </div>

    @if ($user->hasRole(ROLE_PANITIA))
    <div class="w-full flex justify-center my-4">
        <x-button class="bg-2025-2 hover:bg-2025-1 w-[90%] text-center font-poppins rounded-2xl text-white shadow-md" x-on:click="showModalQR = true">
            QR Code
        </x-button>
    </div>
    <div x-show="showModalQR" x-cloak x-init="getQRCode">
        <x-modal>
            <div class="my-4">
                <div class="flex justify-center mb-2 items-center">
                    <h5 class="font-poppins text-md font-semibold mr-3">QR Code {{ $user->name }}
                    </h5>
                    <i class="fa fa-times cursor-pointer" x-on:click="showModalQR = false"></i>
                </div>
                <div class="flex justify-center">
                    <div id="qrcode" class="mx-auto"></div>
                </div>
            </div>
        </x-modal>
    </div>
    @endif

    @if ($user->is_maba)
    <div class="w-full flex justify-center mb-3">
        <x-button :tagA="true" class="bg-2025-2 hover:bg-2025-1 uppercase rounded-2xl text-center text-base font-normal whitespace-nowrap my-3 mx-auto w-[90%] font-poppins text-white shadow-md"
            target="_blank" href="{{ route('home.cocard', ['id' => $user->id])}}">
            Download Co Card
        </x-button>
    </div>
    @endif
{{--
    <div class="divide-y-2 md:hidden">
        <div class="flex items-center py-3">
            <i class="fa fa-user text-black fa-fw mr-2"></i>
            <div>
                <div class="text-xs font-poppins font-semibold">Nama</div>
                <div class="text-sm text-black">{{ $user->name }}</div>
            </div>
        </div>

        <div class="flex items-center py-3">
            <i class="fa fa-envelope text-base-blue-400 fa-fw mr-2"></i>
            <div>
                <div class="text-xs font-poppins font-semibold">Email</div>
                <div class="text-sm text-black">{{ $user->email }}</div>
            </div>
        </div>

        @if ($user->is_maba)

        <div class="flex items-center py-3">
            <i class="fa-solid fa-address-card text-base-blue-400 fa-fw mr-2"></i>
            <div>
                <div class="text-xs font-poppins font-semibold">NIMB</div>
                <div class="text-sm text-black">{{ $user->nimb ?? '-' }}</div>
            </div>
        </div>

        <div class="flex items-center py-3">
            <i class="fa fa-grin-tears text-base-blue-400 fa-fw mr-2"></i>
            <div>
                <div class="text-xs font-poppins font-semibold">Nama Khas</div>
                <div class="text-sm text-black">{{ $user->nama_statistik }}</div>
            </div>
        </div>

        @if ($kelompok)
        <div>
            <div class="flex items-center py-3">
                <i class="fa fa-user-friends text-base-blue-400 fa-fw mr-2"></i>
                <div>
                    <div class="text-xs font-poppins font-semibold">Kelompok</div>
                    <div x-on:click="showDetailKelompok = true"
                        class="text-sm text-black hover:text-base-green-400 cursor-pointer">
                        {{ $kelompok->nama }}</div>
                </div>
            </div>
            <p class="text-xs text-black italic md:hidden block">Silakan klik nama kelompok untuk melihat detail
                kelompok
        </div>
        @endif

        @endif
    </div> --}}

    @if($kelompok)
    <div x-cloak x-show="showDetailKelompok">
        <x-modal>
            <div class="md:px-8 pt-5 px-4 pb-0">
                <div class="flex justify-between items-center mb-3">
                    <h5 class="font-semibold font-poppins capitalize">Detail Kelompok {{ $kelompok->nama }}</h5>
                    <i class="fa fa-times cursor-pointer" x-on:click="showDetailKelompok = false"></i>
                </div>
                <div class="grid lg:grid-cols-12 lg:gap-6 items-center text-xs">
                    <div class="col-span-4 lg:block grid grid-cols-12 gap-3 items-center mb-2">
                        <img class="w-full col-span-4" src="{{ $kelompok->pendamping->profile_photo_url }}"
                            alt="{{ $kelompok->pendamping->name }}">
                        <div class="py-2 lg:hidden col-span-8">
                            <h5 class="font-semibold capitalize font-poppins mb-1">Tentang {{ $kelompok->nama }}
                            </h5>
                            <p>{{ $kelompok->description }}</p>
                        </div>
                    </div>
                    <div class="col-span-8 divide-y-2">
                        <div class="py-2 hidden lg:block">
                            <h5 class="font-semibold capitalize font-poppins mb-1">Tentang {{ $kelompok->nama }}
                            </h5>
                            <p>{{ $kelompok->description }}</p>
                        </div>
                        <div class="py-2">
                            <h5 class="font-semibold capitalize font-poppins mb-1">Pendamping Kelompok</h5>
                            <p>{{ $kelompok->pendamping->name }} - {{ $kelompok->pendamping->username }}
                            </p>
                        </div>
                        <div class="py-2">
                            <h5 class=" font-semibold capitalize font-poppins mb-1">No WA Pendamping</h5>
                            <p>{{ $kelompok->pendamping->nowa }}
                            </p>
                        </div>
                        <div class="py-2">
                            <h5 class=" font-semibold capitalize font-poppins mb-1">Link Penting</h5>
                            <div class="mt-3">
                                <x-button class="bg-green-500 hover:bg-green-600 mx-0.5 mb-1" :tagA="true"
                                    href="{{ $kelompok->link_group_wa }}" target="_blank">Group WA</x-button>
                                <x-button class="bg-blue-500 hover:bg-blue-600 mx-0.5 mb-1" :tagA="true"
                                    href="{{ $kelompok->link_zoom }}" target="_blank">Zoom Kelas</x-button>
                                <x-button class="bg-lime-500 hover:bg-lime-600 mx-0.5 mb-1" :tagA="true"
                                    href="{{ $kelompok->link_classroom }}" target="_blank">Classroom</x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-modal>
    </div>
    @endif

    @push('script-bottom')
    <script src="{{ asset('js/qrcode.min.js') }}"></script>
    <script type="text/javascript">
        const getQRCode = () =>{
                new QRCode(document.getElementById("qrcode"), "{{ $user->username }}");
            }
    </script>
    @endpush
</div>
