<nav class="relative flex items-center h-full md:flex-row md:flex-nowrap md:justify-start">
    <div class="items-center justify-between hidden w-full p-3 mx-auto md:flex md:px-10">
        <span class="hidden text-2xl font-bold uppercase font-poppins text-2025-1 md:inline-block">
            {{ $title }}
        </span>

        <ul class="relative flex-col items-center hidden list-none md:flex-row md:flex">
            @include('admin._partials.dropdown')
        </ul>
    </div>
</nav>
