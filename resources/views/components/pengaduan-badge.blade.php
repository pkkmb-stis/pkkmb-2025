@if ($pengaduanCount > 0)
    <div id="pengaduanNotif" class="badge">{{ $pengaduanCount }}</div>
@else
    <div id="pengaduanNotif" class="hidden">{{ $pengaduanCount }}</div>
@endif
