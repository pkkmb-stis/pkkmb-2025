<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaPKBN0()">
    <x-agenda4 title="Pra-PKBN" id="agenda6" tema="Wujudkan Kesadaran Bela Negara, Hasilkan Statistisi yang Berintegritas!" class="bg-pattern"
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
    const getAgendaPKBN0 = () => {
        return  {
            judulModal : "Pra-PKBN",
            keterangan: "Pra-PKBN",
            tanggal: "Selasa, 15 Agustus 2023",
            waktu: '09.30 - 13.00 WIB',
            konten: 'Tempat kegiatan berada di Politeknik Statistika STIS dengan batas maksimal kehadiran 09.50 WIB',
            showDetail : false,
        }
    }
</script>
@endpush
