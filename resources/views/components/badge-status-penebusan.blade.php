@php
if($category == PENEBUSAN_MENUNGGU_UPLOAD) $color = "bg-yellow-500";
else if($category == PENEBUSAN_SEDANG_DIKOREKSI) $color = "bg-blue-500";
else if($category == PENEBUSAN_BUTUH_REVISI) $color = "bg-yellow-500";
else if($category == PENEBUSAN_SELESAI) $color = "bg-green-500";
else if($category == PENEBUSAN_TERLAMBAT) $color = "bg-red-500";
else $color = "bg-blue-500";
@endphp

<span
    {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none rounded-full text-white ' . $color]) }}>{{ $content ?? $category }}</span>
