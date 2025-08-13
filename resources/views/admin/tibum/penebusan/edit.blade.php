<div x-cloak x-show="openedit" x-data="{ showCatatan: false }">
    <x-modal>
        @if ($selected)
            <div class="px-5 py-6 bg-white">
                <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-700 capitalize">Penebusan
                        <b>{{ $selected->user->name }}</b>
                    </p>
                    <p class="text-xs text-gray-600">
                        <span class="text-sm text-gray-400">{{ $selected->user->username }}</span>
                        <x-badge-status-penebusan category="{{ $selected->status }}" />
                    </p>
                </div>

                <form wire:submit.prevent="update">
                    <div class="mb-3">
                        <x-label-input for="jenispoin">Jenis Poin</x-label-input>
                        <h3>{{ $jenispoin }}</h3>
                    </div>


                    <div class="mb-3">
                        <x-label-input for="deadline4">Deadline</x-label-input>
                        @if (!$canEditDeadline)
                            <h3> {{ $selected->deadline ? formatDateIso($selected->deadline, 'dddd, Do MMMM H:mm') . ' WIB' : '' }}
                            </h3>
                        @else
                            <p class="mb-1 text-xs text-gray-500">Anda dapat mengubah deadline jika diperlukan</p>
                            <x-date-input wire:model.defer="deadline" name="deadline"
                                disabled="{{ !$canEditDeadline }}" />
                            <x-error-input name="deadline" />
                        @endif
                    </div>

                    @if ($selected->status != PENEBUSAN_MENUNGGU_UPLOAD && $selected->status != PENEBUSAN_TERLAMBAT)

                        <div class="mb-3">
                            <x-label-input for="status">Status</x-label-input>
                            <x-select-form wire:model.lazy="status"
                                x-on:change="showCatatan = ($el.value == 'Butuh Revisi')">
                                <option value="" class="hidden" selected="selected">Pilih status...</option>
                                <option value="{{ PENEBUSAN_BUTUH_REVISI }}">{{ PENEBUSAN_BUTUH_REVISI }}</option>
                                <option value="{{ PENEBUSAN_SELESAI }}">{{ PENEBUSAN_SELESAI }}</option>
                            </x-select-form>
                            <x-error-input name="status" />
                        </div>

                        <div x-show='showCatatan' class="mb-3">
                            <x-label-input for="catatan">Catatan Revisi</x-label-input>
                            <x-textarea name="catatan" wire:model.defer="catatan" cols="30" rows="6">
                            </x-textarea>
                        </div>

                        <div class="mb-3">
                            <x-label-input for="file">Tugas</x-label-input>

                            @if ($file)
                                <?php
                                try {
                                    $urlAtribute = $file->temporaryUrl();
                                    $statusFile = true;
                                } catch (RuntimeException $exception) {
                                    $statusFile = false;
                                }
                                ?>
                            @endif

                            <div class="flex items-center">

                                @if ($selected->status == PENEBUSAN_SEDANG_DIKOREKSI)
                                    <label for="fileUpload2"
                                        class="px-3 py-1 text-xs text-white cursor-pointer rounded-3xl bg-base-green-300 hover:bg-base-green-400">Pilih
                                        File</label>
                                    <input type="file" wire:model="file" id="fileUpload2" class="hidden">
                                @endif

                                @if ($selected && $selected->link)
                                    <a href="{{ storage($selected->link) }}"
                                        class="px-3 py-1 ml-2 text-xs text-white cursor-pointer rounded-3xl bg-base-blue-300 hover:bg-base-blue-400"
                                        download="{{ str_replace('penebusan/', '', $selected->link) }}">File
                                        Sekarang</a>
                                @endif

                                @if ($file && $statusFile)
                                    <a href="{{ $urlAtribute }}"
                                        class="px-3 py-1 ml-2 text-xs text-white cursor-pointer rounded-3xl bg-base-blue-300 hover:bg-base-blue-400"
                                        download>File Baru</a>
                                @endif
                            </div>

                            <p class="mt-2 text-xs text-gray-500">
                                File maksimal <b>2MB</b>. Prioritaskan file dalam bentuk pdf tapi jika file lebih dari 1
                                maka
                                gunakan format zip. Mengupload file baru akan menghapus file yang lama dan tidak akan
                                dapat
                                dikembalikan.
                            </p>

                            @if ($selected && $selected->link && $selected->submited_at)
                                <p class="mt-2 text-xs font-semibold text-gray-500">
                                    {{ $selected->user->name }} mengupload file pada
                                    {{ formatDateIso($selected->submited_at) }}
                                </p>
                            @endif


                            <x-error-input name="file" />

                            <div x-show="isUploading">
                                <img wire:loading src="{{ asset('/img/icon/loading-ring-bg-white.svg') }}"
                                    class="h-10 my-0" alt="">
                                Uploading: <span x-text="progress"></span>%
                            </div>
                        </div>
                    @endif

                    <div class="flex justify-end mt-4">
                        <div wire:loading.remove wire:target="update">
                            <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                type="button" x-on:click="openedit = false; showCatatan = false" wire:click="resetAll">
                                Batal
                            </x-button>
                            <x-button class="uppercase rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 text-md"
                                type="submit" x-on:click="showCatatan = false" wire:loading.remove wire:target="file">
                                Edit Penebusan
                            </x-button>
                        </div>

                        <div wire:loading wire:target="update" class="text-xs italic text-gary-600">
                            Sedang memproses. Harap menunggu ..
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </x-modal>
</div>
