<?php

// All Global Constant

// Datetime Format
defined('DEFAULT_DATETIME_FORMAT') || define('DEFAULT_DATETIME_FORMAT', 'Y-m-d H:i:s');


// Untuk Pagination
defined('NUMBER_OF_PAGINATION') || define('NUMBER_OF_PAGINATION', 10);
defined('ON_EACH_SIDE') || define('ON_EACH_SIDE', 1);
defined('DEFAULT_PAGINATION') || define('DEFAULT_PAGINATION', 'pagination.main');

// untuk kelulusan
defined('CAN_AKSES_NILAI') || define('CAN_AKSES_NILAI', '2024-10-01 20:00:00');
defined('STATUS_LULUS_PKKMB_PKBN') || define('STATUS_LULUS_PKKMB_PKBN', 1);
defined('STATUS_LULUS_PKKMB') || define('STATUS_LULUS_PKKMB', 2);
defined('STATUS_LULUS_PKBN') || define('STATUS_LULUS_PKBN', 3);
defined('STATUS_LULUS_BERSYARAT') || define('STATUS_LULUS_BERSYARAT', 4);
defined('STATUS_TIDAK_LULUS') || define('STATUS_TIDAK_LULUS', 5);

// List Permission
// Permission akses per menu
defined('PERMISSION_AKSES_ADMIN') || define('PERMISSION_AKSES_ADMIN', 'akses-admin');
defined('PERMISSION_AKSES_MENU_ADMINISTRATOR') || define('PERMISSION_AKSES_MENU_ADMINISTRATOR', 'akses-menu-administrator');
defined('PERMISSION_AKSES_MENU_LAPK') || define('PERMISSION_AKSES_MENU_LAPK', 'akses-menu-lapk');
defined('PERMISSION_AKSES_MENU_TIBUM') || define('PERMISSION_AKSES_MENU_TIBUM', 'akses-menu-tibum');
defined('PERMISSION_AKSES_MENU_MABA') || define('PERMISSION_AKSES_MENU_MABA', 'akses-menu-maba');
defined('PERMISSION_AKSES_MENU_INFORMASI') || define('PERMISSION_AKSES_MENU_INFORMASI', 'akses-menu-informasi');
defined('PERMISSION_AKSES_MENU_PENGAWAS') || define('PERMISSION_AKSES_MENU_PENGAWAS', 'akses-menu-pengawas');

// Permission Submenu User
defined('PERMISSION_SHOW_USER') || define('PERMISSION_SHOW_USER', 'show-user');
defined('PERMISSION_ADD_USER') || define('PERMISSION_ADD_USER', 'add-user');
defined('PERMISSION_DELETE_USER') || define('PERMISSION_DELETE_USER', 'delete-user');
defined('PERMISSION_UPDATE_INFO_BASIC_USER') || define('PERMISSION_UPDATE_INFO_BASIC_USER', 'update-info-basic-user');
defined('PERMISSION_UPDATE_INFO_TAMBAHAN_USER') || define('PERMISSION_UPDATE_INFO_TAMBAHAN_USER', 'update-info-tambahan-user');

// Permission Submenu Admin
defined('PERMISSION_SHOW_ADMIN') || define('PERMISSION_SHOW_ADMIN', 'show-admin');
defined('PERMISSION_ADD_ADMIN') || define('PERMISSION_ADD_ADMIN', 'add-admin');
defined('PERMISSION_UPDATE_AKSES_ADMIN') || define('PERMISSION_UPDATE_AKSES_ADMIN', 'update-akses-admin');
defined('PERMISSION_DELETE_ADMIN') || define('PERMISSION_DELETE_ADMIN', 'delete-admin');

// Permission Submenu Role
defined('PERMISSION_SHOW_ROLE') || define('PERMISSION_SHOW_ROLE', 'show-role');
defined('PERMISSION_ADD_ROLE') || define('PERMISSION_ADD_ROLE', 'add-role');
defined('PERMISSION_UPDATE_PERMISSION_ROLE') || define('PERMISSION_UPDATE_PERMISSION_ROLE', 'update-permission-role');
defined('PERMISSION_DELETE_ROLE') || define('PERMISSION_DELETE_ROLE', 'delete-role');

