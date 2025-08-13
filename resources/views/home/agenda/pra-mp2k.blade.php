<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaPraMp2k()">
    <x-agenda title="Pra-PKKMB 2023" id="agenda1" tema="Mempersiapkan Diri untuk Bersatu di Lingkungan Baru" class="bg-pattern" vb="false">
    </x-agenda>
</div>

@push('css')
    <style>
        #agenda1{
            margin-top: 20px;
            box-shadow: -20px -20px 0 #192B39,
                        20px 20px 0 #3F4E5A;
        }
    </style>
@endpush

@push('script-bottom')
<script>
    const getAgendaPraMp2k = () => {
        return  {
            judulModal : "Pra-PKKMB 2023",
            tanggal: "Rabu, 9 Agustus 2023",
            waktu: '12.30 - 16.15 WIB',
            konten: 'Tempat kegiatan berada di Politeknik Statistika STIS dengan batas maksimal kehadiran 12.40 WIB',
            showDetail : false,
        }
    }
</script>
@endpush
