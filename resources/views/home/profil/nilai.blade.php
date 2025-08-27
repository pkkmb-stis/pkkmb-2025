<div>
    @if (empty($unfilledFormulirs))
        @if (canAksesNilai() && auth()->user()->status_kelulusan)
            @if (auth()->user()->status_kelulusan == STATUS_LULUS_PKKMB_PKBN)
                <div class="flex items-center px-4 py-3 mb-2 font-semibold text-white rounded-md bg-hijau-1">
                    <i class="mr-2 fa-solid fa-check-double"></i>
                    <small class="text-sm">Selamat! Kamu dinyatakan <b>LULUS</b> PKKMB-PKBN 2024.</small>
                </div>
            @endif

            @if (auth()->user()->status_kelulusan == STATUS_LULUS_PKKMB)
                <div
                    class="flex items-center px-4 py-3 mb-2 font-semibold text-gray-600 rounded-md bg-base-yellow-200 opacity-90">
                    <i class="mr-2 fa-solid fa-check"></i>
                    <small class="text-sm">Kamu hanya dinyatakan <b>LULUS</b> PKKMB 2024. Silakan mengikuti PKBN pada
                        tahun berikutnya.</small>
                </div>
            @endif

            @if (auth()->user()->status_kelulusan == STATUS_LULUS_PKBN)
                <div class="flex items-center px-4 py-3 mb-2 font-semibold text-white rounded-md bg-hijau-1 opacity-90">
                    <i class="mr-2 fa-solid fa-check"></i>
                    <small class="text-sm">Selamat! Kamu dinyatakan <b>LULUS</b> PKBN 2024.</small>
                </div>
            @endif

            @if (auth()->user()->status_kelulusan == STATUS_LULUS_BERSYARAT)
                <div class="flex items-center px-4 py-3 mb-2 font-semibold text-white rounded-md bg-merah-500">
                    <i class="mr-2 fa-solid fa-times-circle"></i>
                    <small class="text-sm">Kamu dinyatakan <b>LULUS BERSYARAT</b>. Silakan hubungi PK untuk info lebih
                        lanjut.</small>
                </div>
            @endif

            @if (auth()->user()->status_kelulusan == STATUS_TIDAK_LULUS)
                <div
                    class="flex items-center px-4 py-3 mb-2 font-semibold text-white rounded-md bg-merah-500 opacity-90">
                    <i class="mr-2 fa-solid fa-times-circle"></i>
                    <small class="text-sm">Maaf, kamu dinyatakan <b>TIDAK LULUS</b> PKKMB-PKBN 2024. Silakan mengulang
                        pada tahun berikutnya.</small>
                </div>
            @endif

            <x-card>
                @if (auth()->user()->status_kelulusan != STATUS_LULUS_PKBN)
                    <x-table :theads="['Dimensi', 'Indikator', 'SKS', 'nilai']">
                        @forelse ($indikator as $index => $nilai)
                            <tr
                                class="{{ $loop->even ? 'bg-gray-50' : '' }} border-b border-gray-200 hover:bg-blueGray-100">
                                <td class="px-6 py-3">{{ $nilai->dimensi }}</td>
                                <td class="px-6 py-3">{{ $nilai->nama }}</td>
                                <td class="px-6 py-3 text-center">{{ $nilai->sks }}</td>
                                <td class="px-6 py-3 text-center">
                                    @if ($nilai->nilai)
                                        {{ getGrade($nilai->nilai) }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                            <td colspan="3" class="px-6 py-3 text-center">Indeks Prestasi Kumulatif (IPK)</td>
                            <td class="px-6 py-3 text-center">{{ $ip == 0 ? '-' : $ip }}</td>
                        </tr>
                    </x-table>
                @endif

                <div class="flex flex-col items-start justify-between mt-4 lg:flex-row lg:items-center">
                    {{-- @if (auth()->user()->status_kelulusan == STATUS_LULUS_PKKMB_PKBN || auth()->user()->status_kelulusan == STATUS_LULUS_PKKMB || auth()->user()->status_kelulusan == STATUS_LULUS_PKBN)
                        <small class="mb-3 mr-3 italic text-gray-600 lg:mb-0">
                            Segara download dan simpan sertifikatmu, karena tahun depan web ini akan hilang dan diganti
                            dengan
                            PKKMB tahun selanjutnya
                        </small>
                    @endif --}}
                    {{-- @if (auth()->user()->status_kelulusan == STATUS_LULUS_PKKMB_PKBN || auth()->user()->status_kelulusan == STATUS_LULUS_PKKMB)
                        <x-button :tagA="true"
                            class="my-4 uppercase text-md whitespace-nowrap rounded-3xl bg-coklat-2 hover:bg-coklat-hover md:my-0 md:mr-2"
                            target="_blank" href="{{ route('home.sertifikat') }}">
                            Download Sertifikat PKKMB
                        </x-button>
                    @endif --}}
                    @if (auth()->user()->status_kelulusan == STATUS_LULUS_BERSYARAT)
                        <x-button :tagA="true"
                            class="ml-auto text-right uppercase rounded-3xl text-md whitespace-nowrap bg-coklat-2 hover:bg-coklat-hover"
                            target="_blank" href="https://wa.me/{{ $nowa }}">
                            Hubungi PK
                        </x-button>
                    @endif
                    {{-- @if (auth()->user()->status_kelulusan == STATUS_LULUS_PKKMB_PKBN || auth()->user()->status_kelulusan == STATUS_LULUS_PKBN)
                        <x-button :tagA="true"
                            class="uppercase rounded-3xl text-md whitespace-nowrap bg-coklat-2 hover:bg-coklat-hover"
                            target="_blank" href="{{ route('home.sertifikat-pkbn') }}">
                            Download Sertifikat PKBN
                        </x-button>
                    @endif --}}
                </div>
            </x-card>
        @else
            <div class="flex items-center px-4 py-3 mb-2 font-semibold text-gray-600 rounded-md bg-base-yellow-200">
                <i class="mr-2 fa-solid fa-exclamation-triangle"></i>
                <small class="text-sm">Maaf, nilaimu belum dapat diakses</small>
            </div>
        @endif
    @else
        <div class="p-3 text-sm text-center text-black rounded-md font-bohemianSoul md:text-base bg-base-yellow-200">
            <p>Untuk melihat nilai, silakan mengisi formulir berikut: </p>
        </div>
        <div class="mx-4 sm:mx-8">
            @if (!empty($unfilledFormulirs))
                <ul class="mt-6">
                    @foreach ($unfilledFormulirs as $formulir)
                        <li>
                            <div class="flex justify-center mt-4">
                                <x-button tagA="true" href="{{ $formulir->link_form }}" target="_blank"
                                    class="block w-3/4 text-sm text-center rounded-full md:text-base bg-merah-1 hover:bg-opacity-90">
                                    Isi {{ $formulir->nama_formulir }}
                                </x-button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
</div>
