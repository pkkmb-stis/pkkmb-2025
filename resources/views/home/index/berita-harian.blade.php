<!-- ===== HEADER SERBA SERBI ===== -->
<div class="flex justify-center mt-6 mb-10 sm:mt-10 lg:mt-12">
  <div class="relative w-full">
    <!-- Layer background biru tua -->
    <div class="w-full bg-[#1C2E4A] relative flex items-center justify-center
                h-12 sm:h-14 md:h-16 lg:h-20 xl:h-20">

      <!-- Ornamen kiri -->
      <img src="{{ asset('img/asset/2025/ornament serba_serbi.png') }}"
          alt="ornamen kiri"
          class="absolute left-0 z-20 object-contain w-16 -translate-y-1/2 sm:w-20 md:w-28 lg:w-36 xl:w-40 top-1/2" />

      <!-- Ornamen kanan -->
      <img src="{{ asset('img/asset/2025/ornament serba_serbi.png') }}"
          alt="ornamen kanan"
          class="absolute right-0 object-contain top-1/2 -translate-y-1/2 scale-x-[-1]
                 w-16 sm:w-20 md:w-28 lg:w-36 xl:w-40 z-20" />

      <!-- Judul di tengah -->
      <div class="relative bg-[#8B2F4B] text-[#F9C46B] font-bohemianSoul
                  flex items-center justify-center text-center
                  h-full w-8/12 sm:w-10/12 md:w-8/12 lg:w-9/12
                  text-base sm:text-lg md:text-2xl lg:text-3xl xl:text-4xl
                  rounded-lg shadow-lg px-3 sm:px-6 z-10">
        Lini Masa
      </div>

    </div>
  </div>
</div>



<div class="bg-repeat bg-linimasa-gradient bg-blend-overlay">
  <!-- ORNAMEN GARIS CEMPAKA BIRU -->
  <div class="w-full">
    <img src="{{ asset('img/asset/2025/garis cempaka biru.png') }}"
    alt="ornamen garis"
    class="object-cover w-full">
  </div>

  <!-- Tambahkan padding agar tidak mepet di HP -->
  <div id="serba-serbi" class="px-4 sm:px-6 md:px-10 lg:px-16 pb-10 mt-5 rounded-[30px] bg-repeat-x bg-merah">

    <!-- Kotak Berita (Carousel) -->
    <div class="relative pt-4 pb-8 lg:pt-8"> <!-- relative penting untuk panah -->
      <div class="owl-carousel berita-carousel">

        @foreach ($berita as $b)
          <div class="relative overflow-hidden shadow-xl
                      w-[90%] sm:w-[20rem] md:w-[22rem] lg:w-[26rem]
                      rounded-[1.5rem] border-[2px] border-[#F9C46B] bg-white mx-auto
                      flex flex-col h-full">

            <!-- FOTO BERITA -->
            <div class="w-full overflow-hidden rounded-t-[1.5rem]">
              <img class="object-cover w-full h-40 sm:h-48 md:h-56 lg:h-60"
                   src="{{ storage($b->thumbnails) }}"
                   alt="Foto Berita">
            </div>

            <!-- KONTEN CARD -->
            <div class="flex flex-col justify-between bg-gray-50 rounded-b-[1.5rem] flex-1">

              <!-- JUDUL -->
              <div class="flex items-center w-full px-4 py-2 bg-[#F9C46B]">
                <p class="font-nunito font-bold text-[#1E2A4A]
                          text-sm sm:text-base md:text-lg lg:text-xl truncate">
                  > {{ strlen(strip_tags($b->judul)) > 25
                      ? substr_replace(preg_replace('/\s|&nbsp;/', ' ', strip_tags($b->judul)), '...', 25)
                      : $b->judul }}
                </p>
              </div>

              <!-- DESKRIPSI -->
              <p class="flex-1 px-4 pt-2 text-xs font-medium leading-tight text-gray-700
                         sm:text-sm md:text-base font-nunito min-h-[60px]">
                {{ substr_replace(preg_replace('/\s|&nbsp;/', ' ', strip_tags($b->content)), '...', 100) }}
              </p>

              <!-- BUTTON BACA -->
              <div class="flex justify-end px-4 pb-4 mt-3">
                <button type="button" onclick="toggleModal('{{ $b->id }}')"
                  class="px-6 py-2 text-sm font-semibold text-[#1E2A4A] bg-[#F9C46B]
                         rounded-full shadow-md hover:bg-[#E7B556] transition font-poppins">
                  Baca
                </button>
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

  <style>
    .berita-carousel .owl-stage {
      display: flex !important;
      align-items: stretch !important;
    }
    .berita-carousel .owl-item {
      display: flex;
      padding: 6px; /* jarak antar card */
    }
    .berita-carousel .owl-item > div {
      display: flex;
      flex: 1 1 auto;
    }

    /* ==== STYLE PANAH BERITA (sama dengan galeri) ==== */
    .berita-carousel {
      position: relative;
    }

    /* Default (PC/Laptop): panah kanan-kiri di luar */
    .berita-carousel .owl-nav {
      position: absolute;
      top: 50%;
      left: -60px;
      right: -60px;
      transform: translateY(-50%);
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: calc(100% + 120px);
      pointer-events: none;
      z-index: 50;
    }

    .berita-carousel .owl-nav button {
      background: #F9C46B !important;
      color: #1E2A4A !important;
      font-size: 1.5rem !important;
      width: 46px;
      height: 46px;
      border-radius: 50%;
      border: none !important;
      outline: none !important;
      box-shadow: 0 4px 6px rgba(0,0,0,0.25);
      transition: all 0.3s ease;
      pointer-events: auto;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .berita-carousel .owl-nav button:hover {
      background: #E7B556 !important;
      color: #fff !important;
      transform: scale(1.1);
    }

    /* Versi HP: panah di bawah tengah */
    @media (max-width: 640px) {
      .berita-carousel .owl-nav {
        position: relative;
        top: auto;
        bottom: -20px;
        left: auto;
        right: auto;
        transform: none;
        margin-top: 12px;
        width: 100%;
        justify-content: center;
        gap: 12px;
      }

      .berita-carousel .owl-nav button {
        font-size: 1.2rem !important;
        width: 38px;
        height: 38px;
      }
    }
  </style>
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
        nav: {{ $berita->count() > 1 ? 'true' : 'false' }},
        navText: [
    '<span class="custom-prev">&#10094;</span>',
    '<span class="custom-next">&#10095;</span>'
  ],
  center: {{ $berita->count() == 1 ? 'true' : 'false' }},
  dots: false,
  autoplay: true,
  autoplayTimeout: 4000,
  autoplayHoverPause: true,
  smartSpeed: 800,
  responsive: {
      0: { items: 1, margin: 16 },
      480: { items: 1.2, margin: 18 },
      640: { items: 1.5, margin: 20 },
      768: { items: 2, margin: 24 },
      1024: { items: 2.5, margin: 28 }
   }
          });
      });

  </script>
@endpush
<!-- ===== END HEADER SERBA SERBI ===== -->
