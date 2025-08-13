@php

if($category == CATEGORY_JENISPOIN_PENGHARGAAN) $color = 'bg-green-500';
else if($category == CATEGORY_JENISPOIN_PELANGGARAN) $color = 'bg-red-500';
else if($category == CATEGORY_JENISPOIN_PENEBUSAN) $color = 'bg-yellow-500';
else $color = 'bg-blue-500';

@endphp

<span
    {{ $attributes->merge(['class' => 'whitespace-nowrap inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none rounded-full text-white ' . $color]) }}>
    {{ MAP_CATEGORY['jenis_poin'][$category] }}
</span>
