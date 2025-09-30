<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = collect([
            "Bagaimana jika terlambat pada saat kegiatan?",
            "Apakah ada ketentuan sepatu harus pantofel/kets?",
            "Apakah terdapat ketentuan mengenai jumlah saku depan pada pakaian dinas harian?",
            "Bagaimana jika tidak lulus PKKMB tahun ini?",
            "Dimana maba/miba bisa mengetahui jadwal untuk PKKMB?",
            "Apakah peralatan yang tidak dipakai boleh tidak dibawa? (misal : peralatan ibadah, alat makan, dll)",
            "Apakah perlengkapan PKKMB disediakan oleh kampus?",
            "Bagaimana ketentuan pakaian untuk PKKMB?",
            "Apakah maba/miba boleh membawa kendaraan ke kampus?",
            "Apa itu poin pelanggaran? Bagaimana jika poin kami mencapai maksimal?",
            "Apakah boleh membawa handphone ketika kegiatan?",
            "Jika peralatan PKBN tidak cukup dalam tas, apakah boleh membawa totebag tambahan?",
            "Bagaimana dengan ketentuan potongan rambut?",
            "Jumlah halaman buku untuk buku tulis maba/miba apakah ditentukan jumlah lembarnya?"
        ]);

        $answers = collect([
            "Akan berpengaruh terhadap poin maba/miba yang berpengaruh pada kelulusan",
            "Maba/miba menggunakan sepatu kets dengan warna dominan hitam",
            "Minimal terdapat satu saku depan pada pakaian dinas harian",
            "Mengulang kegiatan PKKMB-PKBN tahun depan",
            "Maba/miba bisa melihat informasi tentang PKKMB di web pkkmb.stis.ac.id/2025, jika terdapat pertanyaan silakan bertanya ke PK masing-masing",
            "Peralatan yang diwajibkan tetap harus dibawa walaupun tidak dipakai.",
            "Atribut yang disediakan kampus meliputi Pakaian Dinas Olahraga (PDO) dan Pakaian Dinas Lapangan (PDL). Selain itu maba/miba dapat membeli perlengkapan lainnya pada dana usaha yang dikelola oleh kewirausahaan mahasiswa Politeknik Statistika STIS, ataupun mempersiapkan secara pribadi.",
            "Maba/miba menggunakan pakaian hitam putih dan batik dengan celana/rok kain di hari rabu, seperti ketentuan di buku panduan",
            "Maba/miba tidak diperbolehkan membawa kendaraan.",
            "Poin pelanggaran adalah angka indeks sebagai penghitungan berapa banyak pelanggaran yang dilakukan. Jika mencapai batas tertentu akan diberi konsekuensi atau bahkan tidak diluluskan",
            "Maba/miba diharapkan membawa handphone untuk digunakan sebagai pretest, posttest, dan kuis. Namun tidak boleh digunakan ketika kegiatan tanpa seizin panitia",
            "Tidak, barang-barang dimasukkan ke dalam ransel hitam. Jika tidak muat, dimasukkan ke dalam kantong kresek dan diikat ke tas.",
            "Rambut laki-laki dengan ukuran 121, tidak berjenggot, berkumis, dan berjambang. Rambut perempuan berasa di atas bahu. ",
            "Tidak ada ketentuan mengenai banyaknya lembar pada buku tulis maba/miba"
        ]);

        $questions->each(function ($question, $key) use ($answers) {
            Faq::create([
                'pertanyaan' => $question,
                'jawaban' => $answers[$key],
            ]);
        });
    }
}
