<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaPKBN3()">
    <x-agenda4 title="PKBN Hari Ke-3" id="agenda8" tema="" class="bg-pattern"
        vb="false">
    </x-agenda4>
</div>

@push('css')
    <style>
        #agenda8{
            margin-top: 20px;
            box-shadow: -20px -20px 0 #C19C4C,
                        20px 20px 0 #CBAD6A;
        }
    </style>
@endpush

@push('script-bottom')
<script>
    const getAgendaPKBN3 = () => {
        return  {
            judulModal : "PKBN Hari Ke-3",
            keterangan: "Hari ke-3",
            tanggal: "Jumat, 18 Agustus 2023",
            waktu: 'tentatif',
            konten: 'PKBN dilaksanakan di Pusat Pendidikan Jasmani Kodiklat TNI AD',
            showDetail : false,
        }
    }
</script>
@endpush
