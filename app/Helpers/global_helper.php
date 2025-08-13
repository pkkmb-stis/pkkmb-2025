<?php

use Carbon\Carbon;

if (!function_exists('userHasPermission')) {
    /**
     * untuk cek apakah user yang sedang login memiliki permission tertentu
     *
     * @param  string $permission
     * @return bool
     */
    function userHasPermission($permission)
    {
        return auth()->check() && auth()->user()->can($permission);
    }
}

if (!function_exists('storage')) {
    /**
     * storage link
     *
     * @param  mixed $link
     * @return string
     */
    function storage($link)
    {
        return asset('storage/' . $link);
    }
}

if (!function_exists('renameToDownload')) {
    /**
     * renameToDownload, custom file name to download
     *
     * @param  mixed $nama
     * @param  mixed $url
     * @return string
     */
    function renameToDownload($nama, $url)
    {
        $ekstensi = collect(explode('.', $url))->last();
        return $nama . '.' . $ekstensi;
    }
}

if (!function_exists('previewDokumen')) {
    /**
     * previewDokumen
     *
     * @param  mixed $url
     * @return string
     */
    function previewDokumen($url)
    {
        return "http://docs.google.com/gview?url={$url}&embedded=true";
    }
}

if (!function_exists('getPenugasan')) {
    /**
     * getPenugasan
     *
     * @return array
     */
    function getPenugasan()
    {
        return [
            [
                'waktu-akses' => Carbon::createFromTimeString('2024-09-12 12:00:00'),
                'nama' => 'Penugasan Pra PKKMB-PKBN',
                'link' => asset('penugasan/BUKU PEDOMAN PRA-PKKMB.pdf'),
                'downloadName' => 'Penugasan-Pra-PKKMB-PKBN.pdf'
            ],
            [
                'waktu-akses' => Carbon::createFromTimeString('2024-09-13 06:00:00'),
                'nama' => 'Penugasan Hari Pertama PKKMB-PKBN',
                'link' => asset('penugasan/BUKU PEDOMAN PKKMB HARI KE-1.pdf'),
                'downloadName' => 'Penugasan-Hari-1-PKKMB-PKBN.pdf'
            ],
            [
                'waktu-akses' => Carbon::createFromTimeString('2024-09-14 06:00:00'),
                'nama' => 'Penugasan Hari Kedua PKKMB-PKBN',
                'link' => asset('penugasan/BUKU PEDOMAN PKKMB HARI KE-2.pdf'),
                'downloadName' => 'Penugasan-Hari-2-PKKMB-PKBN.pdf'
            ],
            [
                'waktu-akses' => Carbon::createFromTimeString('2024-09-15 06:00:00'),
                'nama' => 'Penugasan Hari Ketiga PKKMB-PKBN',
                'link' => asset('penugasan/BUKU PEDOMAN PKKMB HARI KE-3.pdf'),
                'downloadName' => 'Penugasan-Hari-3-PKKMB-PKBN.pdf'
            ],
            [
                'waktu-akses' => Carbon::createFromTimeString('2024-09-16 06:00:00'),
                'nama' => 'Penugasan Hari Keempat PKKMB-PKBN',
                'link' => asset('penugasan/BUKU PEDOMAN PKKMB HARI KE-4.pdf'),
                'downloadName' => 'Penugasan-Hari-4-PKKMB-PKBN.pdf'
            ],
        ];
    }
}

if (!function_exists('getJurusan')) {
    /**
     * getJurusan
     *
     * @return array
     */
    function getJurusan()
    {
        return ['D3 Statistika', 'D4 Statistika', 'D4 Komputasi Statistik'];
    }
}

if (!function_exists('getRincianKegiatan')) {
    /**
     * getRincianKegiatan
     *
     * @return array
     */
    function getRincianKegiatan()
    {
        return [
            'rincian_kegiatan_pra_mp2k.pdf',
            'rincian_kegiatan_hari1_mp2k.pdf',
            'rincian_kegiatan_hari2_mp2k.pdf',
            'rincian_kegiatan_hari3_mp2k.pdf',
            'rincian_kegiatan_hari4_mp2k.pdf',
            'rincian_kegiatan_hari1_pkbn.pdf',
            'rincian_kegiatan_hari2_pkbn.pdf',
            'rincian_kegiatan_hari3_pkbn.pdf',
            'rincian_kegiatan_hari4_pkbn.pdf',
            'rincian_kegiatan_pra_inaugurasi.pdf',
            'rincian_kegiatan_inaugurasi.pdf',
            'rincian_kegiatan_inaugurasi.pdf',
        ];
    }
}

