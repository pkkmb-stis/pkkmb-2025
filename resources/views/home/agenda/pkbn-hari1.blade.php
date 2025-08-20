<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaPKBN1()">
    <x-agenda4 title="PKBN Hari Ke-1" id="agenda6" tema="" class="bg-pattern"
        vb="false">
    </x-agenda4>
</div>

@push('css')
    <style>
        #agenda6{
            margin-top: 20px;
            box-shadow: -20px -20px 0 #852A15,
                        20px 20px 0 #994E3C;
        }
    </style>
@endpush

@push('script-bottom')
<script>
    const getAgendaPKBN1 = () => {
        return  {
            judulModal : "PKBN Hari Ke-1",
            keterangan: "Hari ke-1",
            tanggal: "Rabu, 16 Agustus 2023",
            waktu: 'tentatif',
            konten: 'PKBN dilaksanakan di Pusat Pendidikan Jasmani Kodiklat TNI AD',
            showDetail : false,
        }
    }
</script>
@endpush
