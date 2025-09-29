<x-card>
    <div class="hidden sm:block">
        <x-table :theads="['Dimensi', 'Indikator', 'SKS', 'Nilai angka', 'nilai huruf']" :breakpointVisibility="[
            1 => ['xl' => 'hidden'], // Hide Indikator on xl
            2 => ['lg' => 'hidden'], // Hide SKS on lg
            3 => ['lg' => 'hidden'], // Hide Nilai Angka on lg
        ]">
            @forelse ($indikator as $index => $nilai)
                <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="px-6 py-3">
                        {{-- <span class="inline xl:hidden">Dimensi: </span> --}}
                        <span class="font-bold xl:font-semibold">{{ $nilai->dimensi }}</span>
                        <dl>
                            <dd class="xl:hidden">Indikator: {{ $nilai->nama }}</dd>
                        </dl>
                        <dl>
                            <dd class="lg:hidden"> SKS: {{ $nilai->sks }}</dd>
                        </dl>
                        <dl>
                            <dd class="lg:hidden"> Nilai Angka: @if ($nilai->nilai)
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white rounded-full whitespace-nowrap bg-coklat-1">{{ number_format($nilai->nilai, 2, '.', '') }}</span>
                                @else
                                    -
                                @endif
                            </dd>
                        </dl>
                    </td>
                    <td class="hidden px-6 py-3 xl:table-cell">{{ $nilai->nama }}</td>
                    <td class="hidden px-6 py-3 text-center lg:table-cell">{{ $nilai->sks }}</td>
                    <td class="hidden px-6 py-3 text-center lg:table-cell">
                        @if ($nilai->nilai)
                            {{ number_format($nilai->nilai, 2, '.', '') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-6 py-3 text-center">
                        @if ($nilai->nilai)
                            {{ getGrade($nilai->nilai) }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr x-data="{
                colspan: window.innerWidth >= 1280 ? 4 : (window.innerWidth >= 1024 ? 3 : 1)
            }" x-init="window.addEventListener('resize', () => {
                colspan = window.innerWidth >= 1280 ? 4 : (window.innerWidth >= 1024 ? 3 : 1);
            })" class="border-b border-gray-200 hover:bg-blueGray-100">
                <td :colspan="colspan" class="px-6 py-3 text-center">Indeks Prestasi Kumulatif (IPK)</td>
                <td class="px-6 py-3 text-center">{{ $ip == 0 ? '-' : $ip }}</td>
            </tr>


        </x-table>
    </div>

    {{-- Versi Mobile --}}
    <div class="grid grid-cols-1 gap-4 sm:hidden">
        @forelse ($indikator as $index => $nilai)
            <x-card class="flex flex-col items-start justify-between p-4 space-y-3">
                <div>
                    <span class="font-bold text-base-blue-400">{{ $nilai->dimensi }}</span>
                    <div class="mt-1">
                        <dl>
                            <dd class="font-medium text-base-blue-400">Indikator: {{ $nilai->nama }}</dd>
                        </dl>
                        <dl>
                            <dd class="font-medium text-base-blue-400">SKS: {{ $nilai->sks }}</dd>
                        </dl>
                        <dl>
                            <dd class="font-medium text-base-blue-400">
                                Nilai Angka:
                                @if ($nilai->nilai)
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white rounded-full whitespace-nowrap bg-coklat-1">
                                        {{ number_format($nilai->nilai, 2, '.', '') }}
                                    </span>
                                @else
                                    -
                                @endif
                            </dd>
                        </dl>
                        <dl>
                            <dd class="font-medium text-base-blue-400">Nilai Huruf:
                                @if ($nilai->nilai)
                                    {{ getGrade($nilai->nilai) }}
                                @else
                                    -
                                @endif
                            </dd>
                        </dl>
                    </div>
                </div>
            </x-card>
        @empty
            <div class="col-span-1 italic text-center text-gray-500">Tidak ada nilai</div>
        @endforelse

        @if ($ip)
            <x-card class="flex flex-col items-center justify-between p-4 space-y-3">
                <div class="font-bold text-center text-base-blue-400">
                    Indeks Prestasi Kumulatif (IPK)
                </div>
                <div class="text-lg font-semibold text-center">
                    <span
                        class="inline-flex items-center justify-center px-5 py-1 text-xs font-bold leading-none text-white rounded-full whitespace-nowrap bg-coklat-1">
                        {{ $ip == 0 ? '-' : $ip }}
                    </span>
                </div>
            </x-card>
        @endif
    </div>

    @if ($canInputNilai)
        <div class="flex flex-col items-center justify-between mt-4 lg:flex-row">
            <small class="mb-2 text-xs italic text-center lg:text-left lg:mb-0">Sertifikat bisa didownload ketika NIMB
                dan status kelulusan sudah ada</small>

            <div class="flex flex-col mt-2 space-y-2 lg:space-y-0 lg:space-x-2 lg:flex-row lg:mt-0 whitespace-nowrap">
                <x-button :tagA="true" class="text-center rounded-3xl bg-2025-2 hover:bg-2025-1"
                    href="{{ route('input-nilai.detail', ['id' => $user->id]) }}">
                    Edit Nilai
                </x-button>
                @if (
                    ($user->status_kelulusan == STATUS_LULUS_PKKMB_PKBN || $user->status_kelulusan == STATUS_LULUS_PKKMB) &&
                        $user->nimb)
                    <x-button :tagA="true"
                        class="text-center uppercase rounded-3xl bg-base-blue-300 hover:bg-base-blue-400 text-md"
                        target="_blank" href="{{ route('home.sertifikat', ['id' => $user->id]) }}">
                        Download Sertifikat PKKMB
                    </x-button>
                @endif
                @if (($user->status_kelulusan == STATUS_LULUS_PKKMB_PKBN || $user->status_kelulusan == STATUS_LULUS_PKBN) && $user->nimb)
                    <x-button :tagA="true"
                        class="text-center uppercase rounded-3xl bg-base-blue-300 hover:bg-base-blue-400 text-md"
                        target="_blank" href="{{ route('home.sertifikat-pkbn', ['id' => $user->id]) }}">
                        Download Sertifikat PKBN
                    </x-button>
                @endif
            </div>
        </div>

    @endif

</x-card>
