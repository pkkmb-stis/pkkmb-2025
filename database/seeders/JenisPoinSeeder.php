<?php

namespace Database\Seeders;

use App\Models\Poin\JenisPoin;
use Illuminate\Database\Seeder;

class JenisPoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisPoin = [
            // Poin Kehadiran Panitia
            [
                'id' => JENISPOIN_PANITIA_LAMBAT_0_10,
                'nama' => "Panitia terlambat < 10 menit",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 2,
                'is_bintang' => 0,
                'alasan_template' => "Panitia terlambat kurang dari 10 menit dari waktu yang ditetapkan."
            ],
            [
                'id' => JENISPOIN_PANITIA_LAMBAT_10_15,
                'nama' => "Panitia terlambat 10-15 menit",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 4,
                'is_bintang' => 0,
                'alasan_template' => "Panitia terlambat antara 10 hingga 15 menit dari waktu yang ditetapkan."
            ],
            [
                'id' => JENISPOIN_PANITIA_LAMBAT_16_30,
                'nama' => "Panitia terlambat 15-30 menit",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Panitia terlambat antara 16 hingga 30 menit dari waktu yang ditetapkan."
            ],
            [
                'id' => JENISPOIN_PANITIA_LAMBAT_31,
                'nama' => "Panitia terlambat > 30 menit",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 10,
                'is_bintang' => 0,
                'alasan_template' => "Panitia terlambat lebih dari 30 menit dari waktu yang ditetapkan."
            ],

            // Poin Kehadiran Peserta
            [
                'id' => JENISPOIN_TEPAT_WAKTU,
                'nama' => "Hadir tepat waktu",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 1,
                'is_bintang' => 0,
                'alasan_template' => "" // Kosong untuk Penghargaan
            ],
            [
                'id' => JENISPOIN_MABA_LAMBAT_0_15,
                'nama' => "Peserta terlambat 0-15 menit",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 3,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba terlambat kurang dari 15 menit dari waktu yang ditetapkan."
            ],
            [
                'id' => JENISPOIN_MABA_LAMBAT_16_30,
                'nama' => "Peserta terlambat 15-30 menit",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba terlambat antara 16 hingga 30 menit dari waktu yang ditetapkan."
            ],
            [
                'id' => JENISPOIN_MABA_LAMBAT_31,
                'nama' => "Peserta terlambat > 30 menit",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 10,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba terlambat lebih dari 30 menit dari waktu yang ditetapkan."
            ],

            // Poin Penampilan Peserta
            [
                'id' => JENISPOIN_ATRIBUT_LENGKAP,
                'nama' => "Atribut lengkap dan rapi",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 1,
                'is_bintang' => 0,
                'alasan_template' => "" // Kosong untuk Penghargaan
            ],
            [
                'id' => JENISPOIN_ATRIBUT_TIDAK_LENGKAP,
                'nama' => "Atribut dan/atau perlengkapan PKKMB-PKBN tidak lengkap (tidak memakai)",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 1,
                'alasan_template' => "Maba/Miba diketahui tidak mengenakan XXX"
            ],
            [
                'id' => JENISPOIN_PAKAIAN_KUCEL,
                'nama' => "Pakaian: kucel",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 2,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba diketahui menggunakan pakaian yang kucel atau tidak memasukkan pakaian ke dalam celana"
            ],
            [
                'id' => JENISPOIN_NODA_TAMPAK,
                'nama' => "Pakaian: noda yang tampak jelas",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 2,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba diketahui menggunakan pakaian dengan noda yang terlihat jelas"
            ],
            [
                'id' => JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN,
                'nama' => "Menggunakan aksesoris/atribut yang tidak dijelaskan di ketentuan PKKMB-PKBN : aksesoris lainnya",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba diketahui mengenakan XXX yang tidak sesuai dengan yang telah ditentukan dalam ketentuan PKKMB-PKBN."
            ],
            [
                'id' => JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_CINCIN,
                'nama' => "Menggunakan aksesoris/atribut yang tidak dijelaskan di ketentuan PKKMB-PKBN : cincin",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba diketahui mengenakan cincin yang tidak sesuai dengan yang telah ditentukan dalam ketentuan PKKMB-PKBN."
            ],
            [
                'id' => JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_GELANG,
                'nama' => "Menggunakan aksesoris/atribut yang tidak dijelaskan di ketentuan PKKMB-PKBN : gelang",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba diketahui mengenakan gelang yang tidak sesuai dengan yang telah ditentukan dalam ketentuan PKKMB-PKBN."
            ],
            [
                'id' => JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_KALUNG,
                'nama' => "Menggunakan aksesoris/atribut yang tidak dijelaskan di ketentuan PKKMB-PKBN : kalung",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba diketahui mengenakan kalung yang tidak sesuai dengan yang telah ditentukan dalam ketentuan PKKMB-PKBN."
            ],

            // Poin Kuliah Umum Peserta
            [
                'id' => JENISPOIN_TERTIB_KU,
                'nama' => "Tertib mengikuti kegiatan pembekalan",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 1,
                'is_bintang' => 0,
                'alasan_template' => "" // Kosong untuk Penghargaan
            ],
            [
                'id' => JENISPOIN_KU_TIDUR,
                'nama' => "Kuliah Umum: Tidur",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba terlihat tidur selama kuliah umum berlangsung."
            ],
            [
                'id' => JENISPOIN_KU_NGOBROL,
                'nama' => "Mengobrol dengan peserta lain ketika kuliah umum berlangsung",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba mengobrol dengan peserta lain ketika kuliah umum berlangsung."
            ],
            [
                'id' => JENISPOIN_KU_DUDUK_TIDAK_SESUAI,
                'nama' => "Posisi duduk tidak sesuai dengan ketentuan",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba duduk dengan posisi yang tidak sesuai dengan ketentuan."
            ],
            [
                'id' => JENISPOIN_KU_MAKAN,
                'nama' => "Kuliah Umum: Makan dan minum",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba makan selama kuliah umum berlangsung, yang tidak sesuai dengan aturan."
            ],
            [
                'id' => JENISPOIN_KU_MAIN_HP,
                'nama' => "Bermain handphone pada saat kuliah umum berlangsung",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba bermain handphone selama kuliah umum berlangsung, melanggar aturan yang telah ditetapkan."
            ],
            [
                'id' => JENISPOIN_TIDAK_TERTIB_KU,
                'nama' => "Tidak mematuhi aturan kuliah umum",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 6,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba tidak mematuhi aturan yang berlaku selama kuliah umum berlangsung."
            ],
            [
                'id' => JENISPOIN_KU_TRANSISI_TIDAK_TERTIB,
                'nama' => "Tidak tertib saat transisi antar Kuliah Umum",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 3,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba diketahui tidak melakukan transisi dengan tertib pada kegiatan XXX"
            ],

            // Poin Kedisiplinan Peserta
            [
                'id' => JENISPOIN_TIDAK_MELAKUKAN_KESALAHAN,
                'nama' => "Tidak melanggar peraturan dalam sehari",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 1,
                'is_bintang' => 0,
                'alasan_template' => "" // Kosong untuk Penghargaan
            ],

            // Poin Penugasan Peserta
            [
                'id' => JENISPOIN_PATUH_TUGAS,
                'nama' => "Mengumpulkan penugasan dengan lengkap dan sesuai dengan waktu yang ditetapkan",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 1,
                'is_bintang' => 0,
                'alasan_template' => "" // Kosong untuk Penghargaan
            ],
            [
                'id' => JENISPOIN_TUGAS_TIDAK_LENGKAP,
                'nama' => "Tugas tidak lengkap",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 4,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba mengumpulkan tugas yang tidak lengkap sesuai dengan instruksi yang diberikan."
            ],
            [
                'id' => JENISPOIN_TUGAS_TERLAMBAT,
                'nama' => "Tugas terlambat",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 4,
                'is_bintang' => 0,
                'alasan_template' => "Maba/Miba mengumpulkan tugas melewati batas waktu yang telah ditentukan."
            ],

            // Poin Perlengkapan PKBN Peserta
            [
                'id' => JENISPOIN_ATRIBUT_PKBN_LENGKAP,
                'nama' => "Perlengkapan PKBN lengkap",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 1,
                'is_bintang' => 0,
                'alasan_template' => "" // Kosong untuk Penghargaan
            ],
            [
                'id' => JENISPOIN_TIDAK_BAWA_BARANG_INSTRUKSI,
                'nama' => "Tidak membawa barang yang diinstruksikan",
                'category' => CATEGORY_JENISPOIN_PELANGGARAN,
                'poin' => 3,
                'is_bintang' => 1,
                'alasan_template' => "Maba/Miba diketahui tidak membawa XXX, yaitu barang yang diinstruksikan untuk dibawa"
            ],

            // Penghargaan Untuk Peserta Terpilih
            [
                'id' => JENISPOIN_MENGIKUTI_SELEKSI_PETUGAS_APEL,
                'nama' => "Mengikuti seleksi petugas apel",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 1,
                'is_bintang' => 0,
                'alasan_template' => ""
            ],
            [
                'id' => JENISPOIN_MENJADI_PETUGAS_APEL,
                'nama' => "Menjadi petugas apel",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 3,
                'is_bintang' => 0,
                'alasan_template' => ""
            ],
            [
                'id' => JENISPOIN_MENGIKUTI_SELEKSI_KETUA_ANGKATAN,
                'nama' => "Mengikuti seleksi ketua angkatan",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 1,
                'is_bintang' => 0,
                'alasan_template' => ""
            ],
            [
                'id' => JENISPOIN_MENJADI_KETUA_ANGKATAN,
                'nama' => "Menjadi ketua angkatan",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 2,
                'is_bintang' => 0,
                'alasan_template' => ""
            ],
            [
                'id' => JENISPOIN_MENJADI_KETUA_KELOMPOK,
                'nama' => "Menjadi ketua kelompok",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 1,
                'is_bintang' => 0,
                'alasan_template' => ""
            ],
            [
                'id' => JENISPOIN_BERTANYA_MENJAWAB_PERTANYAAN,
                'nama' => "Bertanya/menjawab pertanyaan",
                'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
                'poin' => 1,
                'is_bintang' => 0,
                'alasan_template' => ""
            ],
        ];


        foreach ($jenisPoin as $poin) {
            $poin['can_delete'] = 0;
            JenisPoin::create($poin);
        }

        $data = csv_to_array('./database/csv/jenispoin.csv', ',');
        foreach ($data as $j) {
            ($j['category'] == 'Penebusan') ? $category = CATEGORY_JENISPOIN_PENEBUSAN : '';
            ($j['category'] == 'Pelanggaran') ? $category = CATEGORY_JENISPOIN_PELANGGARAN : '';
            ($j['category'] == 'Penghargaan') ? $category = CATEGORY_JENISPOIN_PENGHARGAAN : '';

            ($j['type'] == 'Ringan') ? $type = 1 : '';
            ($j['type'] == 'Sedang') ? $type = 2 : '';
            ($j['type'] == 'Berat') ? $type = 3 : '';

            JenisPoin::create([
                'nama' => $j['nama'],
                'poin' => $j['poin'],
                'detail' => $j['detail'],
                'type' => $type,
                'category' => $category,
                'is_bintang' => $j['is_bintang'],
                'alasan_template' => $j['alasan_template'],
            ]);
        }
    }
}
