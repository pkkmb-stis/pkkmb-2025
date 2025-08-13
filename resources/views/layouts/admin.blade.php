<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('admin._partials.head')
    @stack('css')
    @stack('script-top')
</head>

<body class="antialiased font-mulish" x-data="{ openDropdown: false, openSidebar: false }">
    {{-- Toast Livewire --}}
    <div class="fixed z-40 top-24 lg:right-10 right-5" id="toast"></div>
    <div class="block w-screen h-screen grid-cols-9 grid-rows-6 overflow-y-auto md:grid custom-scroll">

        <div class="fixed w-full col-span-3 row-span-1 md:flex md:relative md:w-auto lg:col-span-2 bg-merah1-pattern">
            <div class="w-full md:mt-10 md:ml-10 md:rounded-tl-3xl bg-merah1-pattern md:bg-none bg-coklat-2">
                @include('admin._partials.topbar-hp')
            </div>
        </div>

        <div class="col-span-6 row-span-1 md:flex pt-14 md:pt-0 lg:col-span-7 bg-merah1-pattern">
            <div class="w-full bg-white md:mt-10 md:mr-10 md:rounded-tr-3xl bg-opacity-60">
                @include('admin._partials.topbar-pc')
            </div>
        </div>

        <div class="fixed w-full col-span-3 row-span-5 -mt-1 overflow-y-auto border-2 border-t-0 md:flex md:relative md:w-auto h-96 md:h-auto lg:col-span-2 bg-merah1-pattern custom-scroll border-b-black border-x-black md:border-none rounded-bl-3xl rounded-br-3xl md:rounded-none"
            :class="openSidebar ? '' : 'hidden'">
            <div class="w-full overflow-y-auto bg-white md:mb-10 md:ml-10 md:bg-opacity-60 rounded-bl-3xl">
                @include('admin._partials.header-card-hp')
                <hr class="hidden mb-2 border-transparent md:block">
                @include('admin._partials.sidebar')
            </div>
        </div>

        <div class="col-span-6 row-span-5 -mt-1 md:flex lg:col-span-7 bg-merah1-pattern custom-scroll">
            <div
                class="w-full min-h-screen overflow-y-auto bg-white md:min-h-0 md:mb-10 md:mr-10 md:rounded-br-3xl bg-putih-pattern">
                <main class="px-3 pt-4 pb-6 sm:px-5">
                    {{ $slot }}
                </main>
            </div>
        </div>



    </div>

    @include('admin._partials.footer')
    @stack('script-bottom')
</body>

</html>