if (!function_exists('getHimada')) {
    /**
     * getHimada
     *
     * @return array
     */
    function getHimada()
    {
        return [
            'KEMASS (Sumatra Selatan)',
            'KS3 (Bangka Belitung)',
            'KBMSY (Yogyakarta)',
            'SABURAI (Lampung)',
            'BALISTIS (Bali)',
            'IMF (Flores)',
            'IMASSU (Sumatra Utara)',
            'IKMM (Sumatra Barat)',
            'HIMARI (Riau dan Kepri)',
            'JATENG (Jawa Tengah)',
            "MAVIA'S (Jakarta)",
            'BEKISAR (Jawa Timur)',
            'KAJABA (Jawa Barat)',
            'SMS (Jambi)',
            'HIMAMIRA (Bengkulu)',
            'MPC (Maluku-Papua)',
            'IMASSI (Sulawesi)',
            'IMSAK (Kalimantan)',
            'RINJANI (NTB)',
            'GIST (Aceh)'
        ];
    }
}


if (!function_exists('getQuotes')) {
    /**
     * getQuotes to dashboard
     *
     * @return string
     */
    function getQuotes()
    {
        return collect([
            "Segala sesuatu yang negatif, tekanan, dan tantangan adalah kesempatan bagiku untuk bangkit. -- Kobe Bryant",
            "Hidup tidak pernah mudah. Ada pekerjaan yang harus dilakukan dan kewajiban yang harus dipenuhi, kewajiban terhadap kebenaran, keadilan, dan kebebasan. -- John F. Kennedy",
            "Hal-hal besar dilakukan oleh serangkaian hal-hal kecil yang disatukan. -- Vincent van Gogh",
            "Kehidupan yang tidak diuji tidak layak untuk dijalani. -- Socrates",
            "Sudah lama menjadi perhatian saya bahwa orang-orang berprestasi jarang duduk dan membiarkan sesuatu terjadi pada mereka. Mereka keluar dan mengalami banyak hal. -- Leonardo da Vinci",
            "Satu-satunya sumber dari pengetahuan adalah pengalaman. -- Albert Einstein ",
            "Kesenangan dalam sebuah pekerjaan membuat kesempurnaan pada hasil yang dicapai. -- Aristoteles",
            "Waktumu terbatas, jadi jangan sia-siakan dengan menjalani hidup orang lain. Jangan terjebak oleh dogma, yaitu hidup dengan hasil pemikiran orang lain. -- Steve Jobs ",
            "Usaha dan keberanian tidak cukup tanpa tujuan dan arah perencanaan. -- John F. Kennedy",
            "Dunia ini cukup untuk memenuhi kebutuhan manusia, bukan untuk memenuhi keserakahan manusia. -- Mahatma Gandhi",
            "Semua impian kita bisa menjadi kenyataan, jika kita memiliki keberanian untuk mengejarnya. -- Walt Disney"
        ])->random();
    }
}

