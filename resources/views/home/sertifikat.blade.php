<x-home-layout menu="Sertifikat" title="Sertifikat">
    <div class="font-poppins lg:px-40 md:px-30 sm:px-16 px-3 lg:pt-32 md:pt-28 pt-24 mb-20">
        <div class="grid justify-items-center">
            <div class="text-merah-2 mb-5 text-center">
                <h1
                    class="font-extrabold xl:text-4xl lg:text-3xl md:text-2xl sm:text-xl text-xl leading-normal font-bohemianSoul">
                    Menyiapkan {{ $filename }} ...
                </h1>
                <p class="text-base mt-4 italic">Harap tunggu sebentar ...</p>
            </div>
            <div class="xl:w-45 lg:w-32 md:w-24 sm:w-20 w-16 h-2 bg-base-yellow-400"></div>
        </div>
    </div>

    <!-- Modal for PDF preview -->
    <div id="pdf-preview-modal"
        class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 z-50 flex items-center justify-center">
        <div class="bg-white bg-putih-pattern p-5 rounded-xl shadow-xl w-full max-w-4xl h-full max-h-[80vh]">
            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-semibold font-bohemianSoul">Preview {{ $filename }}</h2>
                <button id="download-btn"
                    class="text-white px-4 py-2 rounded-3xl bg-2025-1 hover:bg-coklat-hover">Download</button>
            </div>
            <iframe id="pdf-preview-iframe" class="w-full h-full mb-4" style="height: 70vh;"></iframe>
        </div>
    </div>

    @push('script-bottom')
        <script>
            const getSertif = () => {
                const doc = new jspdf('l', 'pt', 'a4', true);
                const width = doc.internal.pageSize.getWidth();
                const height = doc.internal.pageSize.getHeight();

                doc.addImage(`<?= $imgDepan ?>`, "PNG", 0, 0, width, height, '', 'FAST');
                doc.addPage("a4");
                doc.addImage(`<?= $imgBelakang ?>`, "PNG", 0, 0, width, height, '', 'FAST');

                // Generate PDF as Blob
                const pdfBlob = doc.output('blob');

                // Create a URL for the blob and set it to the iframe
                const pdfUrl = URL.createObjectURL(pdfBlob);
                document.getElementById('pdf-preview-iframe').src = pdfUrl;

                // Show the preview modal
                document.getElementById('pdf-preview-modal').classList.remove('hidden');

                // Set download button functionality
                document.getElementById('download-btn').onclick = () => {
                    doc.save(`<?= $nimb ?>` + "_" + `<?= $filename ?>` + ".pdf");
                    setTimeout(() => {
                        window.close();
                    }, 1000);
                }
            }

            document.addEventListener("DOMContentLoaded", function(event) {
                setTimeout(getSertif, 500);
            });
        </script>
    @endpush
</x-home-layout>
