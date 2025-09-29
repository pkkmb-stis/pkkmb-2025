<x-home-layout menu="Dashboard" title="Dashboard">
    <div class="flex items-center justify-center min-h-screen px-4 sm:px-6 md:px-8 lg:px-10">
        <div class="w-full max-w-3xl pb-8 bg-white rounded-lg bg-opacity-80">
            <div class="rounded-lg bg-merah1-pattern">
                <div class="w-full pb-5">
                    <div class="z-0 flex flex-row items-center w-full">
                        <div class="w-full">
                            <div class="flex flex-row items-center justify-between w-full pt-8 md:px-12">
                                <h2
                                    class="w-full text-3xl font-bold tracking-wide text-center text-white lg:text-5xl md:text-4xl font-aringgo">
                                    PERHATIAN !
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 text-xl font-semibold text-center text-black md:text-2xl font-bohemianSoul">
                <p>Untuk mengakses dashboard, silakan mengisi formulir berikut : </p>
            </div>
            <div class="mx-4 sm:mx-8">
                @if (!empty($unfilledFormulirs))
                    <ul>
                        @foreach ($unfilledFormulirs as $formulir)
                            <li>
                                <div class="flex justify-center mt-4">
                                    <x-button tagA="true" href="{{ $formulir->link_form }}" target="_blank"
                                        class="block w-3/4 text-lg text-center rounded-full bg-2025-2 hover:bg-2025-1">
                                        Isi {{ $formulir->nama_formulir }}
                                    </x-button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="flex justify-center mt-6">
                    <x-button tagA="true" href="{{ route('home.index') }}"
                        class="block w-3/4 text-lg text-center rounded-full bg-abu-1 hover:bg-abu-hover">
                        Kembali Ke Beranda
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
