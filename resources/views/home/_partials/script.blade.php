@livewireScripts
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js"
    integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const toastTag = document.getElementById('toast');

    Livewire.on('toastShow', (type, pesan, isPersistent = false) => {
        console.log(type, pesan, isPersistent); // Tambahkan ini untuk debugging
        let color;

        if (type === "success") color = "bg-green-500";
        else if (type === "error") color = "bg-red-500";

        const div = document.createElement('div');
        div.className =
            `${color} px-5 shadow-lg py-3 mb-3 rounded-md text-white max-w-xs text-sm transition-all mt-8 duration-500 ease-linear opacity-0`;

        const text = document.createTextNode(pesan);
        div.appendChild(text);

        if (isPersistent) {
            // Tambahkan tombol close jika notifikasi persisten
            const closeBtn = document.createElement('button');
            closeBtn.className = 'ml-4 text-white font-bold';
            closeBtn.innerHTML = '&times;';
            closeBtn.onclick = function() {
                div.remove(); // Hapus notifikasi saat tombol diklik
            };

            div.appendChild(closeBtn);
            toastTag.appendChild(div);

            // Tampilkan toast dengan efek transisi
            setTimeout(() => {
                div.classList.remove('mt-8');
                div.classList.remove('opacity-0');
            }, 1);
        } else {
            // Notifikasi tidak persisten (otomatis hilang)
            toastTag.appendChild(div);

            setTimeout(() => {
                div.classList.remove('mt-8');
                div.classList.remove('opacity-0');
            }, 1);

            setTimeout(() => {
                div.classList.add('opacity-0');
            }, 3000);

            setTimeout(() => {
                div.remove();
            }, 3500);
        }
    });

    document.addEventListener('livewire:load', function() {
        window.Echo.private('pengaduan')
            .listen('PengaduanUpdated', (event) => {
                if (event.actionType === 'add') {
                    Livewire.emit('toastShow', 'success',
                        `Terdapat ${event.pengaduanCount} pengaduan baru.`, true);
                }
            });
    });
</script>

{{ $js }}