// Permission Submenu Tambah Kelompok
defined('PERMISSION_SHOW_KELOMPOK') || define('PERMISSION_SHOW_KELOMPOK', 'show-kelompok');
defined('PERMISSION_ADD_KELOMPOK') || define('PERMISSION_ADD_KELOMPOK', 'add-kelompok');
defined('PERMISSION_ADD_DELETE_ANGGOTA_KELOMPOK') || define('PERMISSION_ADD_DELETE_ANGGOTA_KELOMPOK', 'add-delete-anggota-kelompok');
defined('PERMISSION_UPDATE_KELOMPOK') || define('PERMISSION_UPDATE_KELOMPOK', 'update-kelompok');
defined('PERMISSION_DELETE_KELOMPOK') || define('PERMISSION_DELETE_KELOMPOK', 'delete-kelompok');

// Permission Submenu indikator penilaian
defined('PERMISSION_SHOW_INDIKATOR_PENILAIAN') || define('PERMISSION_SHOW_INDIKATOR_PENILAIAN', 'show-indikator-penilaian');
defined('PERMISSION_ADD_INDIKATOR_PENILAIAN') || define('PERMISSION_ADD_INDIKATOR_PENILAIAN', 'add-indikator-penilaian');
defined('PERMISSION_UPDATE_INDIKATOR_PENILAIAN') || define('PERMISSION_UPDATE_INDIKATOR_PENILAIAN', 'update-indikator-penilaian');
defined('PERMISSION_DELETE_INDIKATOR_PENILAIAN') || define('PERMISSION_DELETE_INDIKATOR_PENILAIAN', 'delete-indikator-penilaian');

// Permission Submenu Gallery
defined('PERMISSION_SHOW_GALLERY') || define('PERMISSION_SHOW_GALLERY', 'show-gallery');
defined('PERMISSION_ADD_GALLERY') || define('PERMISSION_ADD_GALLERY', 'add-gallery');
defined('PERMISSION_UPDATE_GALLERY') || define('PERMISSION_UPDATE_GALLERY', 'update-gallery');
defined('PERMISSION_DELETE_GALLERY') || define('PERMISSION_DELETE_GALLERY', 'delete-gallery');

// Permission Submenu timeline
defined('PERMISSION_SHOW_TIMELINE') || define('PERMISSION_SHOW_TIMELINE', 'show-timeline');
defined('PERMISSION_ADD_TIMELINE') || define('PERMISSION_ADD_TIMELINE', 'add-timeline');
defined('PERMISSION_UPDATE_TIMELINE') || define('PERMISSION_UPDATE_TIMELINE', 'update-timeline');
defined('PERMISSION_DELETE_TIMELINE') || define('PERMISSION_DELETE_TIMELINE', 'delete-timeline');

// Permission Submenu materi
defined('PERMISSION_SHOW_MATERI') || define('PERMISSION_SHOW_MATERI', 'show-materi');
defined('PERMISSION_ADD_MATERI') || define('PERMISSION_ADD_MATERI', 'add-materi');
defined('PERMISSION_UPDATE_MATERI') || define('PERMISSION_UPDATE_MATERI', 'update-materi');
defined('PERMISSION_DELETE_MATERI') || define('PERMISSION_DELETE_MATERI', 'delete-materi');

// Permission Submenu faq
defined('PERMISSION_SHOW_FAQ') || define('PERMISSION_SHOW_FAQ', 'show-faq');
defined('PERMISSION_ADD_FAQ') || define('PERMISSION_ADD_FAQ', 'add-faq');
defined('PERMISSION_UPDATE_FAQ') || define('PERMISSION_UPDATE_FAQ', 'update-faq');
defined('PERMISSION_DELETE_FAQ') || define('PERMISSION_DELETE_FAQ', 'delete-faq');

// Permission Submenu Berita
defined('PERMISSION_SHOW_BERITA') || define('PERMISSION_SHOW_BERITA', 'show-berita');
defined('PERMISSION_ADD_BERITA') || define('PERMISSION_ADD_BERITA', 'add-berita');
defined('PERMISSION_UPDATE_BERITA') || define('PERMISSION_UPDATE_BERITA', 'update-berita');
defined('PERMISSION_DELETE_BERITA') || define('PERMISSION_DELETE_BERITA', 'delete-berita');