if (!function_exists('csv_to_array')) {
    /**
     * read csv file
     *
     * @param  mixed $filename
     * @param  mixed $delimiter
     * @return array
     */
    function csv_to_array($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
}

if (!function_exists('getPanitia')) {
    /**
     * getPanitia
     *
     * @return array
     */
    function getPanitia()
    {
        $bph = [
            [
                'nama' => 'M. Ridlo Ubaidillah',
                'foto' => 'img/ppo/bph/M. Ridlo Ubaidillah.png',
                'jabatan' => 'KPO'
            ],
            [
                'nama' => 'Kilat Tri Prasetyo',
                'foto' => 'img/ppo/bph/Kilat Tri Prasetyo.png',
                'jabatan' => 'WKPO'
            ],
            [
                'nama' => 'Fathiyah Nur Shohwah',
                'foto' => 'img/ppo/bph/Fathiyah Nur Shohwah.png',
                'jabatan' => 'Sekretaris I'
            ],
            [
                'nama' => 'Yohana Herdianly Br Nainggolan',
                'foto' => 'img/ppo/bph/Yohana Herdianly Br Nainggolan.png',
                'jabatan' => 'Sekretaris II'
            ],
            [
                'nama' => 'Hervira Nur Shafira',
                'foto' => 'img/ppo/bph/Hervira Nur Shafira.png',
                'jabatan' => 'Bendahara I'
            ],
            [
                'nama' => 'Athiyah Tsurayya',
                'foto' => 'img/ppo/bph/Athiyah Tsurayya.png',
                'jabatan' => 'Bendahara II'
            ],
        ];

        $acara = [
            [
                'nama' => 'Zahra Mufidah Ariani',
                'foto' => 'img/ppo/acara/Zahra Mufidah Ariani.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Aurelia Dini Syafnadiva',
                'foto' => 'img/ppo/acara/Aurelia Dini Syafnadiva.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Decapryo Rivian Belo',
                'foto' => 'img/ppo/acara/Decapryo Rivian Belo.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Maylani Puspita Sari',
                'foto' => 'img/ppo/acara/Maylani Puspita Sari.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Muhammad Barkah Amaliansyah',
                'foto' => 'img/ppo/acara/Muhammad Barkah Amaliansyah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Muhammad Choiri Krisna Arsyad',
                'foto' => 'img/ppo/acara/Muhammad Choiri Krisna Arsyad.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Nela Nur \'Azizah',
                'foto' => 'img/ppo/acara/Nela Nur \'Azizah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Putu Ayudhia Pratami Putri',
                'foto' => 'img/ppo/acara/Putu Ayudhia Pratami Putri.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Yuliana Kartika Permadani',
                'foto' => 'img/ppo/acara/Yuliana Kartika Permadani.png',
                'jabatan' => 'Anggota'
            ],
        ];


        $lapk = [
            [
                'nama' => 'Fadiah Yahya',
                'foto' => 'img/ppo/lapk/Fadiah Yahya.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Adrian Januartha',
                'foto' => 'img/ppo/lapk/Adrian Januartha.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Ahmad Excell Ramadhan',
                'foto' => 'img/ppo/lapk/Ahmad Excell Ramadhan.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Anggi Dwi Puspita',
                'foto' => 'img/ppo/lapk/Anggi Dwi Puspita.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Berniko Surya Wibawa',
                'foto' => 'img/ppo/lapk/Berniko Surya Wibawa.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Bunga Musva Cotva',
                'foto' => 'img/ppo/lapk/Bunga Musva Cotva.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Fatikha Nuraziza',
                'foto' => 'img/ppo/lapk/Fatikha Nuraziza.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => "Haris Farestu",
                'foto' => 'img/ppo/lapk/Haris Farestu.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Helmi Handi Pratama',
                'foto' => 'img/ppo/lapk/Helmi Handi Pratama.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Janitra Hayu Pramestya',
                'foto' => 'img/ppo/lapk/Janitra Hayu Pramestya.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Kadek Sri Nagitha Suaryanti',
                'foto' => 'img/ppo/lapk/Kadek Sri Nagitha Suaryanti.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Lydia Aushaf Ozora Siregar',
                'foto' => 'img/ppo/lapk/Lydia Aushaf Ozora Siregar.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Marsya Audia Cholisah',
                'foto' => 'img/ppo/lapk/Marsya Audia Cholisah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Mohammad Zidane Akbar Satriaji',
                'foto' => 'img/ppo/lapk/Mohammad Zidane Akbar Satriaji.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Najwa Alya Fauziah',
                'foto' => 'img/ppo/lapk/Najwa Alya Fauziah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Rafi Ariq Hakim',
                'foto' => 'img/ppo/lapk/Rafi Ariq Hakim.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Rayhan Ardi Fardian',
                'foto' => 'img/ppo/lapk/Rayhan Ardi Fardian.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Uswatun Nisa Ritonga',
                'foto' => 'img/ppo/lapk/Uswatun Nisa Ritonga.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Zahra Khairunnisa',
                'foto' => 'img/ppo/lapk/Zahra Khairunnisa.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $gramti = [
            [
                'nama' => 'Farhan Adi Suripto',
                'foto' => 'img/ppo/gramti/Farhan Adi Suripto.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Esra Yosefa Simarmata',
                'foto' => 'img/ppo/gramti/Esra Yosefa Simarmata.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Ilyas Ramadhan',
                'foto' => 'img/ppo/gramti/Ilyas Ramadhan.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Made Nisa Rahayu Ananda Suwendra',
                'foto' => 'img/ppo/gramti/Made Nisa Rahayu Ananda Suwendra.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Muhammad Rayhan Faridh',
                'foto' => 'img/ppo/gramti/Muhammad Rayhan Faridh.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Rizkyana Azka Akhiria Ramadhanti',
                'foto' => 'img/ppo/gramti/Rizkyana Azka Akhiria Ramadhanti.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Thoriq Mustafa Akmal',
                'foto' => 'img/ppo/gramti/Thoriq Mustafa Akmal.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $hpd = [
            [
                'nama' => 'Dustin Raka Widiananta Aslam',
                'foto' => 'img/ppo/hpd/Dustin Raka Widiananta Aslam.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Alisha Islami Zukhruf',
                'foto' => 'img/ppo/hpd/Alisha Islami Zukhruf.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Andra Adiputra Rudianto',
                'foto' => 'img/ppo/hpd/Andra Adiputra Rudianto.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Destiana Salsabila',
                'foto' => 'img/ppo/hpd/Destiana Salsabila.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Firda Dessya Dwitanti',
                'foto' => 'img/ppo/hpd/Firda Dessya Dwitanti.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Iqbal Maulana',
                'foto' => 'img/ppo/hpd/Iqbal Maulana.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Lintang Pertiwi',
                'foto' => 'img/ppo/hpd/Lintang Pertiwi.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Maharani Nur Halizah',
                'foto' => 'img/ppo/hpd/Maharani Nur Halizah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Nasywa Saniyyah',
                'foto' => 'img/ppo/hpd/Nasywa Saniyyah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Putu Sinta Pramastini',
                'foto' => 'img/ppo/hpd/Putu Sinta Pramastini.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Syifa Hana Salsabila Nadra Gustari',
                'foto' => 'img/ppo/hpd/Syifa Hana Salsabila Nadra Gustari.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $ppm = [
            [
                'nama' => 'Elsya Nabila',
                'foto' => 'img/ppo/ppm/Elsya Nabila.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Azizah Hemilton',
                'foto' => 'img/ppo/ppm/Azizah Hemilton.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Kessya Desyka Ayliyanda',
                'foto' => 'img/ppo/ppm/Kessya Desyka Ayliyanda.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Khilwa Layyina',
                'foto' => 'img/ppo/ppm/Khilwa Layyina.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Miranti Nabila Ramadhani',
                'foto' => 'img/ppo/ppm/Miranti Nabila Ramadhani.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Rizqi Arby Maulana',
                'foto' => 'img/ppo/ppm/Rizqi Arby Maulana.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Roland Yohanes Renteng',
                'foto' => 'img/ppo/ppm/Roland Yohanes Renteng.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Ully Prisea Mawadah',
                'foto' => 'img/ppo/ppm/Ully Prisea Mawadah.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $tibum = [
            [
                'nama' => 'Imam Fathoni Arufi',
                'foto' => 'img/ppo/tibum/Imam Fathoni Arufi.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Aan Hidayat Tulloh',
                'foto' => 'img/ppo/tibum/Aan Hidayat Tulloh.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Alif Hidayah Nur Rahmadani',
                'foto' => 'img/ppo/tibum/Alif Hidayah Nur Rahmadani.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Andrian Fajar Fahmi',
                'foto' => 'img/ppo/tibum/Andrian Fajar Fahmi.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Berlian Bagus Antonia',
                'foto' => 'img/ppo/tibum/Berlian Bagus Antonia.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Davika Fathma Gusnindar',
                'foto' => 'img/ppo/tibum/Davika Fathma Gusnindar.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Ica Bali Tri Susmita',
                'foto' => 'img/ppo/tibum/Ica Bali Tri Susmita.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Muhamad Choza Inul Muna',
                'foto' => 'img/ppo/tibum/Muhamad Choza Inul Muna.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Nur Faqih Ihsan',
                'foto' => 'img/ppo/tibum/Nur Faqih Ihsan.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Putra Dafa Pratama',
                'foto' => 'img/ppo/tibum/Putra Dafa Pratama.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Wisnu Aimariyadi',
                'foto' => 'img/ppo/tibum/Wisnu Aimariyadi.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $umum = [
            [
                'nama' => 'Dimas Haafizh Rahman',
                'foto' => 'img/ppo/umum/Dimas Haafizh Rahman.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Afifah Dayan Syaharani',
                'foto' => 'img/ppo/umum/Afifah Dayan Syaharani.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Annisa Rizqillah',
                'foto' => 'img/ppo/umum/Annisa Rizqillah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Arizki Dwi Cahyo',
                'foto' => 'img/ppo/umum/Arizki Dwi Cahyo.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Dinda Putri Nur Wulandari',
                'foto' => 'img/ppo/umum/Dinda Putri Nur Wulandari.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Hafidh Dzaky A',
                'foto' => 'img/ppo/umum/Hafidh Dzaky A.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'I Gede Rizky Putra Arnawa',
                'foto' => 'img/ppo/umum/I Gede Rizky Putra Arnawa.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Ramadhani Zaki Suruuri',
                'foto' => 'img/ppo/umum/Ramadhani Zaki Suruuri.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Rihhadatul Aisy\'',
                'foto' => 'img/ppo/umum/Rihhadatul Aisy\'.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Yoceylin Feby Sitorus',
                'foto' => 'img/ppo/umum/Yoceylin Feby Sitorus.png',
                'jabatan' => 'Anggota'
            ],
        ];

        return [
            'bph' => $bph,
            'acara' => $acara,
            'lapk' => $lapk,
            'gramti' => $gramti,
            'ppm' => $ppm,
            'hpd' => $hpd,
            'tibum' => $tibum,
            'umum' => $umum
        ];
    }
}

if (!function_exists('getDosen')) {
    /**
     * getPanitia
     *
     * @return array
     */
    function getDosen()
    {
        $pelindung = [
            [
                'nama' => 'Dr. Erni Tri Astuti, M.Math.',
                'foto' => 'img/dosen/pelindung/Erni Tri Astuti.png',
                'jabatan' => 'Pelindung'
            ]
        ];

        $pengarah = [
            [
                'nama' => 'Prof. Setia Pramana, S.Si., M.Sc., Ph.D',
                'foto' => 'img/dosen/pengarah/Setia.png',
                'jabatan' => 'Pengarah'
            ],
            [
                'nama' => 'Prof. Dr. Hardius Usman, S.Si., M.Si.',
                'foto' => 'img/dosen/pengarah/hardius.png',
                'jabatan' => 'Pengarah'
            ],
            [
                'nama' => 'Dr. Yunarso Anang Sulistiadi, M.Eng.',
                'foto' => 'img/dosen/pengarah/Yunarso Anang.png',
                'jabatan' => 'Pengarah'
            ],
        ];

        $pembina = [
            [
                'nama' => 'Bambang Nurcahyo S.E., M.M.',
                'foto' => 'img/dosen/pembina/Bambang Nurcahyo.png',
                'jabatan' => 'Pembina'
            ],
            [
                'nama' => 'Nurseto Wisnumurti, S.Si., M.Stat.',
                'foto' => 'img/dosen/pembina/Nurseto Wisnumurti.png',
                'jabatan' => 'Pembina'
            ],
            [
                'nama' => 'Dr. Azka Ubaidillah, SST, M.Si.',
                'foto' => 'img/dosen/pembina/AZka.png',
                'jabatan' => 'Pembina'
            ],
            [
                'nama' => 'Ibnu Santoso, SST, M.T.',
                'foto' => 'img/dosen/pembina/Ibnu.png',
                'jabatan' => 'Pembina'
            ],
            [
                'nama' => 'Agung Priyo Utomo, S.Si., M.T.',
                'foto' => 'img/dosen/pembina/Agung PU.png',
                'jabatan' => 'Pembina'
            ],
        ];

        $penanggung_jawab = [
            [
                'nama' => 'Wahyudin, S.Si., MAP, MPP',
                'foto' => 'img/dosen/penanggungg_jawab/Wahyudin.png',
                'jabatan' => 'Penanggung Jawab'
            ],
            [
                'nama' => 'Dwy Bagus Cahyono, SST, M.T.',
                'foto' => 'img/dosen/penanggungg_jawab/Dwy Bagus.png',
                'jabatan' => 'Penanggung Jawab'
            ],
            [
                'nama' => 'Sofyan Ayatulloh, SST',
                'foto' => 'img/dosen/penanggungg_jawab/Sofyan Ayatulloh.png',
                'jabatan' => 'Penanggung Jawab'
            ],
        ];

        $pengawas = [
            [
                'nama' => 'Liza Kurnia Sari, S.Si., M.Stat.',
                'foto' => 'img/dosen/pengawas/Liza.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Yaya Setiadi, M.M., M.Pd.',
                'foto' => 'img/dosen/pengawas/Yaya Setiadi.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Retnaningsih, S.Si., M.E.',
                'foto' => 'img/dosen/pengawas/Retnaningsih.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Firdaus, MBA',
                'foto' => 'img/dosen/pengawas/Firdaus.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Nofita Istiana, SST, M.Si.',
                'foto' => 'img/dosen/pengawas/Nofita.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $bph = [
            [
                'nama' => 'Dr. Timbang Sirait, S.Stat., M.Si.',
                'foto' => 'img/dosen/bph/Timbang.png',
                'jabatan' => 'Ketua Pelaksana'
            ],
            [
                'nama' => 'Dr. Sarni Maniar Berliana, SST, M.Si.',
                'foto' => 'img/dosen/bph/Sarni.png',
                'jabatan' => 'Wakil Ketua'
            ],
            [
                'nama' => 'Luci Wulansari, S.Si., M.S.E.',
                'foto' => 'img/dosen/bph/Luci Wulansari.png',
                'jabatan' => 'Koor Bendahara'
            ],
            [
                'nama' => 'Rina Hardiyanti, SST',
                'foto' => 'img/dosen/bph/Rina.png',
                'jabatan' => 'Bendahara'
            ],
            [
                'nama' => 'Winih Budiarti, SST, M.Stat.',
                'foto' => 'img/dosen/bph/Winih Budiarti.png',
                'jabatan' => 'Koor Sekretariat'
            ],
            [
                'nama' => 'Maya Hayuningtyas, S.E.',
                'foto' => 'img/dosen/bph/Maya.png',
                'jabatan' => 'Sekretariat'
            ]
        ];

        $acara = [
            [
                'nama' => 'Dr. Rita Yuliana, S.Si., MSE',
                'foto' => 'img/dosen/acara/Rita.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Dr. Ernawati Pasaribu, S.Si., M.E.',
                'foto' => 'img/dosen/acara/Ernawati.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Farashintha Julhija Karim, S.E., M.Si.',
                'foto' => 'img/dosen/acara/Farashintha.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $lapk = [
            [
                'nama' => 'Budyanra, SST, M.Stat.',
                'foto' => 'img/dosen/lapk/Budyanra.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Christiana Anggraeni Putri, SST, M.Si.',
                'foto' => 'img/dosen/lapk/Christiana Anggraeni Putri.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Salwa Rizqina Putri, S.Tr.Stat.',
                'foto' => 'img/dosen/lapk/Salwa Rizqina Putri.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $hpd = [
            [
                'nama' => 'Efri Diah Utami, SST, M.Stat.',
                'foto' => 'img/dosen/hpd/Efri Diah.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Avi Rudianita Widya, SST, M.Si.',
                'foto' => 'img/dosen/hpd/Avi Rudianita Widya.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Eko Putra Wahyuddin S.Tr.Stat.',
                'foto' => 'img/dosen/hpd/Eko Putra Wahyuddin.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $gramti = [
            [
                'nama' => 'Robert Kurniawan, SST, M.Si.',
                'foto' => 'img/dosen/gramti/Robert Kurniawan.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Sri Herwanto Dwi Hatmo, S.Si., M.A.',
                'foto' => 'img/dosen/gramti/Sri Herwanto Dwi Hatmo.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $tibum = [
            [
                'nama' => 'Sugiarto, SST, S.Si., M.M.',
                'foto' => 'img/dosen/tibum/Sugiarto.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Erna Nurmawati, SST, M.T.',
                'foto' => 'img/dosen/tibum/Erna Nurmawati.png',
                'jabatan' => 'Anggota'
            ],

        ];

        $ppm = [
            [
                'nama' => 'Lia Yuliana, S.Si., M.T.',
                'foto' => 'img/dosen/ppm/Lia.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Rini Rahani, SST, M.Stat.',
                'foto' => 'img/dosen/ppm/Rini Rahani.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $umum = [
            [
                'nama' => 'Sri Widaryani, S.E., M.Si.',
                'foto' => 'img/dosen/umum/Sri Widaryani.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Rini Silvi, SST, M.Stat.',
                'foto' => 'img/dosen/umum/Rini Silvi.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Cahyo Wibowo, SST',
                'foto' => 'img/dosen/umum/Cahyo Wibowo.png',
                'jabatan' => 'Anggota'
            ],
        ];

        return [
            'pelindung' => $pelindung,
            'pengarah' => $pengarah,
            'pembina' => $pembina,
            'penanggung_jawab' => $penanggung_jawab,
            'pengawas' => $pengawas,
            'bph' => $bph,
            'acara' => $acara,
            'lapk' => $lapk,
            'hpd' => $hpd,
            'gramti' => $gramti,
            'tibum' => $tibum,
            'ppm' => $ppm,
            'umum' => $umum
        ];
    }
}
