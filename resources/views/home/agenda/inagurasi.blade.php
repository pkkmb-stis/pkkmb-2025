<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaInagurasi()">
    <x-agenda2 title="Inaugurasi Angkatan 65" id="agenda11" tema="Tunjukkan Bakat, Tampilkan Karya, Lestarikan Budaya" class="bg-pattern"
        vb="false">
    </x-agenda2>
</div>

@push('css')
    <style>
        #agenda11{
            margin-top: 20px;
            box-shadow: -20px -20px 0 #9BA3AC,
                        20px 20px 0 #ACB2BA;
        }
    </style>
@endpush

@push('script-bottom')
<script>
    const getAgendaInagurasi = () => {
        return  {
            judulModal : "Inaugurasi Angkatan 65",
            keterangan:"Inaugurasi",
            tanggal: 'Sabtu, 26 Agustus 2023',
            waktu: '06.00 - 16.00 WIB',
            konten: 'Tempat kegiatan berada di Politeknik Statistika STIS dengan batas maksimal kehadiran 06.20 WIB',
            showDetail : false,
        }
    }
</script>
@endpush
