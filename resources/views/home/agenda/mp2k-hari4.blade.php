<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaHari4()">
    <x-agenda3 title="PKKMB 2023 Hari Ke-4" id="agenda5" tema="Regenerasi BPS Hebat, Ciptakan Data Akurat!" class="bg-pattern"
        vb="false">
    </x-agenda3>
</div>

@push('css')
    <style>
        #agenda5{
            margin-top: 20px;
            box-shadow: -20px -20px 0 #192B39,
                        20px 20px 0 #3F4E5A;
        }
    </style>
@endpush

@push('script-bottom')
<script>
    const getAgendaHari4 = () => {
        return  {
            judulModal : "PKKMB 2023 Hari Ke-4",
            keterangan: "Hari ke-4",
            tanggal: 'Senin, 14 Agustus 2023',
            waktu: '07.00 - 14.30 WIB',
            konten: 'Tempat kegiatan berada di Badan Pusat Statistik RI dengan batas maksimal kehadiran 06.45 WIB',
            showDetail : false,
        }
    }
</script>
@endpush
