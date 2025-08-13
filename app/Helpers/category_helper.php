<?php

if (!function_exists('getKategoriBerita')) {
    /**
     * getKategoriBerita
     *
     * @param  mixed $kategori
     * @return string
     */
    function getKategoriBerita($kategori)
    {
        if ($kategori == CATEGORY_BERITA_PRA_PKKMB)
            return "Pra PKKMB";
        if ($kategori == CATEGORY_BERITA_MASA_PKKMB)
            return "Masa PKKMB";
        if ($kategori == CATEGORY_BERITA_MASA_PKBN)
            return "Masa PKBN";
        if ($kategori == CATEGORY_BERITA_PASCA_PKKMB)
            return "Pasca PKKMB";
    }
}

if (!function_exists('getCategoryGallery')) {
    /**
     * translate kode category gallery ke string
     *
     * @param  integer $status
     * @return string
     */
    function getCategoryGallery($status)
    {
        if ($status == CATEGORY_GALLERY_FOTO)
            return 'Foto';
        if ($status == CATEGORY_GALLERY_VIDEO)
            return 'Video';
    }
}

if (!function_exists('getCategoryPoin')) {
    /**
     * getCategoryPoin
     *
     * @param  mixed $status
     * @return string
     */
    function getCategoryPoin($status)
    {
        if ($status == CATEGORY_JENISPOIN_PENGHARGAAN)
            return "Penghargaan";
        else if ($status == CATEGORY_JENISPOIN_PELANGGARAN)
            return "Pelanggaran";
        else if ($status == CATEGORY_JENISPOIN_PENEBUSAN)
            return "Penebusan";
    }
}

if (!function_exists('getJenisKendala')) {
    /**
     * getJenisKendala
     *
     * @param  mixed $jenis
     * @return string
     */
    function getJenisKendala($jenis)
    {
        if ($jenis == 1)
            return "Kinerja PPO";
        if ($jenis == 2)
            return "Praduga unsur kekerasan, perpeloncoan, dsb";
        if ($jenis == 3)
            return "Evaluasi Website";
    }
}

if (!function_exists('getStatusKendala')) {
    /**
     * translate kode status kendala ke string
     *
     * @param  integer $status
     * @return string
     */
    function getStatusKendala($status)
    {
        if ($status == 0)
            return 'Diajukan';
        if ($status == 1)
            return 'Diterima';
        if ($status == 2)
            return 'Ditolak';
    }
}

if (!function_exists('getStatusKendalaColor')) {
    /**
     * getStatusKendalaColor
     *
     * @param  mixed $status
     * @return string
     */
    function getStatusKendalaColor($status)
    {
        if ($status == 0)
            return "bg-yellow-500";
        else if ($status == 1)
            return "bg-green-500";
        else if ($status == 2)
            return "bg-red-500";
    }
}

if (!function_exists('getStatusAbsensi')) {
    /**
     * translate kode status absensi ke string
     *
     * @param  integer $status
     * @return string
     */
    function getStatusAbsensi($status)
    {
        if ($status == 0)
            return 'Tepat Waktu';
        if ($status == 1)
            return 'Terlambat';
        if ($status == 2)
            return 'Izin';
        if ($status == 3)
            return 'Sakit';
        if ($status == 4)
            return 'Tanpa Keterangan';
    }
}

if (!function_exists('getStatusAbsensiColor')) {
    /**
     * getStatusAbsensiColor
     *
     * @param  mixed $status
     * @return string
     */
    function getStatusAbsensiColor($status)
    {
        if ($status == 0)
            return "bg-green-500";
        else if ($status == 1)
            return "bg-yellow-500";
        else if ($status == 2)
            return "bg-blue-500";
        else if ($status == 3)
            return "bg-sky-500";
        else if ($status == 4)
            return "bg-red-500";
    }
}

if (!function_exists('getTipePenebusan')) {
    /**
     * translate kode category gallery ke string
     *
     * @param  integer $status
     * @return string
     */
    function getTipePenebusan($tipe)
    {
        if ($tipe == TIPE_PENEBUSAN_RINGAN)
            return 'Ringan';
        if ($tipe == TIPE_PENEBUSAN_SEDANG)
            return 'Sedang';
        if ($tipe == TIPE_PENEBUSAN_BERAT)
            return 'Berat';
    }
}
