<div>
  <!-- Header -->
  <div
    class="grid lg:grid-cols-1 grid-cols-1 md:gap-6 h-auto align-items-start lg:align-items-stretch lg:items-center lg:py-0">
    <div class="lg:pl-16 lg:pr-16 md:px-8 sm:px-2 col-span-1 relative lg:pt-20 md:pt-20 pt-12 lg:block"
      data-aos="zoom-in-up">
      <div
        class="flex flex-row justify-between items-center rounded-3xl lg:w-full m-auto shadow-xl static bg-kuning-pattern overflow-hidden bg-opacity-95"
        style="height:7.625rem">
        <div class="flex flex-row lg:pl-7 md:px-4 px-2 justify-center items-center">
          <img src="img/asset/2024/kantung-semar.png"
            class="h-[7rem] lg:h-[12rem] w-auto lg:absolute lg:left-0 m-auto lg:p-[inherit]">
        </div>
        <div class="lg:text-center text-center lg:ml-0 lg:mr-0">
          <h1 class="z-20 font-bohemianSoul lg:text-4xl md:text-3xl text-2xl leading-none md:mb-1 text-base-white"
            id="title-visimisi">
            Visi dan Misi PKKMB-PKBN 2024
          </h1>
        </div>
        <div class="flex flex-row lg:pr-7 md:px-4 px-2 justify-center items-center">
          <img src="img/asset/2024/kantung-semar.png"
            class="h-[7rem] lg:h-[12rem] w-auto lg:absolute lg:right-0 m-auto lg:p-[inherit] scale-x-[-1]">
        </div>
      </div>
    </div>

    <div class="py-10 lg:pb-20">
      <div class="flex sm:flex-row flex-col mx-auto w-full justify-center items-stretch mb-8 sm:px-12 px-4" data-aos="fade right">
        <div class="w-full sm:w-1/3 flex flex-col justify-center items-center">
          <img src="{{ maskot1 }}" alt="Kambe" class="w-52">
          <span class="font-aringgo text-lg text-merah-1 mt-2">Kambe</span>
        </div>
        <div class="flex-1 p-4">
          <div class="bg-merah2-pattern content-center text-white px-8 py-12 rounded-lg h-full text-center"
            style="box-shadow: 10px 12px 3px rgba(0, 0, 0, 0.5)">
            <h2 class="sm:text-2xl text-lg font-semibold mb-4 font-bohemianSoul tracking-widest">VISI:</h2>
            <p class="sm:text-2xl text-lg leading-relaxed font-nunito">
              “Membangun Mahasiswa yang Tangguh Serta Siap Menempuh Pendidikan Untuk Menjadi Calon ASN Ahli di Bidang Statistik dan Komputasi Statistik yang BerAKHLAK”
            </p>
          </div>
        </div>
      </div>


    <div class="flex sm:flex-row flex-col-reverse mx-auto w-full justify-center items-stretch sm:px-12 px-4" data-aos="fade left">
      <div class="flex-1 p-4">
        <div class="bg-merah2-pattern text-white px-8 py-12 rounded-lg h-full"
          style="box-shadow: -10px 12px 3px rgba(0, 0, 0, 0.5)">
          <h2 class="sm:text-2xl text-lg font-semibold mb-4 font-bohemianSoul tracking-widest">MISI:</h2>
          <ol class="sm:text-2xl text-lg leading-relaxed font-nunito list-decimal pl-6">
            <li>Menumbuhkan ketaqwaan kepada Tuhan Yang Maha Esa.</li>
            <li>Merancang kegiatan untuk memaksimalkan komunikasi dan eksplorasi mahasiswa baru sehingga dapat
              beradaptasi dalam ekosistem kampus.</li>
            <li>Merancang kegiatan yang mengedepankan keaktifan dan kontribusi mahasiswa baru dalam memahami visi misi
              Politeknik Statistika STIS maupun BPS, serta menerapkan core value ASN, BerAKHLAK.</li>
            <li>Membentuk mahasiswa yang mempunyai budi pekerti baik, inisiatif, jiwa inspiratif, dan sikap
              nasionalisme.</li>
          </ol>
        </div>
      </div>
      <div class="w-full sm:w-1/3 flex flex-col justify-center items-center">
        <img src="{{ maskot2 }}" alt="Pika" class="w-52">
        <span class="font-aringgo text-lg text-merah-1 mt-2">Pika</span>
      </div>
    </div>

    </div>
  </div>
</div>

@push('script-bottom')
  <script>
    $(window).resize(function() {
      var width = $(document).width();
      if (width <= 900) {
        $('#title-visimisi').html('Visi dan Misi<br>PKKMB-PKBN 2024');
      } else {
        $('#title-visimisi').html('Visi dan Misi PKKMB-PKBN 2024');
      }
    });
  </script>
@endpush
