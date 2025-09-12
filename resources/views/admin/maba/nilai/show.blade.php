<div>
    <x-card>
        <div class="flex items-center justify-between mb-3">
            <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Maba</h5>
        </div>
        <div class="mb-3">
            <x-select-form name="kelompok" id="kelompok" wire:model.blur="kelompok">
                <option value="-1">Semua Kelompok</option>
                @foreach ($daftar_kelompok as $k)
                    <option value='{{ $k->id }}'>{{ $k->nama }}</option>
                @endforeach
            </x-select-form>
        </div>

        <x-input wire:model.live.debounce.200ms="search" type="text" placeholder="Cari berdasarkan nama atau nimb"
            class="block w-full mb-3 placeholder-gray-400" />

        <x-table :theads="['nama', 'nimb', 'kelompok', 'ipk', 'aksi']" :breakpointVisibility="[
            2 => ['lg' => 'hidden'], // Hide kelompok on lg
            1 => ['sm' => 'hidden'], // Hide nimb on sm
            3 => ['sm' => 'hidden'], // Hide IPK on sm
        ]">
            <slot>
                @forelse ($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                        <td class="px-6 py-3">
                            <dl>
                                <dd class="font-bold xl:font-medium">{{ $user->name }}</dd>
                                <dd class="mt-1 text-xs sm:hidden">
                                    <span class="font-bold">NIMB:
                                        {{ $user->nimb ?? '-' }}
                                </dd>
                                <dd class="mt-1 text-xs lg:hidden">
                                    <span class="font-bold">Kelompok:
                                    </span>{{ $user->kelompok->nama }}
                                </dd>
                                <dd class="mt-1 text-xs sm:hidden">
                                    <span class="font-bold">IPK: </span>
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white rounded-full whitespace-nowrap bg-coklat-1">
                                        {{ $user->getIp() }}</span>
                                </dd>
                            </dl>

                        </td>
                        <td class="hidden px-6 py-3 text-center sm:table-cell">{{ $user->nimb ?? '-' }}</td>
                        <td class="hidden px-6 py-3 text-center lg:table-cell">{{ $user->kelompok->nama }}</td>
                        <td class="hidden px-6 py-3 text-center sm:table-cell">{{ $user->getIp() }}</td>
                        <td class="px-6 py-3 text-center">
                            @if ($canUpdateAll || in_array($user->kelompok_id, $kelompokCanEdit))
                                <x-button class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover mx-0.5" :tagA="true"
                                    href="{{ route('input-nilai.detail', ['id' => $user->id]) }}">
                                    Beri Nilai
                                </x-button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                        <td colspan="5" class="px-6 py-3 text-sm italic text-center">Tidak ada user</td>
                    </tr>
                @endforelse

            </slot>
        </x-table>

        <div class="mt-3">
            {{ $users->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
        </div>
    </x-card>
</div>
