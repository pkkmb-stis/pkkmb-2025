<div>
    <div>
        <div class="w-full text-center">
            <img wire:loading wire:target="show,edit" src="{{ asset('/img/icon/loading-ring.svg') }}" class="h-10 my-0"
                alt="Loading Indikator">
        </div>
        <x-card class="mb-8">
            {{-- BAGIAN JUDUL DAN TOMBOL AKSI --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-5">
                <h5 class="text-xl font-semibold text-gray-800 font-bohemianSoul mb-3 sm:mb-0">Daftar Poin Kelompok</h5>
                <div class="flex flex-row-reverse">
                    @can(PERMISSION_SHOW_POIN_KELOMPOK)
                        @livewire('admin.maba.poin.kelompok.add')
                    @endcan
                </div>
            </div>

            {{-- PANEL FILTER YANG BARU --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-4 border-t border-gray-200">
                
                {{-- Kolom Kiri: Filter Sederhana --}}
                <div class="space-y-4">
                    <div>
                        <x-label-input for="search">Cari Nama Kelompok</x-label-input>
                        <x-input wire:model.debounce.200ms="search" id="search" type="text" placeholder="Ketik untuk mencari..."
                            class="block w-full placeholder-gray-400" />
                    </div>
                    <div>
                        <x-label-input for="tipePoin">Filter Tipe Poin</x-label-input>
                        <select wire:model="tipePoin" id="tipePoin" class="w-full default-select">
                            <option value="-1">Semua Tipe Poin</option>
                            <option value="{{ CATEGORY_JENISPOIN_PENGHARGAAN }}">Penghargaan</option>
                            <option value="{{ CATEGORY_JENISPOIN_PELANGGARAN }}">Pelanggaran</option>
                        </select>
                    </div>
                </div>
            
                {{-- Kolom Kanan: Filter Tanggal --}}
                <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                    <p class="text-sm font-semibold text-gray-700 mb-3">Filter Berdasarkan Tanggal</p>
                    
                    <div class="flex items-center space-x-4 mb-3">
                        <div class="flex items-center">
                            <input wire:model="filterDateMode" id="filter_mode_dropdown" type="radio" value="dropdown" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <label for="filter_mode_dropdown" class="ml-2 block text-sm text-gray-900">Pilih Hari</label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="filterDateMode" id="filter_mode_manual" type="radio" value="manual" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <label for="filter_mode_manual" class="ml-2 block text-sm text-gray-900">Input Manual</label>
                        </div>
                    </div>
                    
                    <div>
                        @if ($filterDateMode === 'dropdown')
                        <div>
                            <select wire:model.lazy="selected_day_kelompok" class="w-full default-select">
                                <option value="">-- Semua Hari --</option>
                                @foreach(\App\Models\Day::getDropdownOptionsWithDescription() as $name => $description)
                                    <option value="{{ $name }}">{{ $description }}</option>
                                @endforeach
                            </select>
                        </div>
                        @elseif ($filterDateMode === 'manual')
                        <div>
                            <x-input type="date" class="w-full" wire:model.lazy="tanggal_poin_kelompok" />
                        </div>
                        @endif
                    </div>
                    
                    @if($selected_day_kelompok || $tanggal_poin_kelompok)
                    <div class="mt-2 text-right">
                        <button wire:click="resetFilter" type="button" class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition">Reset Filter</button>
                    </div>
                    @endif
                </div>
            </div>

            {{-- TABEL DATA --}}
            <div class="mt-6">
                <x-table :theads="['Nama Kelompok', 'Kategori', 'Poin', 'Terakhir Update']" class="mb-3" :breakpointVisibility="[
                    3 => ['lg' => 'hidden'],
                    1 => ['md' => 'hidden'],
                ]">
                    <slot>
                        @forelse ($poin_kelompok as $pk)
                            <tr
                                class="border-b border-gray-200 hover:bg-gray-50 {{ $loop->even ? 'bg-white' : 'bg-gray-50' }}">
                                <td class="px-6 py-4 text-left lg:text-center">
                                    <span class="font-medium text-gray-800">{{ $pk->nama_kelompok }}</span>
                                    <dl class="-ml-0.5">
                                        <dd class="ml-0.5 mt-1 md:hidden ">
                                            <x-badge-poin :category="$pk->kategori" />
                                        </dd>
                                        <dd class="lg:hidden mt-1 ml-0.5 text-xs text-gray-500 italic">
                                            Diupdate pada {{ $pk->terakhir_update }}
                                        </dd>
                                    </dl>
                                </td>
                                <td class="hidden px-6 py-4 text-center md:table-cell">
                                    <x-badge-poin :category="$pk->kategori" />
                                </td>
                                <td class="px-6 py-4 text-center font-semibold text-gray-700">{{ $pk->poin_sum }}</td>
                                <td class="hidden px-6 py-4 text-center text-sm text-gray-600 lg:table-cell">{{ $pk->terakhir_update }}</td>
                            </tr>
                        @empty
                            <tr class="border-b border-gray-200">
                                <td colspan="4" class="px-6 py-5 italic text-center text-gray-500">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </slot>
                </x-table>
            </div>

            <div class="mt-4">
                {{ $poin_kelompok->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
            </div>
        </x-card>
    </div>
</div>