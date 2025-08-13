<x-home-layout menu="CoCard" title="CoCard">

    <div class="font-poppins lg:px-40 md:px-30 sm:px-16 px-3 lg:pt-32 md:pt-28 pt-24 mb-20">

        <div class="grid justify-items-center">
            <div class="text-base-blue-400 mb-5 text-center">
                <h1 class="font-extrabold xl:text-4xl lg:text-3xl md:text-2xl sm:text-xl text-xl leading-normal">
                    Menyiapkan Co Card ...
                </h1>
                <p class="text-base mt-4 italic">Harap tunggu sebentar ...</p>
                <div id="qrcode" class="hidden"></div>
            </div>
            <div class="xl:w-45 lg:w-32 md:w-24 sm:w-20 w-16 h-2 bg-base-yellow-400"></div>
        </div>
    </div>

    @push('script-bottom')
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/qrcode.min.js') }}"></script>
    <script type="text/javascript">
        const getQRCode = () =>{
            new QRCode(document.getElementById("qrcode"), {
                text: "{{ $username }}",
            });
        };
        getQRCode();
    </script>
    <script>
        let url;
        var generateUrlQrCode = async() => {
            let qrcode = document.getElementById("qrcode").firstElementChild;
            let blob = await new Promise(resolve=>qrcode.toBlob(resolve));
            url = URL.createObjectURL(blob);
        };

        generateUrlQrCode();

        const getCoCard = () => {
            const doc = new jspdf('l', 'cm', 'a4', true);
            const width = 18;
            const height = 13;

            doc.addImage(`<?= $imgDepan ?>`, "PNG", 0, 0, width, height, '','FAST');
            doc.addImage(`<?= $desainDepan ?>`, "PNG", 0, 0, width, height, '','FAST');
            doc.addImage(`${url}`, "PNG", 6.525, 4.257, 5, 5, '','FAST');
            doc.addPage('l', 'cm', 'a4', true);
            doc.addImage(`<?= $imgBelakang ?>`, "PNG", 0, 0, width, height, '','FAST');
            doc.addImage(`<?= $desainBelakang ?>`, "PNG", 0, 0, width, height, '','FAST');
            doc.save(`<?= $nimb; ?>` + "_CoCard.pdf");

            setTimeout(() => {
                window.close();
            }, 1000);
        }

        document.addEventListener("DOMContentLoaded", function(event) {
            setTimeout(getCoCard, 500);
        });
    </script>
    @endpush
</x-home-layout>
