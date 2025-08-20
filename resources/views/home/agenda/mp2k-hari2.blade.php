<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaHari2()">
    <x-agenda3 title="PKKMB 2023 Hari Ke-2" id="agenda3" tema="Membentuk Mahasiswa yang Aktif Berkontribusi dan Peduli Terhadap Kesehatan Mental" class="bg-pattern" vb="false">

    </x-agenda3>
</div>

@push('css')
    <style>
        #agenda3{
            margin-top: 20px;
            box-shadow: -20px -20px 0 #9BA3AC,
                        20px 20px 0 #ACB2BA;
        }
    </style>
@endpush

@push('script-bottom')
<script>
    const getAgendaHari2 = () => {
        return  {
            judulModal : "PKKMB 2023 Hari Ke-2",
            keterangan: "Hari ke-2",
            tanggal: 'Sabtu, 12 Agustus 2023',
            waktu: '06.00 - 16.15 WIB',
            konten: 'Tempat kegiatan berada di Politeknik Statistika STIS dengan batas maksimal kehadiran 06.20 WIB',
            showDetail : false,
        }
    }
</script>
@endpush
