<div x-data="{openQrCodeReader : @entangle('openQrCodeReader')}" id="QrModal">
    <div x-cloak x-show="openQrCodeReader">
        <x-modal>
            <div class="p-5 pt-3 bg-white">
                <div class="mb-4 flex justify-between">
                    <h5 class="font-poppins font-semibold">Presensi {{ $event->title ?? '' }}</h5>
                    <i class="fa fa-times cursor-pointer" onclick="closeQR()"
                        x-on:click="html5QrcodeScanner.clear()"></i>
                </div>
                <div id="qr-reader" x-effect="initScanner"></div>
                <div id="loading" class="text-gray-600 text-xs text-center italic hidden">
                    Sedang memproses ...</div>
            </div>
        </x-modal>
    </div>

    @push('script-bottom')
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
    <script>
        const onScanSuccess = (decodedText, decodedResult) => {
            html5QrcodeScanner.clear();
            document.getElementById('loading').classList.remove('hidden');
            Livewire.emit('absensiWithQrCode', decodedText);
        }

        let html5QrcodeScanner;
        const initScanner = () => {
            html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess);
        }

        function closeQR(){
            let element = document.querySelector("#QrModal").classList.add('hidden');
        }
    </script>
    @endpush
</div>
