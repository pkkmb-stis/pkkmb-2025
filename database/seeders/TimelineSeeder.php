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
                'waktu_mulai' => Carbon::createFromTimeString('2025-10-06 01:00:00'),
                'location' => 'Website Politeknik Statistika STIS'
            ],
            [
                'title' => 'Verifikasi Berkas',
                'waktu_mulai' => Carbon::createFromTimeString('2025-10-09 01:00:00'),
                'waktu_akhir' => Carbon::createFromTimeString('2025-10-10 23:59:00'),
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'Penyambutan Mahasiswa Baru & Pra PKKMB',
                'waktu_mulai' => Carbon::createFromTimeString('2025-10-11 01:00:00'),
                'waktu_akhir' => Carbon::createFromTimeString('2025-10-12 01:00:00'),
                'caption' => 'Langkah Awal Bersama, Bangun Semangat Menjadi Mahasiswa Seutuhnya',
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'PKKMB Hari Ke-1',
                'waktu_mulai' => Carbon::createFromTimeString('2025-11-07 01:00:00'),
                'caption' => 'Mengukuhkan Identitas Sebagai Mahasiswa Dalam Rangka Menjadi Calon Statistisi Profesional yang Beretika',
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'PKKMB Hari Ke-2',
                'waktu_mulai' => Carbon::createFromTimeString('2025-11-08 01:00:00'),
                'caption' => 'Membangun Diri sebagai Mahasiswa Bermental Tangguh dalam Mengarungi Kehidupan Berorganisasi',
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'PKKMB Hari Ke-3',
                'waktu_mulai' => Carbon::createFromTimeString('2025-11-14 01:00:00'),
                'caption' => '',
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'PKKMB Hari Ke-4',
                'waktu_mulai' => Carbon::createFromTimeString('2025-11-15 01:00:00'),
                'caption' => 'Memanfaatkan Sosial Media dalam Membangun Personal Branding Generasi Muda Anti Narkoba dan Berintegritas',
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'PKKMB Hari Ke-5',
                'waktu_mulai' => Carbon::createFromTimeString('2025-11-21 01:00:00'),
                'caption' => 'Literasi Digital dan Penguatan Karakter Mahasiswa dalam Pencegahan Perilaku LGBT',
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'PKKMB Hari Ke-6',
                'waktu_mulai' => Carbon::createFromTimeString('2025-11-22 01:00:00'),
                'caption' => 'Optimalisasi Potensi Mahasiswa Melalui Pengelolaan Keuangan yang Bijak dan Kesehatan Mental yang Seimbang',
                'location' => 'Politeknik Statistika STIS'
            ],
            [
                'title' => 'Inaugurasi Angkatan 67',
                'waktu_mulai' => Carbon::createFromTimeString('2025-12-19 01:00:00'),
                'caption' => 'Melangkah Bersama, Menjadi Generasi Kedinasan BerAKHLAK dan Berintegritas',
                'location' => 'Auditorium Politeknik Statistika STIS'
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
