<x-home-layout menu="Sertifikat" title="Sertifikat">

    <div class="font-poppins lg:px-40 md:px-30 sm:px-16 px-3 lg:pt-32 md:pt-28 pt-24 mb-20">

        <div class="grid justify-items-center">
            <div class="text-base-blue-400 mb-5 text-center">
                <h1 class="font-extrabold xl:text-4xl lg:text-3xl md:text-2xl sm:text-xl text-xl leading-normal">
                    Menyiapkan Sertifikat ...
                </h1>
                <p class="text-base mt-4 italic">Harap tunggu sebentar ...</p>
            </div>
            <div class="xl:w-45 lg:w-32 md:w-24 sm:w-20 w-16 h-2 bg-base-yellow-400"></div>
        </div>
    </div>

    @push('script-bottom')
    <script>
        const getSertif = () => {
            const doc = new jspdf('l', 'pt','a4', true);
            const width = doc.internal.pageSize.getWidth();
            const height = doc.internal.pageSize.getHeight();

            doc.addImage(`<?= $imgDepan ?>`, "PNG", 0, 0, width, height, '','FAST');
            doc.addPage("a4");
            doc.addImage(`<?= $imgBelakang ?>`, "PNG", 0, 0, width, height, '','FAST');
            doc.save(`<?= $nimb; ?>` + "_Sertifikat Kelulusan PKBN.pdf");

            setTimeout(() => {
                window.close();
            }, 1000);
        }

        document.addEventListener("DOMContentLoaded", function(event) {
            setTimeout(getSertif, 500);
        });
    </script>
    @endpush
</x-home-layout>
