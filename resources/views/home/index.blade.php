<x-home-layout headerScrollEffect="true">
    <!-- Header -->
    @include('home.index.selamat-datang')
    <!-- End Header -->

    <!-- Section -->
    <section class="font-caruban">
        @include('home.index.teaser')

        @include('home.index.visi-misi')

        @include('home.index.maskot')

        @if ($video->count() > 0)
            @include('home.index.serba-serbi')
        @endif

        @include('home.index.galeri')

        @if ($berita->count() > 0)
            @include('home.index.berita-harian')
        @endif

        {{-- @include('home.index.agenda') --}}
    </section>


    @push('css')
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.theme.default.css') }}">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @endpush

    @push('script-top')
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.js') }}"></script>
    @endpush

    @push('script-bottom')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
            });
        </script>
    @endpush
</x-home-layout>
