<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaHari1()">
    <x-agenda3 title="PKKMB 2023 Hari Ke-1" id="agenda2" tema="Membentuk Statistisi yang Mengenal Program Studi di Era Perkembangan Media Sosial" class="bg-pattern"
        vb="false">
    </x-agenda3>
</div>

@push('css')
    <style>
        #agenda2{
            margin-top: 20px;
            box-shadow: -20px -20px 0 #852A15,
                        20px 20px 0 #994E3C;
        }
    </style>
@endpush

@push('script-bottom')
<script>
    const getAgendaHari1 = () => {
        return  {
            judulModal : "PKKMB 2023 Hari Ke-1",
            keterangan: "Hari ke-1",
            tanggal: 'Jumat, 11 Agustus 2023',
            waktu: '06.00 - 16.15 WIB',
            konten: 'Tempat kegiatan berada di Politeknik Statistika STIS dengan batas maksimal kehadiran 06.20 WIB',
            showDetail : false,
        }
    }
</script>
@endpush
