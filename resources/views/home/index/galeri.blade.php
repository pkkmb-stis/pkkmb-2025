<!-- ===================== HEADER GALERI ===================== -->
<div class="relative flex items-center justify-center w-full py-4 mt-6 overflow-hidden bg-galeri md:py-6">
    <!-- Burung Enggang Kiri -->
    <img src="{{ asset('img/asset/2025/burung_enggang.png') }}"
         alt="Burung Enggang"
         class="flex-shrink-0 w-12 mr-2 sm:w-16 md:w-20 sm:mr-4 md:mr-6">

    <!-- Strip Biru -->
    <div class="strip-biru flex items-center justify-center
                px-4 sm:px-6 md:px-10 py-2 sm:py-3 md:py-5
                bg-[#1D2A44] rounded-md md:rounded-lg w-full max-w-[95%] mx-auto">

        <!-- Ornamen Kiri -->
        <div class="flex items-center gap-1 mr-2 sm:gap-2 md:gap-3 sm:mr-4">
            <img src="{{ asset('img/asset/2025/Cempaka ungu.png') }}" alt="Bunga" class="w-4 sm:w-6 md:w-9">
            <img src="{{ asset('img/asset/2025/Cempaka merah.png') }}" alt="Bunga" class="w-6 sm:w-8 md:w-12">
        </div>

        <!-- Tulisan ditumpuk -->
        <div class="flex flex-col items-center text-center">
            <h1 class="font-caruban text-[#F4C542] tracking-wide
                       text-lg sm:text-2xl md:text-4xl lg:text-5xl leading-tight">
                Galeri PKKMB 2025
            </h1>
        </div>

        <!-- Ornamen Kanan -->
        <div class="flex items-center gap-1 ml-2 sm:gap-2 md:gap-3 sm:ml-4">
            <img src="{{ asset('img/asset/2025/Cempaka merah.png') }}" alt="Bunga" class="w-6 sm:w-8 md:w-12">
            <img src="{{ asset('img/asset/2025/Cempaka ungu.png') }}" alt="Bunga" class="w-4 sm:w-6 md:w-9">
        </div>
    </div>

    <!-- Burung Enggang Kanan -->
    <img src="{{ asset('img/asset/2025/burung_enggang.png') }}"
         alt="Burung Enggang"
         class="flex-shrink-0 w-12 ml-2 sm:w-16 md:w-20 sm:ml-4 md:ml-6 -scale-x-100">
</div>

<!-- ===================== GALERI CAROUSEL ===================== -->
<div class="pt-6 pb-6 bg-fixed bg-cover lg:pb-12 lg:pt-12 opacity">
    <div class="w-11/12 mx-auto mt-6 owl-carousel galeri-carousel">

        <!-- Slide 1 -->
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <img src="{{ asset('img/galeri/1.jpg') }}"
                     class="object-cover w-full h-64 transition-transform transform shadow-md md:h-80 rounded-xl hover:scale-105">
            </div>
            <div>
                <img src="{{ asset('img/galeri/2.jpg') }}"
                     class="object-cover w-full h-64 transition-transform transform shadow-md md:h-80 rounded-xl hover:scale-105">
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="grid grid-cols-3 gap-4">
            <div>
                <img src="{{ asset('img/galeri/3.jpg') }}"
                     class="object-cover w-full h-64 transition-transform transform shadow-md md:h-80 rounded-xl hover:scale-105">
            </div>
            <div>
                <img src="{{ asset('img/galeri/4.jpg') }}"
                     class="object-cover w-full h-64 transition-transform transform shadow-md md:h-80 rounded-xl hover:scale-105">
            </div>
            <div>
                <img src="{{ asset('img/galeri/5.jpg') }}"
                     class="object-cover w-full h-64 transition-transform transform shadow-md md:h-80 rounded-xl hover:scale-105">
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="grid grid-cols-3 gap-4">
            <div>
                <img src="{{ asset('img/galeri/6.jpg') }}"
                     class="object-cover w-full h-64 transition-transform transform shadow-md md:h-80 rounded-xl hover:scale-105">
            </div>
            <div class="col-span-2">
                <img src="{{ asset('img/galeri/7.jpg') }}"
                     class="object-cover w-full h-64 transition-transform transform shadow-md md:h-80 rounded-xl hover:scale-105">
            </div>
        </div>

    </div>
</div>



@push('script-bottom')
<script>
$(document).ready(function () {
    $(".galeri-carousel").owlCarousel({
        loop: true,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        items: 1,
        dots: true,
        nav: true,
        navText: [
            '<span class="custom-prev">&#10094;</span>',
            '<span class="custom-next">&#10095;</span>'
        ],
        responsive: {
            0: { items: 1 },
            768: { items: 1 },
            1024: { items: 1 }
        }
    });
});
</script>

<style>

/* ==== PC/Laptop: Panah di kanan-kiri luar galeri ==== */
.galeri-carousel {
  position: relative;
}

.galeri-carousel .owl-nav {
  position: absolute;
  top: 50%;
  left: -60px;   /* panah kiri keluar */
  right: -60px;  /* panah kanan keluar */
  transform: translateY(-50%);
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: calc(100% + 120px); /* kasih ruang biar panah di luar */
  pointer-events: none; /* biar nggak nutupin layout */
}

.galeri-carousel .owl-nav button {
  background: #F9C46B !important;
  color: #1E2A4A !important;
  font-size: 1.5rem !important;
  width: 46px;
  height: 46px;
  border-radius: 50%;
  box-shadow: 0 4px 6px rgba(0,0,0,0.25);
  transition: all 0.3s ease;
  pointer-events: auto; /* aktif klik */
  display: flex;
  align-items: center;
  justify-content: center;
}

.galeri-carousel .owl-nav button:hover {
  background: #E7B556 !important;
  color: #fff !important;
  transform: scale(1.1);
}

/* ==== HP/Tablet kecil: Panah tetap di bawah tengah ==== */
@media (max-width: 768px) {
  .galeri-carousel .owl-nav {
    position: relative;
    top: auto;
    left: auto;
    right: auto;
    transform: none;
    margin-top: 20px;
    width: 100%;
    justify-content: center;
    gap: 12px;
  }

  .galeri-carousel .owl-nav button {
    font-size: 1.2rem !important;
    width: 38px;
    height: 38px;
  }
}


</style>
@endpush
