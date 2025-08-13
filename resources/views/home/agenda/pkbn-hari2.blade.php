<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaPKBN2()">
    <x-agenda4 title="PKBN Hari Ke-2" id="agenda7" tema="" class="bg-pattern"
        vb="false">
    </x-agenda4>
</div>

@push('css')
    <style>
        #agenda7{
            margin-top: 20px;
            box-shadow: -20px -20px 0 #9BA3AC,
                        20px 20px 0 #ACB2BA;
        }
    </style>
@endpush

@push('script-bottom')
<script>
    const getAgendaPKBN2 = () => {
        return  {
            judulModal : "PKBN Hari Ke-2",
            keterangan:"Hari ke-2",
            tanggal: "Kamis, 17 Agustus 2023",
            waktu: 'tentatif',
            konten: 'PKBN dilaksanakan di Pusat Pendidikan Jasmani Kodiklat TNI AD',
            showDetail : false,
        }
    }
</script>
@endpush