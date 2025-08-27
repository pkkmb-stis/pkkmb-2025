<div role="alert" class="mt-5 bg-red-100 border-t-4 border-red-500 rounded-b px-4 py-3 shadow-md">
    <div class="flex items-center">
        <i class="fa-solid fa-exclamation-circle mr-3 text-red-600 fa-2x"></i>
        <div>
            <p class="text-red-500 font-bold">Poinnya masih kurang
                {{POIN_MINIMUM - $detailPoins['akumulasi']}} poin!</p>
            <p class="text-xs font-semibold text-gray-800">Perlu dikoordinasakan agar yang bersangkutan menambah dan menyelesaikan tugas penebusan
                senilai
                {{POIN_MINIMUM - $detailPoins['akumulasi']}} poin atau lebih. Poin akumulasi dibawah {{POIN_MINIMUM}}
                akan membuatnya mengulang PKKMB tahun depan. Ia hanya dapat memilih tugas ringan, sedang,
                atau berat masing - masing 1 kali</p>
        </div>
    </div>
</div>
