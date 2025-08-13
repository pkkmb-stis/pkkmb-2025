<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaPKBN4()">
    <x-agenda4 title="PKBN Hari Ke-1" id="agenda9" tema="" class="bg-pattern"
        vb="false">
    </x-agenda4>
</div>

@push('css')
    <style>
        #agenda9{
            margin-top: 20px;
            box-shadow: -20px -20px 0 #192B39,
                        20px 20px 0 #3F4E5A;
        }
    </style>
@endpush

@push('script-bottom')
<script>
    const getAgendaPKBN4 = () => {
        return  {
            judulModal : "PKBN Hari Ke-4",
            keterangan: "Hari ke-4",
            tanggal: "Sabtu, 19 Agustus 2023",
            waktu: 'tentatif',
            konten: 'PKBN dilaksanakan di Pusat Pendidikan Jasmani Kodiklat TNI AD',
            showDetail : false,
        }
    }
</script>
@endpush
