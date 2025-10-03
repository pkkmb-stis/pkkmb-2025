<div>
    <div>
        <div class="w-full text-center">
            <img wire:loading wire:target="show,edit" src="{{ asset('/img/icon/loading-ring.svg') }}" class="h-10 my-0"
                alt="Loading Indikator">
        </div>
        <x-card class="mb-8">
            <div class="flex items-center justify-between mb-5">
                <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Poin User</h5>
                <div class="flex flex-row-reverse">
                    @livewire('admin.maba.poin.user.rekap-harian')
                </div>
            </div>
            
            {{-- BLOK FILTER BARU YANG SUDAH DITATA ULANG --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <x-label-input for="jenisUser">Filter Jenis User</x-label-input>
                    <x-select-form name="jenisUser" id="jenisUser" wire:model.lazy="jenisUser">
                        <option value="semua">Maba dan Panitia</option>
                        <option value="maba">Maba</option>
                        <option value="panitia">Panitia</option>
                    </x-select-form>
                </div>

                <div>
                    <x-label-input for="tipePoin">Filter Tipe Poin</x-label-input>
                    <x-select-form name="tipePoin" id="tipePoin" wire:model.lazy="tipePoin">
                        <option value="-1">Semua Tipe Poin</option>
                        <option value="{{ CATEGORY_JENISPOIN_PENGHARGAAN }}">Penghargaan</option>
                        <option value="{{ CATEGORY_JENISPOIN_PELANGGARAN }}">Pelanggaran</option>
                        <option value="{{ CATEGORY_JENISPOIN_PENEBUSAN }}">Penebusan</option>
                    </x-select-form>
                </div>

                <div class="md:col-span-2 p-3 bg-gray-50 border border-gray-200 rounded-md">
                    <p class="text-sm font-medium text-gray-800 mb-2">Filter Tanggal</p>
                    <div class="flex items-center space-x-4 mb-3">
                        <div class="flex items-center">
                            <input wire:model="filterDateMode" id="filter_user_mode_dropdown" type="radio" value="dropdown" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <label for="filter_user_mode_dropdown" class="ml-2 block text-sm text-gray-900">Pilih Hari</label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="filterDateMode" id="filter_user_mode_manual" type="radio" value="manual" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <label for="filter_user_mode_manual" class="ml-2 block text-sm text-gray-900">Input Manual</label>
                        </div>
                    </div>
                    <div>
                        @if ($filterDateMode === 'dropdown')
                        <div>
                            <select wire:model.lazy="selected_day_user" class="w-full default-select">
                                <option value="">-- Semua Hari --</option>
                                @foreach(\App\Models\Day::getDropdownOptionsWithDescription() as $name => $description)
                                    <option value="{{ $name }}">{{ $description }}</option>
                                @endforeach
                            </select>
                        </div>
                        @elseif ($filterDateMode === 'manual')
                        <div>
                            <x-input type="date" class="w-full" wire:model.lazy="tanggal_poin_user" />
                        </div>
                        @endif
                    </div>
                    @if($selected_day_user || $tanggal_poin_user)
                    <div class="mt-2 text-right">
                        <button wire:click="resetFilter" type="button" class="text-xs text-indigo-600 hover:text-indigo-800">Reset Filter Tanggal</button>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <x-input wire:model.debounce.200ms="search" type="text" placeholder="Cari Nama User..."
                    class="block w-full placeholder-gray-400" />
            </div>

            <x-table :theads="['Nama', 'Kategori', 'Jumlah Per Tipe Poin', 'Jumlah Poin', 'Terakhir Update']" class="mb-3" :breakpointVisibility="[
                3 => ['lg' => 'hidden'],
                1 => ['md' => 'hidden'],
            ]">
                <slot>
                    @forelse ($poin_user as $pk)
                        <tr
                            class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                            <td class="px-6 py-3 text-left lg:text-center">
                                {{ $pk->name }}
                                <dl class="-ml-0.5">
                                    <dd class="ml-0.5 mt-1 md:hidden ">
                                        <x-badge-poin :category="$pk->kategori" />
                                    </dd>
                                    <dd class="lg:hidden mt-1 ml-0.5 text-xs italic">
                                        Diupdate pada {{ $pk->terakhir_update }}
                                    </dd>
                                </dl>
                            </td>
                            <td class="hidden px-6 py-3 text-center md:table-cell">
                                <x-badge-poin :category="$pk->kategori" />
                            </td>
                            <td class="px-6 py-3 text-center">{{ $pk->kategori_count }}</td>
                            <td class="px-6 py-3 text-center">{{ $pk->poin_sum }}</td>
                            <td class="hidden px-6 py-3 text-center lg:table-cell">{{ $pk->terakhir_update }}</td>
                        </tr>
                    @empty
                        <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                            <td colspan="6" class="px-6 py-3 italic text-center text-md">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </slot>
            </x-table>

            {{ $poin_user->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
        </x-card>
    </div>
</div>