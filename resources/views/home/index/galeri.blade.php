<!-- ===================== HEADER GALERI ===================== -->
<div class="w-full flex justify-center items-center bg-[#EFE5D0] py-4 md:py-6 relative overflow-hidden mt-6">
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
                Galeri PKKMB
            </h1>
            <h1 class="font-caruban text-[#F4C542] tracking-wide
                       text-lg sm:text-2xl md:text-4xl lg:text-5xl leading-tight">
                PKBN 2025
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
<div class="pb-6 lg:pb-12 pt-6 lg:pt-12 bg-putih-pattern bg-fixed rounded-b-[30px] flex-1">
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



<<!-- ===================== SCRIPT ===================== -->
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
        nav: false, // 🔴 panah dihapus
        responsive: {
            0: { items: 1 },
            768: { items: 1 },
            1024: { items: 1 }
        }
    });
});
</script>

<style>
/* Custom posisi tombol nav (tidak diperlukan lagi jika nav:false) */
/* Kalau mau jaga-jaga biar tetap bersih bisa dipaksa hilang */
.owl-carousel .owl-nav {
    display: none !important;
}

/* Tambahan biar strip biru aman di HP */
@media (max-width: 640px) {
    .strip-biru h1 {
        font-size: 1.2rem;
    }
    .strip-biru img {
        max-width: 22px;
    }
}
</style>
@endpush
