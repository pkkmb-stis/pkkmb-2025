<div x-data="{ showDetailAbsensi: @entangle('showDetailAbsensi') }">
    <x-card>
        <h5 class="mb-4 text-lg font-normal text-gray-700 font-bohemianSoul">List Presensi</h5>
        <x-table :theads="['Event', 'Waktu Mulai Presensi', 'Waktu Absen', 'Status', 'Aksi']" class="mb-3" :breakpointVisibility="[
            2 => ['xl' => 'hidden'], // Hide Waktu Absen Pada on xl
            3 => ['lg' => 'hidden'], // Hide Status on lg
            1 => ['lg' => 'hidden'], // Hide Waktu Mulai on lg
            4 => ['sm' => 'hidden'], // Hide Aksi on sm
        ]">
            @forelse ($absensi as $absen)
                <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}"
                    @if ($absen->pivot) x-on:click="if (window.innerWidth <= 640 && '{{ $absen->pivot }}' !== '') { $wire.openDetailAbsensi({{ $absen->pivot }}, '{{ $absen->title }}') }" @endif>
                    <td class="px-6 py-3">
                        <dl>
                            <dd class="font-bold xl:font-medium">{{ $absen->title }}</dd>
                            <dd class="mt-1 text-xs italic lg:hidden">
                                Waktu mulai presensi {{ formatDateIso($absen->waktu_mulai, 'D MMMM YYYY HH:mm') }} WIB
                            </dd>
                            <dd class="my-1.5 -ml-0.5 lg:hidden">
                                @if ($absen->pivot)
                                    <x-status-absensi status="{{ $absen->pivot->status }}" />
                                    <span class="text-xs italic font-bold sm:hidden">(Click For Detail)</span>
                                @else
                                    <small
                                        class="p-1 px-3 text-xs text-white rounded-full bg-coklat-2 whitespace-nowrap">Belum
                                        Absen</small>
                                @endif
                            </dd>
                            <dd class="mt-2 text-xs italic xl:hidden">
                                @if ($absen->pivot)
                                    Absen pada {{ formatDateIso($absen->pivot->created_at) }} WIB
                                @else
                                @endif
                            </dd>
                        </dl>
                    </td>
                    <td class="hidden px-6 py-3 text-center lg:table-cell">
                        {{ formatDateIso($absen->waktu_mulai, 'D MMMM YYYY HH:mm') }}</td>

                    <td class="hidden px-6 py-3 text-center xl:table-cell">
                        @if ($absen->pivot)
                            {{ formatDateIso($absen->pivot->created_at) }}
                        @else
                            -
                        @endif
                    </td>

                    <td class="hidden px-6 py-3 text-center lg:table-cell">
                        @if ($absen->pivot)
                            <x-status-absensi status="{{ $absen->pivot->status }}" />
                        @else
                            <small class="text-xs">Belum Absen</small>
                        @endif
                    </td>

                    <td class="hidden px-6 py-3 text-center sm:table-cell">
                        @if ($absen->pivot)
                            <x-button class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover mx-0.5"
                                wire:click="openDetailAbsensi({{ $absen->pivot }}, '{{ $absen->title }}')">
                                Detail
                            </x-button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                    <td colspan="5" class="px-6 py-3 italic text-center text-md">{{ $user->name }} belum memiliki
                        data
                        presensi</td>
                </tr>
            @endforelse
        </x-table>
    </x-card>

    <div x-cloak x-show="showDetailAbsensi">
        <x-modal>
            @if ($detailAbsensi)
                <div class="p-5 bg-white">
                    <div class="flex items-center justify-between">
                        <div class="text-left">
                            <h5 class="text-xl">
                                Presensi {{ $title }}
                                <x-status-absensi status="{{ $detailAbsensi['status'] }}" />
                            </h5>
                            <p class="mt-1 text-xs italic text-gray-500">Melakukan presensi pada
                                {{ formatDateIso($detailAbsensi['created_at'], 'dddd, D MMMM YYYY HH:mm:ss', 7) }} WIB
                            </p>

                        </div>
                        <i class="cursor-pointer fa fa-times" x-on:click="showDetailAbsensi = false"></i>
                    </div>

                    @if ($detailAbsensi['alasan'])
                        <p class="my-3 text-sm">{{ $detailAbsensi['alasan'] }}</p>
                    @endif

                    @if ($detailAbsensi['link'])
                        <a target="_blank" href="{{ storage($detailAbsensi['link']) }}"
                            class="px-3 py-1 text-xs text-white rounded-md cursor-pointer bg-base-blue-300 hover:bg-base-blue-400">
                            Bukti Keterlambatan
                        </a>
                    @endif

                    @if ($detailAbsensi['status'] == 0)
                        <p class="mt-5 mb-3 text-lg font-semibold">Pertahankan!</p>
                    @endif
                </div>
            @endif
        </x-modal>
    </div>
</div>
