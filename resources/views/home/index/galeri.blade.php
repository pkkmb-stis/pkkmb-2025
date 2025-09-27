<!-- ===================== HEADER GALERI ===================== -->
<div class="w-full flex justify-center items-center bg-[#EFE5D0] py-4 md:py-6 relative overflow-hidden">
    <!-- Burung Enggang Kiri -->
    <img src="{{ asset('img/asset/2025/burung_enggang.png') }}"
         alt="Burung Enggang"
         class="flex-shrink-0 w-12 mr-2 sm:w-16 md:w-20 sm:mr-4 md:mr-6">

    <!-- Strip Biru -->
<div class="flex items-center justify-center gap-2 sm:gap-4 md:gap-6
            px-4 sm:px-6 md:px-10 py-2 sm:py-3 md:py-5
            bg-[#1D2A44] rounded-md md:rounded-lg max-w-full">

    <!-- Ornamen Kiri -->
    <div class="flex items-center gap-1 sm:gap-2 md:gap-3">
        <img src="{{ asset('img/asset/2025/Cempaka ungu.png') }}"
             alt="Bunga"
             class="w-5 sm:w-7 md:w-9">
        <img src="{{ asset('img/asset/2025/Cempaka merah.png') }}"
             alt="Bunga"
             class="w-7 sm:w-9 md:w-12">
    </div>

    <!-- Teks -->
    <h1 class="font-caruban text-[#F4C542] tracking-wide text-center
               text-xl sm:text-3xl md:text-5xl lg:text-[60px] px-2">
        Galeri PKKMB - PKBN 2025
    </h1>

    <!-- Ornamen Kanan -->
    <div class="flex items-center gap-1 sm:gap-2 md:gap-3">
        <img src="{{ asset('img/asset/2025/Cempaka merah.png') }}"
             alt="Bunga"
             class="w-7 sm:w-9 md:w-12">
        <img src="{{ asset('img/asset/2025/Cempaka ungu.png') }}"
             alt="Bunga"
             class="w-5 sm:w-7 md:w-9">
    </div>
</div>

    <!-- Burung Enggang Kanan -->
    <img src="{{ asset('img/asset/2025/burung_enggang.png') }}"
         alt="Burung Enggang"
         class="flex-shrink-0 w-12 ml-2 sm:w-16 md:w-20 sm:ml-4 md:ml-6 -scale-x-100">
</div>


<!-- ===================== GALERI CAROUSEL ===================== -->
<div class="pb-4 lg:pb-12 bg-putih-pattern bg-fixed rounded-[1.875rem_0_0_4.6875rem] flex-1">
    <div class="w-4/5 mx-auto mt-6 owl-carousel galeri-carousel">
        <!-- Slide 1 -->
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <img src="{{ asset('img/galeri/1.jpg') }}" class="object-cover w-full h-auto transition-transform transform hover:scale-105 md:rounded-xl rounded-tl-xl">
            </div>
            <div class="col-span-1">
                <img src="{{ asset('img/galeri/2.jpg') }}" class="object-cover w-full h-full transition-transform transform hover:scale-105 md:rounded-xl rounded-tr-xl">
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="grid grid-cols-3 gap-4">
            <div>
                <img src="{{ asset('img/galeri/3.jpg') }}" class="object-cover w-full h-full transition-transform transform hover:scale-105 md:rounded-xl">
            </div>
            <div>
                <img src="{{ asset('img/galeri/4.jpg') }}" class="object-cover w-full h-full transition-transform transform hover:scale-105 md:rounded-xl rounded-bl-xl">
            </div>
            <div>
                <img src="{{ asset('img/galeri/5.jpg') }}" class="object-cover w-full h-full transition-transform transform hover:scale-105 md:rounded-xl">
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="grid grid-cols-3 gap-4">
            <div>
                <img src="{{ asset('img/galeri/6.jpg') }}" class="object-cover w-full h-full transition-transform transform hover:scale-105 md:rounded-xl rounded-bl-xl">
            </div>
            <div class="col-span-2">
                <img src="{{ asset('img/galeri/7.jpg') }}" class="object-cover w-full h-full transition-transform transform hover:scale-105 md:rounded-xl rounded-br-xl">
            </div>
        </div>
    </div>
</div>


<!-- ===================== SCRIPT ===================== -->
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
            '<div class="text-gray-700 custom-nav-prev">&#10094;</div>',
            '<div class="text-gray-700 custom-nav-next">&#10095;</div>'
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
/* Custom posisi tombol nav */
.owl-carousel .owl-nav {
    position: absolute;
    top: 50%;
    left: -80px;   /* makin keluar ke kiri */
    right: -80px;  /* makin keluar ke kanan */
    width: calc(100% + 160px);
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    pointer-events: none;
}

.owl-carousel .owl-nav button {
    background: rgba(0,0,0,0.6);
    color: white;
    border-radius: 9999px;
    width: 60px;   /* ukuran lebih besar */
    height: 60px;
    font-size: 28px; /* teks panah lebih besar */
    display: flex;
    align-items: center;
    justify-content: center;
    pointer-events: auto;
    transition: all 0.2s ease-in-out;
}

.owl-carousel .owl-nav button:hover {
    background: rgba(0,0,0,0.85);
    transform: scale(1.1);
}
</style>
@endpush
