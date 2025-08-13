@props(['href' => '#', 'active' => false, 'icon' => '', 'id' => ''])

<li class="items-center">
    @if ($active)
        <a href="{{ $href }}"
            class="box-border block py-2 pl-5 mx-2 text-sm font-bold capitalize rounded-lg font-poppins bg-coklat-2 text-base-white">
            @if ($id == 'pengaduan')
                <div class="container-badge icon-container">
                    <i class="{{ $icon }} fa-fw mr-2 text-lg"></i>
                    <span class="animate-pulse">@livewire('admin.maba.kendala.pengaduan-badge')</span>
                </div>
            @else
                <i class="{{ $icon }} fa-fw mr-2 text-lg"></i>
            @endif
            {{ $slot }}
        </a>
    @else
        <a href="{{ $href }}"
            class="box-border block py-2 pl-6 text-sm font-bold capitalize transition font-poppins text-opacity-70 text-coklat-1 hover:text-opacity-100">
            @if ($id == 'pengaduan')
                <div class="container-badge icon-container">
                    <i class="{{ $icon }} text-lg fa-fw mr-2 opacity-75"></i>
                    <span class="animate-pulse">@livewire('admin.maba.kendala.pengaduan-badge')</span>
                </div>
            @else
                <i class="{{ $icon }} text-lg fa-fw mr-2 opacity-75"></i>
            @endif
            {{ $slot }}
        </a>
    @endif
</li>
