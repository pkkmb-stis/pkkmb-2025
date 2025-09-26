<x-home-layout menu="Timeline" title="Timeline - PKKMB-PKBN 2025">
    <div class="mb-10 grid h-auto w-auto grid-cols-1 justify-items-center px-2 pb-8 pt-24 font-poppins sm:px-12 md:px-16 md:pb-10 md:pt-28 lg:px-24 lg:pb-12 lg:pt-32 xl:pb-14"
        x-data="{ width: window.innerWidth }" x-init="window.addEventListener('resize', () => {
            width = window.innerWidth;
        });">
        {{-- Header --}}
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
                                TIMELINE
                            </h1>
                            <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                                alt="Elemen 4" class="w-24 sm:w-28 -ml-28 z-10 -mt-8 scale-x-[-1]">
                        </div>
                    </div>
                <img src="{{ asset('img/maskot/2025/maskot 2.png') }}" alt="wave" class="z-10 w-32 sm:w-40 translate-x-4 transform translate-y-[-10px]">
            </div>
        </div>

        @php
            $i = 0;
        @endphp
        <div class="mx-auto mb-0 mt-4 flex w-[90%] justify-center overflow-hidden rounded-lg sm:my-4">
            <div class="ml-4">
                @foreach ($timeline as $t)
                    @php
                        $isLast = $i === count($timeline) - 1;

                        $startDate = Carbon\Carbon::parse($t->waktu_mulai->format('Y-m-d'));
                        $endDate = $t->waktu_akhir
                            ? Carbon\Carbon::parse($t->waktu_akhir->format('Y-m-d'))
                            : $startDate;
                        $today = Carbon\Carbon::today();

                        // Default background color
                        $bgColor = '#C0C0C0'; // Default for wait (C0C0C0)

                        // Mengatur warna solid berdasarkan status (wait atau done)
                        if ($endDate->lt($today)) {
                            $bgColor = '#F9C46B'; // Done (F9C46B) from 2025.5 color
                        } elseif ($startDate->eq($today)) {
                            $bgColor = '#F9C46B'; // Done for today (F9C46B) from 2025.5 color
                        }

                        // Menentukan warna untuk status circle
                        $color = $bgColor == '#F9C46B' ? 'bg-yellow-500' : 'bg-gray-400'; // Yellow for done, gray for wait

                        // Menentukan elemen gambar yang akan digunakan
                        $rightElement = '';
                        if ($i % 2 == 0) {
                            // Untuk status "wait" menggunakan wait1 dan wait2
                            $rightElement = $bgColor == '#F9C46B' ? 'patterndone1.png' : 'patternwait1.png';
                        } else {
                            // Untuk status "done" menggunakan done1 dan done2
                            $rightElement = $bgColor == '#F9C46B' ? 'patterndone2.png' : 'patternwait2.png';
                        }
                    @endphp
                    <div class="relative mt-[-4px] w-full">
                        <div class="{{ $isLast ? 'ml-1' : 'pb-6 border-l-4 border-solid border-black' }} px-4">

                            <!-- Judul acara -->
                            <h1 class="mb-2 font-chaTime text-lg font-bold text-coklat-1">{{ $t->title }}</h1>
                            <div class="rounded-lg px-4 py-2 pr-40 font-poppins text-white bg-cover bg-center bg-no-repeat"
                                style="background-color: {{ $bgColor }};"> <!-- Gunakan warna solid -->
                                <div class="font-poppins font-bold tracking-wide text-kuning-1">
                                    {{ formatDateIso($t->waktu_mulai, 'D MMMM YYYY') }}
                                    @if ($t->waktu_akhir)
                                        <span x-cloak :class="(width < 512) ? '' : 'hidden'"><br></span>
                                        - {{ formatDateIso($t->waktu_akhir, 'D MMMM YYYY') }}
                                    @endif
                                </div>
                                <div class="my-2 w-full border-b-4 border-kuning-1"></div>
                                <p>{{ $t->caption != '-' ? $t->caption : '' }}</p>

                                {{-- Lokasi --}}
                                <div class="text-white">
                                    @if (!empty($t->location))
                                        <div class="my-2 flex flex-row items-center">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <div class="ml-2">{{ $t->location }}</div>
                                        </div>
                                    @endif
                                </div>

                                <div class="absolute top-0 right-0 flex flex-col gap-2 mt-2 mr-4">
                                    <img src="{{ asset('img/asset/2025/timeline/'.$rightElement) }}" alt="Icon" class="w-16 h-16 z-10" />
                                </div>`
                            </div>
                        </div>

                        <!-- Lingkaran status acara -->
                        <div class="{{ $color }} absolute top-0 ml-[-8px] mt-[4px] h-5 w-5 rounded-full border-2 border-solid border-black">
                        </div>
                    </div>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </div>
        </div>

    </div>
</x-home-layout>
