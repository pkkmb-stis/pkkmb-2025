<div x-data="{ showModalPengumuman: @if (session('openAnnouncementModal')) true @else false @endif, hover: false, show: true, openDetailPengumuman: '' }">
    <!-- Tombol untuk membuka modal -->
    <div class="border-white-300 mt-4 h-12 w-12 scale-75 transform cursor-pointer rounded-full border-2 bg-[#4FABF7] shadow-lg transition-all hover:scale-90 md:scale-95 md:hover:scale-105"
        x-on:click="showModalPengumuman = true" x-on:mouseover="hover = true; show = false"
        x-on:mouseleave="show = true; hover = false" wire:mouseover="$refresh">

        <div x-cloak
            class="border-white-300 {{ $count == 0 ? 'hidden' : '' }} absolute right-[-0.75rem] top-[-0.55rem] flex h-[1.25rem] w-[1.25rem] items-center justify-center rounded-full border-2 bg-blue-500 text-center font-nunito text-[0.75rem] font-bold text-white">
            {{ $count }}
        </div>
        <div class="relative flex items-center justify-center w-full h-full">
            <div x-cloak x-show="show" class="z-10">
                <img src="{{ asset('img/icon/pengumuman-icon.png') }}" alt="pengumuman">
            </div>
            <div x-cloak x-show="hover" class="ml-3 mr-3 text-2xl font-bold text-center text-white">
                <h1>{{ $count ?? '0' }}</h1>
            </div>
        </div>
    </div>

    <!-- Modal Pengumuman -->
    <div x-cloak x-show="showModalPengumuman">
        <x-modal.home judul="Pengumuman">
            <x-slot name="closeButton">
                <div x-on:click="openDetailPengumuman = ''; showModalPengumuman = false">
                    <x-close-button />
                </div>
            </x-slot>

            <!-- Konten modal -->
            <div class="mt-2 divide-y">
                @forelse ($contents as $c)
                    <div class="p-2 cursor-pointer" x-on:click='openDetailPengumuman = {{ $c->id }}'>
                        <div
                            class="flex flex-col-reverse justify-between p-2 sm:flex-row hover:bg-blueGray-200 hover:bg-opacity-50">
                            <p class="font-semibold text-md text-gray-50">{{ $c->title }}</p>
                            <small
                                class="text-xs italic text-gray-100">{{ formatDateIso($c->publish_datetime, 'dddd, D MMMM YYYY, HH:mm') }}
                                WIB</small>
                        </div>

                        <div class="overflow-hidden rounded-lg border-solid border-2 bg-[#990101]"
                            x-show="openDetailPengumuman === {{ $c->id }}"
                            x-on:click.outside="openDetailPengumuman = ''">
                            <div class="m-2 text-white">
                                <p class="ql-editor" x-effect="$el.innerHTML = '{{ $c->content }}'"></p>
                            </div>
                            @if ($c->image)
                                <div class="flex justify-center mt-4">
                                    <img src="{{ asset('storage/images/upload-pengumuman/' . $c->image) }}"
                                        alt="Image" class="max-h-[60vh] max-w-[80vw] object-contain">
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="px-6 py-3 text-sm italic text-center">Belum ada pengumuman</p>
                @endforelse
            </div>
        </x-modal.home>
    </div>
    @push('css')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endpush

    @push('script-bottom')
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    @endpush
</div>
