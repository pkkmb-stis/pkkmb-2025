@php
if($status){
$statusNama = "Publish";
$color = "bg-green-500";
} else {
$statusNama = "Draft";
$color = "bg-yellow-500";
}
@endphp

<small class="{{ $color }} text-xs p-1 px-3 rounded-full text-white">{{ $statusNama }}</small>