// Permission Submenu Formulir
defined('PERMISSION_SHOW_FORMULIR') || define('PERMISSION_SHOW_FORMULIR', 'show-formulir');
defined('PERMISSION_ADD_FORMULIR') || define('PERMISSION_ADD_FORMULIR', 'add-formulir');
defined('PERMISSION_UPDATE_FORMULIR') || define('PERMISSION_UPDATE_FORMULIR', 'update-formulir');
defined('PERMISSION_DELETE_FORMULIR') || define('PERMISSION_DELETE_FORMULIR', 'delete-formulir');

// Permission Submenu Pengumuman
defined('PERMISSION_SHOW_PENGUMUMAN') || define('PERMISSION_SHOW_PENGUMUMAN', 'show-pengumuman');
defined('PERMISSION_ADD_PENGUMUMAN') || define('PERMISSION_ADD_PENGUMUMAN', 'add-pengumuman');
defined('PERMISSION_UPDATE_PENGUMUMAN') || define('PERMISSION_UPDATE_PENGUMUMAN', 'update-pengumuman');
defined('PERMISSION_DELETE_PENGUMUMAN') || define('PERMISSION_DELETE_PENGUMUMAN', 'delete-pengumuman');

// Permission Submenu Jenis Poin
defined('PERMISSION_SHOW_JENISPOIN') || define('PERMISSION_SHOW_JENISPOIN', 'show-jenispoin');
defined('PERMISSION_ADD_JENISPOIN') || define('PERMISSION_ADD_JENISPOIN', 'add-jenispoin');
defined('PERMISSION_UPDATE_JENISPOIN') || define('PERMISSION_UPDATE_JENISPOIN', 'update-jenispoin');
defined('PERMISSION_DELETE_JENISPOIN') || define('PERMISSION_DELETE_JENISPOIN', 'delete-jenispoin');

// Permission Submenu Penebusan
defined('PERMISSION_SHOW_PENEBUSAN') || define('PERMISSION_SHOW_PENEBUSAN', 'show-penebusan');
defined('PERMISSION_ADD_PENEBUSAN') || define('PERMISSION_ADD_PENEBUSAN', 'add-penebusan');
defined('PERMISSION_UPDATE_PENEBUSAN') || define('PERMISSION_UPDATE_PENEBUSAN', 'update-penebusan');
defined('PERMISSION_DELETE_PENEBUSAN') || define('PERMISSION_DELETE_PENEBUSAN', 'delete-penebusan');
defined('PERMISSION_DOWNLOAD_PENEBUSAN') || define('PERMISSION_DOWNLOAD_PENEBUSAN', 'download-penebusan');

// Permission Submenu Poin
defined('PERMISSION_SHOW_POIN') || define('PERMISSION_SHOW_POIN', 'show-poin');
defined('PERMISSION_OTOMATIS_POIN') || define('PERMISSION_OTOMATIS_POIN', 'otomatis-poin');
defined('PERMISSION_ADD_POIN') || define('PERMISSION_ADD_POIN', 'add-poin');
defined('PERMISSION_UPDATE_POIN') || define('PERMISSION_UPDATE_POIN', 'update-poin');
defined('PERMISSION_DELETE_POIN') || define('PERMISSION_DELETE_POIN', 'delete-poin');

// Permission Submenu Poin Kelompok
defined('PERMISSION_SHOW_POIN_KELOMPOK') || define('PERMISSION_SHOW_POIN_KELOMPOK', 'show-poin-kelompok');

// Permission Submenu Input Nilai
defined('PERMISSION_SHOW_NILAI') || define('PERMISSION_SHOW_NILAI', 'show-nilai');
defined('PERMISSION_UPDATE_NILAI') || define('PERMISSION_UPDATE_NILAI', 'update-nilai');

// Permision kendala
defined('PERMISSION_SHOW_KENDALA') || define('PERMISSION_SHOW_KENDALA', 'show-kendala');
defined('PERMISSION_UPDATE_KENDALA') || define('PERMISSION_UPDATE_KENDALA', 'update-kendala');
defined('PERMISSION_DELETE_KENDALA') || define('PERMISSION_DELETE_KENDALA', 'delete-kendala');

// Permission event
defined('PERMISSION_SHOW_EVENT') || define('PERMISSION_SHOW_EVENT', 'show-event');
defined('PERMISSION_ADD_EVENT') || define('PERMISSION_ADD_EVENT', 'add-event');
defined('PERMISSION_UPDATE_EVENT') || define('PERMISSION_UPDATE_EVENT', 'update-event');
defined('PERMISSION_DELETE_EVENT') || define('PERMISSION_DELETE_EVENT', 'delete-event');

