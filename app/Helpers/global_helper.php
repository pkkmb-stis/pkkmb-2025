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
                'nama' => 'Decapryo Rivian Belo',
                'foto' => 'img/ppo/bph/Decapryo Rivian Belo.png',
                'jabatan' => 'KPO'
            ],
            [
                'nama' => 'Muhammad Choiri Krisna Arsyad',
                'foto' => 'img/ppo/bph/Muhammad Choiri Krisna Arsyad.png',
                'jabatan' => 'WKPO'
            ],
            [
                'nama' => 'Lintang Pertiwi',
                'foto' => 'img/ppo/bph/Lintang Pertiwi.png',
                'jabatan' => 'Sekretaris I'
            ],
            [
                'nama' => 'Fildzah Nur Izzati',
                'foto' => 'img/ppo/bph/Fildzah Nur Izzati.png',
                'jabatan' => 'Sekretaris II'
            ],
            [
                'nama' => 'Kessya Desyka Ayliyanda',
                'foto' => 'img/ppo/bph/Kessya Desyka Ayliyanda.png',
                'jabatan' => 'Bendahara I'
            ],
            [
                'nama' => 'Zaskia Bening Mulia',
                'foto' => 'img/ppo/bph/Zaskia Bening Mulia.png',
                'jabatan' => 'Bendahara II'
            ],
        ];

        $acara = [
            [
                'nama' => 'Muhammad Barkah Amaliansyah',
                'foto' => 'img/ppo/acara/Muhammad Barkah Amaliansyah.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Ahmad Ridho Parabi',
                'foto' => 'img/ppo/acara/Ahmad Ridho Parabi.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Auliya Ahmada Ghinannafsa',
                'foto' => 'img/ppo/acara/Auliya Ahmada Ghinannafsa.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Bungaran Sammy Briandoli Nainggolan',
                'foto' => 'img/ppo/acara/Bungaran Sammy Briandoli Nainggolan.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Hafizh Dzaky Ats Tsaqif',
                'foto' => 'img/ppo/acara/Hafizh Dzaky Ats Tsaqif.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Joys Gresia Ulina Sianturi',
                'foto' => 'img/ppo/acara/Joys Gresia Ulina Sianturi.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Maylani Puspita Sari',
                'foto' => 'img/ppo/acara/Maylani Puspita Sari.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Muhammad Hasbie Hasibuan',
                'foto' => 'img/ppo/acara/Muhammad Hasbie Hasibuan.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Naila Sandra Utami',
                'foto' => 'img/ppo/acara/Naila Sandra Utami.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Renata Cecilia Br Sirait',
                'foto' => 'img/ppo/acara/Renata Cecilia Br Sirait.png',
                'jabatan' => 'Anggota'
            ],
        ];


        $lapk = [
            [
                'nama' => 'Marsya Audia Cholisah',
                'foto' => 'img/ppo/lapk/Marsya Audia Cholisah.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Ananda Natasya',
                'foto' => 'img/ppo/lapk/Ananda Natasya.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Anindya Zahra Damayanti',
                'foto' => 'img/ppo/lapk/Anindya Zahra Damayanti.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Ariella Syifa Maheswari',
                'foto' => 'img/ppo/lapk/Ariella Syifa Maheswari.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Ashy Sulfidah',
                'foto' => 'img/ppo/lapk/Ashy Sulfidah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Cikal Dwijayanti',
                'foto' => 'img/ppo/lapk/Cikal Dwijayanti.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Difya Ayu Meisya Nurjanah',
                'foto' => 'img/ppo/lapk/Difya Ayu Meisya Nurjanah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => "Ego Stiven Rafliza",
                'foto' => 'img/ppo/lapk/Ego Stiven Rafliza.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Grace Sovia Ginting',
                'foto' => 'img/ppo/lapk/Grace Sovia Ginting.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Haris Farestu',
                'foto' => 'img/ppo/lapk/Haris Farestu.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Helmi Handi Pratama',
                'foto' => 'img/ppo/lapk/Helmi Handi Pratama.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Imam Mansyur',
                'foto' => 'img/ppo/lapk/Imam Mansyur.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Indah Dwi Yuniati',
                'foto' => 'img/ppo/lapk/Indah Dwi Yuniati.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Isnani Hayatur Rohmah',
                'foto' => 'img/ppo/lapk/Isnani Hayatur Rohmah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Kadek Sri Nagitha Suaryanti',
                'foto' => 'img/ppo/lapk/Kadek Sri Nagitha Suaryanti.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Kukuh Bagus Purnomo Sidik',
                'foto' => 'img/ppo/lapk/Kukuh Bagus Purnomo Sidik.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Malika Dzikra Kalila Ramadhani',
                'foto' => 'img/ppo/lapk/Malika Dzikra Kalila Ramadhani.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Mohammad Zidane A. Satriaji',
                'foto' => 'img/ppo/lapk/Mohammad Zidane A. Satriaji.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Najwa Alya Fauziah',
                'foto' => 'img/ppo/lapk/Najwa Alya Fauziah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Nikolas Agape',
                'foto' => 'img/ppo/lapk/Nikolas Agape.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Sanda Yulianti',
                'foto' => 'img/ppo/lapk/Sanda Yulianti.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Saveria Risanti Hutasoit',
                'foto' => 'img/ppo/lapk/Saveria Risanti Hutasoit.png',
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
                'nama' => 'Ilyas Ramadhan',
                'foto' => 'img/ppo/gramti/Ilyas Ramadhan.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Arif Budiman',
                'foto' => 'img/ppo/gramti/Arif Budiman.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Ihsan Nurrahman',
                'foto' => 'img/ppo/gramti/Ihsan Nurrahman.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Ibrahim Bazra Ritonga',
                'foto' => 'img/ppo/gramti/Ibrahim Bazra Ritonga.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Isnan Akbar Saputra',
                'foto' => 'img/ppo/gramti/Isnan Akbar Saputra.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Kaylla Zahrani',
                'foto' => 'img/ppo/gramti/Kaylla Zahrani.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Nabhan Athallah',
                'foto' => 'img/ppo/gramti/Nabhan Athallah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Rehandhika Arya Pratama',
                'foto' => 'img/ppo/gramti/Rehandhika Arya Pratama.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $hpd = [
            [
                'nama' => 'Andra Adiputra Rudianto',
                'foto' => 'img/ppo/hpd/Andra Adiputra Rudianto.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Amelia Deranaya Shafira',
                'foto' => 'img/ppo/hpd/Amelia Deranaya Shafira.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Anugrah Putri Indahsari Tria Meiliana',
                'foto' => 'img/ppo/hpd/Anugrah Putri Indahsari Tria Meiliana.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Araminta Abidah',
                'foto' => 'img/ppo/hpd/Araminta Abidah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Dzaky Aska Pradipta',
                'foto' => 'img/ppo/hpd/Dzaky Aska Pradipta.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Gusti Ayu Made Putra Pebriani Dharmawan',
                'foto' => 'img/ppo/hpd/Gusti Ayu Made Putra Pebriani Dharmawan.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Hielda Setya Khanifah',
                'foto' => 'img/ppo/hpd/Hielda Setya Khanifah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Mufidah Azzahrah',
                'foto' => 'img/ppo/hpd/Mufidah Azzahrah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Nailis Sahila',
                'foto' => 'img/ppo/hpd/Nailis Sahila.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Nathania Nandika Calluella',
                'foto' => 'img/ppo/hpd/Nathania Nandika Calluella.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Satria Imka Dwi Putra',
                'foto' => 'img/ppo/hpd/Satria Imka Dwi Putra.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Sheila Berliana Sunan',
                'foto' => 'img/ppo/hpd/Sheila Berliana Sunan.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $ppm = [
            [
                'nama' => 'Khilwa Layyina',
                'foto' => 'img/ppo/ppm/Khilwa Layyina.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Ahmad Rafi\'izra Nugraha',
                'foto' => 'img/ppo/ppm/Ahmad Rafiizra Nugraha.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Deka Sholiha Kartika Habsari',
                'foto' => 'img/ppo/ppm/Deka Sholiha Kartika Habsari.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Depati Zaid Haikal',
                'foto' => 'img/ppo/ppm/Depati Zaid Haikal.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Fathania Nur Rahmadhani',
                'foto' => 'img/ppo/ppm/Fathania Nur Rahmadhani.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Lydia Aushaf Ozora Siregar',
                'foto' => 'img/ppo/ppm/Lydia Aushaf Ozora Siregar.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Reva Auliya Qurrota A\'yun',
                'foto' => 'img/ppo/ppm/Reva Auliya Qurrota A\'yun.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Rizki Ali Wafa',
                'foto' => 'img/ppo/ppm/Rizki Ali Wafa.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Rizqi Arby Maulana',
                'foto' => 'img/ppo/ppm/Rizqi Arby Maulana.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $tibum = [
            [
                'nama' => 'Ica Bali Tri Susmita',
                'foto' => 'img/ppo/tibum/Ica Bali Tri Susmita.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Aan Hidayat Tulloh',
                'foto' => 'img/ppo/tibum/Aan Hidayat Tulloh.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Alya Nailah Zaid',
                'foto' => 'img/ppo/tibum/Alya Nailah Zaid.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Andrian Fajar Fahmi',
                'foto' => 'img/ppo/tibum/Andrian Fajar Fahmi.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Joyce Cynthia Br Sitorus',
                'foto' => 'img/ppo/tibum/Joyce Cynthia Br Sitorus.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Luis Montoya Stefanus Siregar',
                'foto' => 'img/ppo/tibum/Luis Montoya Stefanus Siregar.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Mohamad Zidan Al Farizi',
                'foto' => 'img/ppo/tibum/Mohamad Zidan Al Farizi.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Nofal Febrian Nugraha',
                'foto' => 'img/ppo/tibum/Nofal Febrian Nugraha.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Nuraini Fauziah',
                'foto' => 'img/ppo/tibum/Nuraini Fauziah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Putri Yuli Yanti',
                'foto' => 'img/ppo/tibum/Putri Yuli Yanti.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Romizard Rasendriya',
                'foto' => 'img/ppo/tibum/Romizard Rasendriya.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Samuel Kevin',
                'foto' => 'img/ppo/tibum/Samuel Kevin.png',
                'jabatan' => 'Anggota'
            ],
        ];

        $umum = [
            [
                'nama' => 'Ramadhani Zaki Suruuri',
                'foto' => 'img/ppo/umum/Ramadhani Zaki Suruuri.png',
                'jabatan' => 'Koordinator'
            ],
            [
                'nama' => 'Ayra Jasmine Hasibuan',
                'foto' => 'img/ppo/umum/Ayra Jasmine Hasibuan.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Aziz Hidayatulloh',
                'foto' => 'img/ppo/umum/Aziz Hidayatulloh.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Bambang Fathdry Hermawan',
                'foto' => 'img/ppo/umum/Bambang Fathdry Hermawan.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Dinda Putri Nur Wulandari',
                'foto' => 'img/ppo/umum/Dinda Putri Nur Wulandari.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Muhamad Fadhlan Hendri',
                'foto' => 'img/ppo/umum/Muhamad Fadhlan Hendri.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Raziq Alzam Fadlullah',
                'foto' => 'img/ppo/umum/Raziq Alzam Fadlullah.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Regita Maulidya Hidayat',
                'foto' => 'img/ppo/umum/Regita Maulidya Hidayat.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Sawangi Kasturi',
                'foto' => 'img/ppo/umum/Sawangi Kasturi.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Yudhistira Putra Herlambang',
                'foto' => 'img/ppo/umum/Yudhistira Putra Herlambang.png',
                'jabatan' => 'Anggota'
            ],
            [
                'nama' => 'Zenas Samosir',
                'foto' => 'img/ppo/umum/Zenas Samosir.png',
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
    if (!function_exists('getDosen')) {
        /**
         * getDosen
         *
         * @return array
         */
        function getDosen()
        {
            $pelindung = [
                ['nama' => 'Dr. Erni Tri Astuti, M.Math.', 'foto' => 'img/dosen/pelindung/Erni Tri Astuti.png', 'jabatan' => 'Pelindung']
            ];
            $pengarah = [
                ['nama' => 'Prof. Setia Pramana, S.Si., M.Sc., Ph.D', 'foto' => 'img/dosen/pengarah/Setia.png', 'jabatan' => 'Pengarah'],
                ['nama' => 'Prof. Dr. Hardius Usman, S.Si., M.Si.', 'foto' => 'img/dosen/pengarah/hardius.png', 'jabatan' => 'Pengarah'],
                ['nama' => 'Dr. Yunarso Anang Sulistiadi, M.Eng.', 'foto' => 'img/dosen/pengarah/Yunarso Anang.png', 'jabatan' => 'Pengarah'],
            ];
            $pembina = [
                ['nama' => 'Bambang Nurcahyo S.E., M.M.', 'foto' => 'img/dosen/pembina/Bambang Nurcahyo.png', 'jabatan' => 'Pembina'],
                ['nama' => 'Nurseto Wisnumurti, S.Si., M.Stat.', 'foto' => 'img/dosen/pembina/Nurseto Wisnumurti.png', 'jabatan' => 'Pembina'],
                ['nama' => 'Dr. Azka Ubaidillah, SST, M.Si.', 'foto' => 'img/dosen/pembina/AZka.png', 'jabatan' => 'Pembina'],
                ['nama' => 'Ibnu Santoso, SST, M.T.', 'foto' => 'img/dosen/pembina/Ibnu.png', 'jabatan' => 'Pembina'],
                ['nama' => 'Agung Priyo Utomo, S.Si., M.T.', 'foto' => 'img/dosen/pembina/Agung PU.png', 'jabatan' => 'Pembina'],
            ];
            $penanggung_jawab = [
                ['nama' => 'Wahyudin, S.Si., MAP, MPP', 'foto' => 'img/dosen/penanggungg_jawab/Wahyudin.png', 'jabatan' => 'Penanggung Jawab'],
                ['nama' => 'Dwy Bagus Cahyono, SST, M.T.', 'foto' => 'img/dosen/penanggungg_jawab/Dwy Bagus.png', 'jabatan' => 'Penanggung Jawab'],
                ['nama' => 'Sofyan Ayatulloh, SST', 'foto' => 'img/dosen/penanggungg_jawab/Sofyan Ayatulloh.png', 'jabatan' => 'Penanggung Jawab'],
            ];
            $pengawas = [
                ['nama' => 'Liza Kurnia Sari, S.Si., M.Stat.', 'foto' => 'img/dosen/pengawas/Liza.png', 'jabatan' => 'Koordinator'],
                ['nama' => 'Yaya Setiadi, M.M., M.Pd.', 'foto' => 'img/dosen/pengawas/Yaya Setiadi.png', 'jabatan' => 'Anggota'],
                ['nama' => 'Retnaningsih, S.Si., M.E.', 'foto' => 'img/dosen/pengawas/Retnaningsih.png', 'jabatan' => 'Anggota'],
                ['nama' => 'Firdaus, MBA', 'foto' => 'img/dosen/pengawas/Firdaus.png', 'jabatan' => 'Anggota'],
                ['nama' => 'Nofita Istiana, SST, M.Si.', 'foto' => 'img/dosen/pengawas/Nofita.png', 'jabatan' => 'Anggota'],
            ];
            // Mengubah nama variabel agar tidak bentrok
            $bph_dosen = [
                ['nama' => 'Budyanra, SST, M.Stat.', 'foto' => 'img/dosen/bph/Budyanra.png', 'jabatan' => 'Ketua Pelaksana'],
                ['nama' => 'Ary Wahyuni, SST', 'foto' => 'img/dosen/bph/Ary Wahyuni.png', 'jabatan' => 'Koor Bendahara'],
                ['nama' => 'Maya Hayuningtyas, S.E.', 'foto' => 'img/dosen/bph/Maya.png', 'jabatan' => 'Koor Sekretaris'],
            ];
            $acara_dosen = [
                ['nama' => 'Ricky Yordani, S.ST, M.Stat', 'foto' => 'img/dosen/acara/Ricky Yordani.png', 'jabatan' => 'Koordinator'],
                ['nama' => 'Atik Mar`atis Suhartini, SST, M.Si.', 'foto' => 'img/dosen/acara/Atik Mar`atis Suhartini.png', 'jabatan' => 'Anggota'],
            ];
            $lapk_dosen = [
                ['nama' => 'Dr. Ita Wulandari, SST, M.Si.', 'foto' => 'img/dosen/lapk/Ita Wulandari.png', 'jabatan' => 'Koordinator'],
                ['nama' => 'Dr. Cucu Sumarni, M.Si.', 'foto' => 'img/dosen/lapk/Cucu Sumarni.png', 'jabatan' => 'Anggota'],
            ];
            $hpd_dosen = [
                ['nama' => 'Farashinta Julhija Karim, S.E., M.Si.', 'foto' => 'img/dosen/hpd/Farashinta Julhija Karim.png', 'jabatan' => 'Koordinator'],
            ];
            $gramti_dosen = [
                ['nama' => 'Alif Wira Bayu, S.Tr.Stat', 'foto' => 'img/dosen/gramti/Alif Wira Bayu.png', 'jabatan' => 'Koordinator'],
            ];
            $tibum_dosen = [
                ['nama' => 'Dr. Timbang Sirait, M.Si.', 'foto' => 'img/dosen/tibum/Timbang Sirait.png', 'jabatan' => 'Koordinator'],
            ];
            $ppm_dosen = [
                ['nama' => 'Lia Yuliana, S.Si., M.T.', 'foto' => 'img/dosen/ppm/Lia.png', 'jabatan' => 'Koordinator'],
                ['nama' => 'Novariani S.Kep.', 'foto' => 'img/dosen/ppm/Novariani.png', 'jabatan' => 'Anggota'],
            ];
            $umum_dosen = [
                ['nama' => 'Cahyo Wibowo, SST.', 'foto' => 'img/dosen/umum/Cahyo Wibowo.png', 'jabatan' => 'Koordinator'],
            ];

            // Menggunakan nama kunci yang unik
            return [
                'pelindung' => $pelindung,
                'pengarah' => $pengarah,
                'pembina' => $pembina,
                'penanggung_jawab' => $penanggung_jawab,
                'pengawas' => $pengawas,
                'bph_dosen' => $bph_dosen,
                'acara_dosen' => $acara_dosen,
                'lapk_dosen' => $lapk_dosen,
                'hpd_dosen' => $hpd_dosen,
                'gramti_dosen' => $gramti_dosen,
                'tibum_dosen' => $tibum_dosen,
                'ppm_dosen' => $ppm_dosen,
                'umum_dosen' => $umum_dosen
            ];
        }
    }
}
