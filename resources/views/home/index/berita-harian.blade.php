<div class="bg-kuning-pattern" style="border-radius: 30px 30px 30px 30px;">
    <div class="static px-0 pb-10 mt-5 bg-bottom bg-repeat-x" id="serba-serbi" style="border-radius: 30px 30px 30px 30px;">

        <div class="flex justify-center m-8">
            <div class="relative w-full p-0">
                <div class="flex items-center justify-center w-auto h-auto pl-3 mt-8"
                    style="border-radius: 30px 30px 0px 0px; background: #8B4513">
                    <div class="flex items-center justify-center w-full h-auto text-center">
                        <div class="flex items-center justify-center w-full px-10 py-1 text-3xl font-normal leading-normal text-center text-white lg:px-40 md:px-28 sm:px-16 bg-coklat3-pattern lg:text-5xl md:text-4xl font-bohemianSoul"
                            style="border-radius: 30px 30px 0px 0px">
                            Lini Masa
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kotak Berita -->
        <div class="lg:pl-16 lg:pr-16 pb-14">

            <div class="owl-carousel berita-carousel lg:pt-12">
                @foreach ($berita as $b)
                    <div class="shadow-2xl overflow-hidden z-10 relative h-[28rem]"
                        style="border-radius: 2.5rem 2.5rem 0rem 0rem;">
                        <div class="block h-full">
                            <div class="overflow-hidden w-full h-[60%]"
                                style="border-radius: 2.5rem 2.5rem 0rem 0rem; border: 3px solid #3F2A1D; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                                <img class="z-0 block object-cover w-full h-full" src="{{ storage($b->thumbnails) }}"
                                    alt="Foto Berita">
                            </div>
                            <div class="bg-black flex justify-center bg-opacity-60 items-end h-[40%] ">
                                <div
                                    class="z-10  w-3/4 h-full md:w-[85%] w-[95%] overflow-hidden bg-gray-50 rounded-lg">
                                    <div class="top-0 w-full pt-2 pl-4 pr-5 h-11" style="background: #3F2A1D;">
                                        <p class="text-2xl font-bold leading-normal font-nunito"
                                            style="color: #ECECEC;">
                                            {{ strlen(strip_tags($b->judul)) > 25 ? substr_replace(preg_replace('/\s|&nbsp;/', ' ', strip_tags($b->judul)), '...', 25) : $b->judul }}
                                        </p>
                                    </div>
                                    <p class="pt-2 pl-4 pr-5 text-sm font-medium leading-tight font-nunito"
                                        style="color: #434343;">
                                        {{ substr_replace(preg_replace('/\s|&nbsp;/', ' ', strip_tags($b->content)), '...', 100) }}
                                    </p>

                                    <div class="flex justify-end pr-5 mt-3 mb-4">
                                        <button type="button" onclick="toggleModal('{{ $b->id }}')"
                                            class="px-8 py-2 text-base font-semibold transition-all duration-500 border rounded-full hover:bg-coklat-2 hover:text-gray-50 text-coklat-1 font-poppins"
                                            style="width: 6.4375rem; height: 2.4375rem; border-color:#3F2A1D; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                                            Baca
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @livewire('home.modal-berita')

</div>


@push('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush


@push('script-bottom')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script type="text/javascript">
        function toggleModal(id) {
            Livewire.emit('openModalBeritaHarian', `${id}`)
        }
        $(document).ready(function() {
            $(".berita-carousel").owlCarousel({
                loop: true,
                nav: false,
                center: {{ $berita->count() == 1 ? 'true' : 'false' }},
                margin: 26,
                items: {{ $berita->count() }},
                dotsClass: "custom-berita-dots",
                dotClass: "custom-berita-dot",
                responsive: {
                    0: {
                        items: 1
                    },
                    1000: {
                        items: 2.5
                    }
                },
                navText: [
                    '<div class="custom-nav-prev"></div>',
                    '<div class="custom-nav-next"></div>'
                ]
            });
        });
    </script>
@endpush
