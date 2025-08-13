<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaHari3()">
    <x-agenda3 title="PKKMB 2023 Hari Ke-3" id="agenda4" tema="Mewujudkan Mahasiswa Bebas Narkoba dan Tanggap Bencana untuk Menjadi Pribadi yang Berkualitas"
        class="bg-pattern" vb="false">
    </x-agenda3>
</div>

@push('css')
    <style>
        #agenda4{
            margin-top: 20px;
            box-shadow: -20px -20px 0 #C19C4C,
                        20px 20px 0 #CBAD6A;
        }
    </style>
@endpush

@push('script-bottom')
<script>
    const getAgendaHari3 = () => {
        return  {
            judulModal : "PKKMB 2023 Hari Ke-3",
            keterangan: "Hari ke-3",
            tanggal: "Minggu, 13 Agustus 2023",
            waktu: '06.00 - 16.00B',
            konten: 'Tempat kegiatan berada di Politeknik Statistika STIS dengan batas maksimal kehadiran 06.20 WIB',
            showDetail : false,
        }
    }
</script>
@endpush