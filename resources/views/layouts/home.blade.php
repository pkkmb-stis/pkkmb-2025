<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('home._partials.header')
    @stack('css')
    @stack('script-top')
</head>

<body class="font-mulish bg-[size:600px] bg-background2-pattern bg-[#FFEAC8]">
    {{-- Toast dari session --}}
    <x-toast classStart="lg:top-24 top-20" classEnd="lg:top-32 top-28" />

    {{-- Toast Livewire --}}
    <div class="fixed top-24 z-40 lg:right-10 right-5" id="toast"></div>

    @include('home._partials.navbar')


    <div class="fixed top-24 md:right-8 right-3 mt-2 z-30">
        <div class="grid grid-cols-1 sm:gap-1 gap-0">
            @livewire('home.pengumuman')
            @stack('float')
            <a href="{{ route('home.faq') }}" class="w-auto my-2 md:my-4 mx-auto">
                <span class="text-xs text-center md:text-base text-white bg-2025-5 p-[0.35rem] py-[0.4rem] md:py-2 rounded-full font-bold hover:bg-base-white hover:text-2025-5 transition-all border-gray-50 hover:border-2025-5 border-2">FAQ</span>
            </a>
        </div>
    </div>

    <main>
        {{ $slot }}
    </main>

    @include('home._partials.footer')
    @include('home._partials.script')

    @stack('script-bottom')


</body>

</html>
