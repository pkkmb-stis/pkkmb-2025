<div>
    <x-card class="mb-3">
        <x-table :theads="['Nama', 'NIMB', 'Kelompok', 'IPK']" :breakpointVisibility="[
            2 => ['lg' => 'hidden'], // Hide kelompok on lg
        ]">
            <tr class="text-center border-b border-gray-200 hover:bg-blueGray-100">

                <td class="px-6 py-3">
                    <dl>
                        <dd><a href="{{ route('user.detail', ['id' => $user->id]) }}"
                                class="underline hover:text-blue-600">
                                {{ $user->name }}
                            </a></dd>
                        <dd class="mt-1 text-xs lg:hidden">
                            <span class="font-bold">Kelompok:
                            </span>{{ $user->kelompok->nama }}
                        </dd>
                    </dl>

                </td>
                <td class="px-6 py-3">{{ $user->nimb ?? '-' }}</td>
                <td class="hidden px-6 py-3 text-center lg:table-cell">{{ $user->kelompok->nama }}</td>
                <td class="px-6 py-3 text-center">{{ $user->getIp() }}</td>
            </tr>
        </x-table>
    </x-card>

    <x-card>
        <form wire:submit.prevent="simpanNilai">
            <div class="hidden sm:block">
                <x-table :theads="['Dimensi', 'Indikator', 'SKS', 'nilai', 'grade']" :breakpointVisibility="[
                    1 => ['xl' => 'hidden'], // Hide kelompok on xl
                    2 => ['lg' => 'hidden'], // Hide SKS on lg
                ]">
                    @forelse ($indikator as $index => $nilai)
                        <tr wire:key="nilai-field-{{ $nilai->id }}"
                            class="border-b border-gray-200 hover:bg-blueGray-100
                    {{ $loop->even ? 'bg-gray-50' : '' }}">

                            <td class="px-6 py-3">
                                <dl>
                                    <dd class="font-bold xl:font-semibold">{{ $nilai->dimensi }}</dd>
                                    <dd class="xl:hidden">Indikator: {{ $nilai->nama }}</dd>
                                    <dd class="lg:hidden">SKS: {{ $nilai->sks }}</dd>
                                </dl>
                            </td>
                            <td class="hidden px-6 py-3 xl:table-cell">{{ $nilai->nama }}</td>
                            <td class="hidden px-6 py-3 text-center lg:table-cell">{{ $nilai->sks }}</td>
                            <td class="px-6 py-3 text-center">
                                <x-jet-input id="nilai-{{ $index }}" min=0 max=100 type="number"
                                    class="block w-full mt-1" wire:model.defer="indikator.{{ $index }}.nilai"
                                    step=0.01 />
                            </td>
                            <td class="px-6 py-3 text-center">
                                @if ($nilai->nilai)
                                    {{ getGrade($nilai->nilai) }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                            <td colspan="5" class="px-6 py-3 text-sm italic text-center">Belum ada indikator</td>
                        </tr>
                    @endforelse
                </x-table>
            </div>
            <!-- Responsive Cards for Smaller Screens -->
            <div class="grid grid-cols-1 gap-4 sm:hidden">
                @forelse ($indikator as $index => $nilai)
                    <x-card class="flex flex-col items-start justify-between p-4 space-y-2 font-sans">
                        <div class="flex items-center justify-between w-full item-s">
                            <span class="font-bold text-base-blue-400">
                                {{ $nilai->dimensi }}
                            </span>
                        </div>
                        <div class="mt-1 text-sm font-semibold text-base-blue-400">
                            <span class="font-bold">Indikator: </span>{{ $nilai->nama }}
                        </div>
                        <div class="mt-1 text-sm font-semibold text-base-blue-400">
                            <span class="font-bold">SKS: </span>{{ $nilai->sks }}
                        </div>
                        <div class="flex items-center mt-1 text-sm font-semibold text-base-blue-400">
                            <span class="mr-2 font-bold">Nilai: </span>
                            <x-jet-input id="nilai-{{ $index }}" min=0 max=100 type="number"
                                class="block w-full mt-1" wire:model.defer="indikator.{{ $index }}.nilai"
                                step=0.01 />
                        </div>
                        <div class="mt-1 text-sm font-semibold text-base-blue-400">
                            <span class="font-bold">Grade: </span>
                            @if ($nilai->nilai)
                                {{ getGrade($nilai->nilai) }}
                            @else
                                -
                            @endif
                        </div>
                    </x-card>
                @empty
                    <div class="col-span-1 italic text-center text-gray-500 sm:col-span-2">Belum ada indikator</div>
                @endforelse
            </div>

            <!-- Action Buttons (shared by both views) -->
            <div class="flex items-center justify-end mt-3 sm:mt-0">
                <div>
                    <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="true"
                        href="{{ route('input-nilai') }}">
                        Kembali
                    </x-button>
                    <x-button class="cursor-pointer rounded-3xl bg-base-orange-500 hover:bg-base-orange-600"
                        wire:loading.class="hidden">
                        Simpan
                    </x-button>
                    <div wire:loading wire:target="simpanNilai" class="text-xs text-gray-500">
                        Menyimpan ...
                    </div>
                </div>
            </div>
        </form>
    </x-card>

</div>
