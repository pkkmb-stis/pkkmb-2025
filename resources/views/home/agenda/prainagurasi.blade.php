<div class="mx-2.5 w-full md:w-auto" x-data="getAgendaPraInagurasi()">
    <x-agenda2 title="Pra-Inaugurasi Angkatan 65" id="agend10" tema="Asah Bakat, Ciptakan Kreasi Tanpa Batas" class="bg-pattern"
        vb="false">
    </x-agenda2>
</div>

@push('css')
    <style>
        #agenda10{
            margin-top: 20px;
            box-shadow: -20px -20px 0 #852A15,
                        20px 20px 0 #994E3C;
        }
    </style>
@endpush

@push('script-bottom')
<script>
    const getAgendaPraInagurasi = () => {
        return  {
            judulModal : "Pra-Inaugurasi Angkatan 65",
            keterangan: "Pra Inagurasi",
            tanggal: 'Sabtu, 20 Agustus 2023',
            waktu: '07:30 - 12:10 WIB',
            konten: 'blablbalbldbaldboawiufffffffffffffffffffffffffffffffffffffffffffff fasojf olasfj jsajsssssssssssjjfkj asfoj waofu waof oa wfo awfi apfs aspif aspif pasi fpasi fpia sfpi asfpas fpa sifpas fpa sfpi asfp aspfi apsi fpas fip asfpi asfp asfaspif aspf aspfi aspfias fp asfp asfipas fpaf',
            showDetail : false,
        }
    }
</script>
@endpush
