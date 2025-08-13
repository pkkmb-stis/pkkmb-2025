<x-admin-layout menu="Absensi" title="Detail Absensi">
    <x-card x-data="{ showModalQR: false }">
        <h5 class="flex items-center">
            <span class="mr-2 text-xl font-semibold font-poppins">Presensi Acara {{ $event->title }}</span>
            <span
                class="px-3 py-1 text-xs font-bold text-white bg-green-500 rounded-full whitespace-nowrap">{{ $event->is_pasca }}</span>
        </h5>
        <p class="mt-2 text-xs italic text-gray-600">
            Presensi QR code dibuka pada {{ formatDateIso($event->waktu_mulai) }} -
            {{ formatDateIso($event->waktu_akhir) }}
        </p>
        <p class="mt-3 mb-4 leading-tight">{{ $event->caption }}</p>
        <div>
            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="true"
                href="{{ route('absensi') }}">
                Kembali
            </x-button>
            {{-- <x-button class="mr-2 bg-blue-500 rounded-3xl hover:bg-blue-600" :tagA="true" href="{{ $event->link }}" target="_blank">
                Link Zoom
            </x-button> --}}

            @if ($event->waktu_akhir > now())
                <x-button class="bg-green-500 hover:bg-green-600 rounded-3xl" x-on:click="showModalQR = true">
                    QR Code
                </x-button>
                <div x-show="showModalQR" x-cloak x-init="getQRCode">
                    <x-modal>
                        <div class="my-4">
                            <div class="flex items-center justify-center w-full mb-2">
                                <h5 class="mr-3 font-semibold font-poppins text-md">QR Code Presensi {{ $event->title }}
                                </h5>
                                <i class="cursor-pointer fa fa-times" x-on:click="showModalQR = false"></i>
                            </div>
                            <div class="flex justify-center">
                                <div id="qrcode" class="mx-auto"></div>
                            </div>
                        </div>
                    </x-modal>
                </div>
            @endif
        </div>


    </x-card>

    <hr class="my-4">

    @livewire('admin.maba.event.absensi.table', ['event' => $event->id])


    @push('script-top')
        <script src="{{ mix('js/laravel-echo.js') }}" defer></script>
    @endpush

    @push('script-bottom')
        <script src="{{ asset('js/qrcode.min.js') }}"></script>
        <script type="text/javascript">
            const getQRCode = () => {
                new QRCode(document.getElementById("qrcode"), "{{ $event->eventcode }}");
            }
        </script>
    @endpush



</x-admin-layout>