// Permission absensi
defined('PERMISSION_ADD_ABSENSI') || define('PERMISSION_ADD_ABSENSI', 'add-absensi');
defined('PERMISSION_UPDATE_ABSENSI') || define('PERMISSION_UPDATE_ABSENSI', 'update-absensi');
defined('PERMISSION_DELETE_ABSENSI') || define('PERMISSION_DELETE_ABSENSI', 'delete-absensi');

// Permission submenu laporan kegiatan
defined('PERMISSION_SHOW_LAPORAN_KEGIATAN') || define('PERMISSION_SHOW_LAPORAN_KEGIATAN', 'show-lk');
defined('PERMISSION_ADD_LAPORAN_KEGIATAN') || define('PERMISSION_ADD_LAPORAN_KEGIATAN', 'add-lk');
defined('PERMISSION_UPDATE_LAPORAN_KEGIATAN') || define('PERMISSION_UPDATE_LAPORAN_KEGIATAN', 'update-lk');
defined('PERMISSION_DELETE_LAPORAN_KEGIATAN') || define('PERMISSION_DELETE_LAPORAN_KEGIATAN', 'delete-lk');

// List Role
defined('ROLE_SUPER_ADMIN') || define('ROLE_SUPER_ADMIN', 'Super Admin');
defined('ROLE_PANITIA') || define('ROLE_PANITIA', 'Panitia');
defined('ROLE_LAPK') || define('ROLE_LAPK', 'LAPK');
defined('ROLE_HPD') || define('ROLE_HPD', 'HPD');
defined('ROLE_TIBUM') || define('ROLE_TIBUM', 'TIBUM');
defined('ROLE_ACARA') || define('ROLE_ACARA', 'Acara');
defined('ROLE_BPH') || define('ROLE_BPH', 'BPH');
defined('ROLE_PENGAWAS') || define('ROLE_PENGAWAS', 'PENGAWAS');

// List Dimensi
defined('DIMENSI_BUDI_PEKERTI') || define('DIMENSI_BUDI_PEKERTI', 'Berbudi Pekerti dan Berdisplin Tinggi');
defined('DIMENSI_BERINTELEKTUAL') || define('DIMENSI_BERINTELEKTUAL', 'Berintelektual');
defined('DIMENSI_DEDIKASI') || define('DIMENSI_DEDIKASI', 'Berdedikasi dan Siap Mengabdi Institusi');
defined('DIMENSI_NASIONALISME') || define('DIMENSI_NASIONALISME', 'Nasionalisme');

// Poin
defined('POIN_MINIMUM') || define('POIN_MINIMUM', 60);
defined('POIN_MAKSIMAL') || define('POIN_MAKSIMAL', 100);
defined('POIN_AWAL_MABA') || define('POIN_AWAL_MABA', 65);
defined('POIN_AWAL_PANITIA') || define('POIN_AWAL_PANITIA', 0);

// Kondisi 1 status: Menunggu Upload
// Maba sudah pilih tugas, dan belum upload
defined('PENEBUSAN_MENUNGGU_UPLOAD') || define('PENEBUSAN_MENUNGGU_UPLOAD', "Menunggu Upload");
defined('PENEBUSAN_SEDANG_DIKOREKSI') || define('PENEBUSAN_SEDANG_DIKOREKSI', "Sedang Dikoreksi");
defined('PENEBUSAN_BUTUH_REVISI') || define('PENEBUSAN_BUTUH_REVISI', "Butuh Revisi");
defined('PENEBUSAN_SELESAI') || define('PENEBUSAN_SELESAI', "Selesai");
defined('PENEBUSAN_TERLAMBAT') || define('PENEBUSAN_TERLAMBAT', "Terlambat");
defined('PENEBUSAN_DEFAULT_DEADLINE') || define('PENEBUSAN_DEFAULT_DEADLINE', "2024-09-13 06:00:00");

defined('TIPE_PENEBUSAN_RINGAN') || define('TIPE_PENEBUSAN_RINGAN', 1);
defined('TIPE_PENEBUSAN_SEDANG') || define('TIPE_PENEBUSAN_SEDANG', 2);
defined('TIPE_PENEBUSAN_BERAT') || define('TIPE_PENEBUSAN_BERAT', 3);

// List Category
defined('CATEGORY_GALLERY_FOTO') || define('CATEGORY_GALLERY_FOTO', 1);
defined('CATEGORY_GALLERY_VIDEO') || define('CATEGORY_GALLERY_VIDEO', 2);

