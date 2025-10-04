<x-home-layout menu="Timeline" title="Timeline - PKKMB 2025">
    <div class="mb-10 grid h-auto w-auto grid-cols-1 justify-items-center px-2 pb-8 pt-24 font-poppins sm:px-12 md:px-16 md:pb-10 md:pt-28 lg:px-24 lg:pb-12 lg:pt-32 xl:pb-14"
        x-data="{ width: window.innerWidth }" x-init="window.addEventListener('resize', () => {
            width = window.innerWidth;
        });">
        {{-- Header --}}
            <div class="flex h-full w-full flex-row items-end justify-center gap-4 translate-y-[-10px]">
                <img src="{{ asset('img/maskot/2025/maskot 5.png') }}" alt="wave" class="z-10 w-24 sm:w-36 md:w-48 lg:w-48 lg:-translate-x-4 transform translate-y-[-10px]">
                    <div class="flex h-full flex-col items-center justify-center">
                        <div class="flex flex-row items-center justify-center gap-4 mt-14 transform translate-y-[-10px]">
                            <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                                alt="Elemen 4" class="w-14 sm:w-20 md:w-28 lg:w-28 -mr-14 sm:-mr-20 md:-mr-28 lg:-mr-28 sm:-mt-5 md:-mt-8 lg:-mt-8 z-10">
                            <h1
                                class="flex items-center justify-center rounded-full px-10 py-3 sm:px-8 sm:pb-4 lg:px-16 lg:py-4 lg:pb-6
                                    font-brasikaDisplay text-center text-sm font-thin leading-normal 
                                    drop-shadow-md sm:text-xl lg:text-3xl xl:text-4xl z-0 relative border-4"
                                style="color:#1E2A4A; background-color:#FFF3E6; border-color:#1E2A4A;">
                                TIMELINE
                            </h1>
                            <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                                alt="Elemen 4" class="w-14 sm:w-20 md:w-28 lg:w-28 -ml-14 sm:-ml-20 md:-ml-28 lg:-ml-28 sm:-mt-5 md:-mt-8 lg:-mt-8 z-10 scale-x-[-1]">
                        </div>
                    </div>
                <img src="{{ asset('img/maskot/2025/maskot 2.png') }}" alt="wave" class="z-10 w-20 sm:w-28 md:w-40 lg:w-40 lg:translate-x-4 transform translate-y-[-10px]">
            </div>
        </div>

        @php
            $i = 0;
        @endphp
        <div class="mx-auto mb-0 -mt-4 sm:-mt-8 md:-mt-10 lg:-mt-12 flex w-[90%] justify-center overflow-hidden rounded-lg pb-10 sm:pb-15 md:pb-20">
            <div class="ml-4">
                @foreach ($timeline as $t)
                    @php
                        $isLast = $i === count($timeline) - 1;
                        $startDate = Carbon\Carbon::parse($t->waktu_mulai->format('Y-m-d'));
                        $endDate = $t->waktu_akhir
                            ? Carbon\Carbon::parse($t->waktu_akhir->format('Y-m-d'))
                            : $startDate;
                        $today = Carbon\Carbon::today();

                        $bgColor = '#C0C0C0';

                        if ($endDate->lt($today)) {
                            $bgColor = '#F9C46B';
                        } elseif ($startDate->eq($today)) {
                            $bgColor = '#F9C46B';
                        }

                        $color = $bgColor == '#F9C46B' ? 'bg-yellow-500' : 'bg-gray-400'; // Yellow for done, gray for wait

                        $rightElement = '';
                        if ($i % 2 == 0) {
                            $rightElement = $bgColor == '#F9C46B' ? 'patterndone1.png' : 'patternwait1.png';
                        } else {
                            $rightElement = $bgColor == '#F9C46B' ? 'patterndone2.png' : 'patternwait2.png';
                        }
                    @endphp
                    <div class="relative mt-[-4px] w-full {{ $loop->first ? 'pt-1' : '' }}">
                        <div class="{{ $isLast ? 'ml-1' : 'pb-6 border-l-4 border-solid border-2025-3' }} px-4">
                            <h1 class="mb-2 font-chaTime text-xl font-bold text-black">{{ $t->title }}</h1>

                            <div class="relative flex overflow-hidden rounded-lg border-2 border-solid border-2025-3 bg-cover bg-center bg-no-repeat"
                                style="background-color: {{ $bgColor }};">
                                
                                <div class="font-poppins py-2 px-4 w-full md:w-[80%]">
                                    <div class="font-poppins font-bold tracking-wide text-2025-3">
                                        {{ formatDateIso($t->waktu_mulai, 'D MMMM YYYY') }}
                                        @if ($t->waktu_akhir)
                                            <span x-cloak :class="(width < 512) ? '' : 'hidden'"><br></span>
                                            - {{ formatDateIso($t->waktu_akhir, 'D MMMM YYYY') }}
                                        @endif
                                    </div>
                                    <div class="my-2 w-full border-b-2 border-2025-3"></div>
                                    <p>{{ $t->caption != '-' ? $t->caption : '' }}</p>

                                    {{-- Lokasi --}}
                                    <div class="text-2025-3">
                                        @if (!empty($t->location))
                                            <div class="my-2 flex flex-row items-center">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <div class="ml-2">{{ $t->location }}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="absolute top-0 right-0 mr-3 h-full w-[20%] hidden md:block">
                                    <img src="{{ asset('img/asset/2025/timeline/'.$rightElement) }}"
                                        alt="pattern"
                                        class="h-full w-full object-cover" /> </div>
                            </div>
                        </div>

                        <div class="absolute ml-[-12px] {{ $i === 0 ? 'top-1' : 'top-0 -mt-[2px]' }}">
                            <img 
                                src="{{ asset('img/asset/2025/timeline/' . ($color == 'bg-yellow-500' ? 'cempakadone.png' : 'cempakawait.png')) }}" 
                                alt="status" 
                                class="w-8 h-8" />
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
