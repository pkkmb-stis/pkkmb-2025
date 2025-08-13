<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Pendaftaran Ulang Online',
                'waktu_mulai' => Carbon::createFromTimeString('2024-09-05 01:00:00'),
                'waktu_akhir' => Carbon::createFromTimeString('2024-09-06 01:00:00'),
                'location' => 'Website Politeknik Statistika STIS'
            ],
            [
                'title' => 'Verifikasi Berkas',
                'waktu_mulai' => Carbon::createFromTimeString('2024-09-10 01:00:00'),
                'waktu_akhir' => Carbon::createFromTimeString('2024-09-11 01:00:00'),
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'Penyambutan Mahasiswa Baru & Pra PKKMB',
                'waktu_mulai' => Carbon::createFromTimeString('2024-09-12 01:00:00'),
                'caption' => 'Langkah Awal Mewujudkan Mahasiswa Adaptif yang Siap Berkarya di Lingkungan Baru',
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'PKKMB Hari Ke-1',
                'waktu_mulai' => Carbon::createFromTimeString('2024-09-13 01:00:00'),
                'caption' => 'Kenal BPS Lebih Dekat, Ciptakan Data Akurat!',
                'location' => 'Badan Pusat Statistik RI & Politeknik Statistika STIS'
            ],
            [
                'title' => 'PKKMB Hari Ke-2',
                'waktu_mulai' => Carbon::createFromTimeString('2024-09-14 01:00:00'),
                'caption' => 'Membangun Diri sebagai Mahasiswa Bermental Tangguh dalam Mengarungi Kehidupan Berorganisasi',
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'PKKMB Hari Ke-3',
                'waktu_mulai' => Carbon::createFromTimeString('2024-09-15 01:00:00'),
                'caption' => 'Membangun Mahasiswa yang Bebas Narkoba, Beretika, dan Berkualitas',
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'PKKMB Hari Ke-4',
                'waktu_mulai' => Carbon::createFromTimeString('2024-09-16 01:00:00'),
                'caption' => 'Membangun Semangat Nasionalisme dan Kesadaran Mahasiswa dalam Menangkal LGBT dan Disinformasi',
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'PKBN',
                'waktu_mulai' => Carbon::createFromTimeString('2024-09-17 01:00:00'),
                'waktu_akhir' => Carbon::createFromTimeString('2024-09-20 01:00:00'),
                'caption' => 'Pembinaan Kesadaran Bela Negara',
                'location' => 'Pusat Pendidikan Jasmani Kodiklat TNI AD'
            ],
            [
                'title' => 'Inaugurasi Angkatan 66',
                'waktu_mulai' => Carbon::createFromTimeString('2024-09-28 01:00:00'),
                'caption' => 'Menjadi Mahasiswa Unggul Melalui Bakat, Karya, dan Kreatifitas',
                'location' => 'Politeknik Statistika STIS'
            ],
        ];

        foreach ($data as $event) {
            Event::create([
                'title' => $event['title'],
                'category' => CATEGORY_EVENT_TIMELINE,
                'caption' => $event['caption'] ?? '-',
                'waktu_mulai' => $event['waktu_mulai'],
                'waktu_akhir' => $event['waktu_akhir'] ?? null,
                'location' => $event['location'] ?? null
            ]);
        }
    }
}
