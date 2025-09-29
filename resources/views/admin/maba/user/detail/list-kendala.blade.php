<div x-data="{ showDetailKendala: @entangle('showDetailKendala') }">
    <x-card>
        <h5 class="mb-4 text-lg font-normal text-gray-700 font-bohemianSoul">List Kendala</h5>
        <x-table :theads="['Jenis Kendala', 'Status', 'Waktu Pengajuan', 'Aksi']" class="mb-3" :breakpointVisibility="[
            2 => ['xl' => 'hidden'], // Hide WaktuPengajuan on xl
            1 => ['lg' => 'hidden'], // Hide Status on lg
            3 => ['sm' => 'hidden'], // Hide Aksi on sm
        ]">
            @forelse ($kendala as $row)
                <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}"
                    x-on:click="if (window.innerWidth <= 640) { $wire.openDetailKendala({{ $row->id }}) }">
                    <td class="px-6 py-3">
                        <dl>
                            <dd class="font-bold xl:font-medium">{{ getJenisKendala($row->category) }}</dd>
                            <dd class="my-1.5 -ml-0.5 lg:hidden">
                                <x-status-kendala status="{{ $row->status }}" />
                                <span class="text-xs italic font-bold sm:hidden">(Click For Detail)</span>
                            </dd>
                            <dd class="mt-2 text-xs italic xl:hidden">
                                Diajukan pada {{ formatDateIso($row->created_at, 'dddd, D MMMM YYYY HH:mm:ss') }}
                            </dd>
                        </dl>
                    </td>

                    <td class="hidden px-6 py-3 text-center lg:table-cell">
                        <x-status-kendala status="{{ $row->status }}" />
                    </td>

                    <td class="hidden px-6 py-3 text-center xl:table-cell">
                        {{ formatDateIso($row->created_at, 'dddd, D MMMM YYYY HH:mm:ss') }}
                    </td>

                    <td class="hidden px-6 py-3 text-center sm:table-cell">
                        <x-button class="rounded-3xl bg-2025-1 hover:bg-coklat-hover mx-0.5"
                            wire:click="openDetailKendala({{ $row->id }})">
                            Detail
                        </x-button>
                    </td>
                </tr>
            @empty
                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                    <td colspan="4" class="px-6 py-3 italic text-center text-md">{{ $user->name }} belum pernah
                        melaporkan
                        kendala</td>
                </tr>
            @endforelse
        </x-table>

        {{ $kendala->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
    </x-card>


    <div x-cloak x-show="showDetailKendala">
        <x-modal>
            @if ($detailKendala)
                <div class="p-5 bg-white">
                    <div class="flex items-center justify-between">
                        <div class="text-left">
                            <h5 class="text-xl">
                                Kendala {{ getJenisKendala($detailKendala->category) }}
                                <x-status-kendala status="{{ $detailKendala->status }}" />
                            </h5>
                            <p class="mt-1 text-xs italic text-gray-500">Kendala dilaporkan pada
                                {{ formatDateIso($detailKendala->created_at, 'dddd, D MMMM YYYY HH:mm:ss') }} WIB</p>
                        </div>
                        <i class="cursor-pointer fa fa-times" x-on:click="showDetailKendala = false"></i>
                    </div>
                    <p class="my-3 text-sm">{{ $detailKendala->content }}</p>
                    <div>
                        @if ($detailKendala->foto_kendala)
                            <x-button class="mr-2 bg-base-blue-300 hover:bg-base-blue-400" :tagA="true"
                                target="_blank" href="{{ storage($detailKendala->foto_kendala) }}">Foto
                                Kendala</x-button>
                        @endif
                        @if ($detailKendala->foto_atribute)
                            <x-button class="mr-2 bg-base-blue-300 hover:bg-base-blue-400" :tagA="true"
                                target="_blank" href="{{ storage($detailKendala->foto_atribute) }}">Foto
                                Atribute</x-button>
                        @endif
                        @if ($detailKendala->foto_perlengkapan)
                            <x-button class="bg-base-blue-300 hover:bg-base-blue-400" :tagA="true" target="_blank"
                                href="{{ storage($detailKendala->foto_perlengkapan) }}">Foto Perlengkapan</x-button>
                        @endif
                    </div>

                    @if ($detailKendala->tanggapan && $detailKendala->status != 0)
                        <div class="mt-4">
                            <h5 class="mb-1 font-semibold">Tanggapan Panitia</h5>
                            <p class="text-sm">{{ $detailKendala->tanggapan }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </x-modal>
    </div>
</div>