defined('CATEGORY_EVENT_PRESENSI') || define('CATEGORY_EVENT_PRESENSI', 1);
defined('CATEGORY_EVENT_TIMELINE') || define('CATEGORY_EVENT_TIMELINE', 2);

defined('CATEGORY_PUBLISHABLE_PENGUMUMAN') || define('CATEGORY_PUBLISHABLE_PENGUMUMAN', 1);
defined('CATEGORY_PUBLISHABLE_MATERI') || define('CATEGORY_PUBLISHABLE_MATERI', 2);
defined('CATEGORY_PUBLISHABLE_SERTIFIKAT') || define('CATEGORY_PUBLISHABLE_SERTIFIKAT', 3);
defined('CATEGORY_PUBLISHABLE_LAPORAN_KEGIATAN') || define('CATEGORY_PUBLISHABLE_LAPORAN_KEGIATAN', 4);

defined('CATEGORY_JENISPOIN_PENGHARGAAN') || define('CATEGORY_JENISPOIN_PENGHARGAAN', 1);
defined('CATEGORY_JENISPOIN_PELANGGARAN') || define('CATEGORY_JENISPOIN_PELANGGARAN', 2);
defined('CATEGORY_JENISPOIN_PENEBUSAN') || define('CATEGORY_JENISPOIN_PENEBUSAN', 3);

defined('CATEGORY_BERITA_PRA_PKKMB') || define('CATEGORY_BERITA_PRA_PKKMB', 1);
defined('CATEGORY_BERITA_MASA_PKKMB') || define('CATEGORY_BERITA_MASA_PKKMB', 2);
defined('CATEGORY_BERITA_PASCA_PKKMB') || define('CATEGORY_BERITA_PASCA_PKKMB', 3);
defined('CATEGORY_BERITA_MASA_PKBN') || define('CATEGORY_BERITA_MASA_PKBN', 4);

// BEGIN POIN HARDCODED

// Keterlambatan Panitia
defined('JENISPOIN_PANITIA_LAMBAT_0_10') ||
    define('JENISPOIN_PANITIA_LAMBAT_0_10', 1);
defined('JENISPOIN_PANITIA_LAMBAT_10_15') ||
    define('JENISPOIN_PANITIA_LAMBAT_10_15', 2);
defined('JENISPOIN_PANITIA_LAMBAT_16_30') ||
    define('JENISPOIN_PANITIA_LAMBAT_16_30', 3);
defined('JENISPOIN_PANITIA_LAMBAT_31') ||
    define('JENISPOIN_PANITIA_LAMBAT_31', 4);

// Hadir Tepat Waktu
defined('JENISPOIN_TEPAT_WAKTU') ||
    define('JENISPOIN_TEPAT_WAKTU', 5);

// Keterlambatan Peserta
defined('JENISPOIN_MABA_LAMBAT_0_15') ||
    define('JENISPOIN_MABA_LAMBAT_0_15', 6);
defined('JENISPOIN_MABA_LAMBAT_16_30') ||
    define('JENISPOIN_MABA_LAMBAT_16_30', 7);
defined('JENISPOIN_MABA_LAMBAT_31') ||
    define('JENISPOIN_MABA_LAMBAT_31', 8);

// Atribut Peserta
defined('JENISPOIN_ATRIBUT_LENGKAP') ||
    define('JENISPOIN_ATRIBUT_LENGKAP', 9);
defined('JENISPOIN_ATRIBUT_TIDAK_LENGKAP') ||
    define('JENISPOIN_ATRIBUT_TIDAK_LENGKAP', 10);
defined('JENISPOIN_PAKAIAN_KUCEL') ||
    define('JENISPOIN_PAKAIAN_KUCEL', 11);
defined('JENISPOIN_NODA_TAMPAK') ||
    define('JENISPOIN_NODA_TAMPAK', 12);
defined('JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN') ||
    define('JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN', 13);

// Kuliah Umum Peserta
defined('JENISPOIN_TERTIB_KU') ||
    define('JENISPOIN_TERTIB_KU', 14);
defined('JENISPOIN_KU_TIDUR') ||
    define('JENISPOIN_KU_TIDUR', 15);
defined('JENISPOIN_KU_NGOBROL') ||
    define('JENISPOIN_KU_NGOBROL', 16);
