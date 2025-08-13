@php
$statusNama = getStatusAbsensi($status);
$color = getStatusAbsensiColor($status);
@endphp


<small class="{{ $color }} text-xs p-1 px-3 rounded-full whitespace-nowrap text-white">{{ $statusNama }}</small>