defined('JENISPOIN_KU_DUDUK_TIDAK_SESUAI') ||
    define('JENISPOIN_KU_DUDUK_TIDAK_SESUAI', 17);
defined('JENISPOIN_KU_MAKAN') ||
    define('JENISPOIN_KU_MAKAN', 18);
defined('JENISPOIN_KU_MAIN_HP') ||
    define('JENISPOIN_KU_MAIN_HP', 19);
defined('JENISPOIN_TIDAK_TERTIB_KU') ||
    define('JENISPOIN_TIDAK_TERTIB_KU', 20);
defined('JENISPOIN_KU_TRANSISI_TIDAK_TERTIB') ||
    define('JENISPOIN_KU_TRANSISI_TIDAK_TERTIB', 21);

// Kedisiplinan Peserta
defined('JENISPOIN_TIDAK_MELAKUKAN_KESALAHAN') ||
    define('JENISPOIN_TIDAK_MELAKUKAN_KESALAHAN', 22);

// Penugasan Peserta
defined('JENISPOIN_PATUH_TUGAS') ||
    define('JENISPOIN_PATUH_TUGAS', 23);
defined('JENISPOIN_TUGAS_TIDAK_LENGKAP') ||
    define('JENISPOIN_TUGAS_TIDAK_LENGKAP', 24);
defined('JENISPOIN_TUGAS_TERLAMBAT') ||
    define('JENISPOIN_TUGAS_TERLAMBAT', 25);

// Perlengkapan PKBN Peserta
defined('JENISPOIN_ATRIBUT_PKBN_LENGKAP') ||
    define('JENISPOIN_ATRIBUT_PKBN_LENGKAP', 26);
defined('JENISPOIN_TIDAK_BAWA_BARANG_INSTRUKSI') ||
    define('JENISPOIN_TIDAK_BAWA_BARANG_INSTRUKSI', 27);
defined('JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_CINCIN') ||
    define('JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_CINCIN', 28);
defined('JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_GELANG') ||
    define('JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_GELANG', 29);
defined('JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_KALUNG') ||
    define('JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_KALUNG', 30);

// Penghargaan Untuk Peserta Terpilih
defined('JENISPOIN_MENGIKUTI_SELEKSI_PETUGAS_APEL') ||
    define('JENISPOIN_MENGIKUTI_SELEKSI_PETUGAS_APEL', 31);
defined('JENISPOIN_MENJADI_PETUGAS_APEL') ||
    define('JENISPOIN_MENJADI_PETUGAS_APEL', 32);
defined('JENISPOIN_MENGIKUTI_SELEKSI_KETUA_ANGKATAN') ||
    define('JENISPOIN_MENGIKUTI_SELEKSI_KETUA_ANGKATAN', 33);
defined('JENISPOIN_MENJADI_KETUA_ANGKATAN') ||
    define('JENISPOIN_MENJADI_KETUA_ANGKATAN', 34);
defined('JENISPOIN_MENJADI_KETUA_KELOMPOK') ||
    define('JENISPOIN_MENJADI_KETUA_KELOMPOK', 35);
defined('JENISPOIN_BERTANYA_MENJAWAB_PERTANYAAN') ||
    define('JENISPOIN_BERTANYA_MENJAWAB_PERTANYAAN', 36);

// END POIN HARDCODED

// Poin dari poin penebusan
defined('POIN_PENEBUSAN_RINGAN') || define('POIN_PENEBUSAN_RINGAN', 10);
defined('POIN_PENEBUSAN_SEDANG') || define('POIN_PENEBUSAN_SEDANG', 15);
defined('POIN_PENEBUSAN_BERAT') || define('POIN_PENEBUSAN_BERAT', 20);

// Category Mapping
defined('MAP_CATEGORY') || define(
    'MAP_CATEGORY',
    [
        'publishable' => [
            '1' => 'Pengumuman',
            '2' => 'Materi',
            '3' => 'Sertifikat'
        ],
        'jenis_poin' => [
            '1' => 'Penghargaan',
            '2' => 'Pelanggaran',
            '3' => 'Penebusan',
        ],
        'tipe_poin' => [
            '1' => 'Ringan',
            '2' => 'Sedang',
            '3' => 'Berat'
        ],
        'penebusan_user' => ['Menunggu Upload', 'Sedang Dikoreksi', 'Butuh Revisi', 'Selesai', 'Terlambat']
    ]
);
