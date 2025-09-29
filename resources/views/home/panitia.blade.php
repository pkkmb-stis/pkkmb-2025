<x-home-layout menu="Panitia" title="Profil Panitia - PKKMB PKBN 2025">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .wave-footer {
            transition: transform 0.8s ease-in-out;
            transform: translateY(100%);
        }

        .wave-footer.is-visible {
            transform: translateY(0);
        }
        
        /* =========================
           BACKGROUND SECTION
        ========================= */
        .bg-ppo-pattern {
            background-image: url('{{ asset("img/asset/2025/Backdrop PPO.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .dosen-backdrop {
            min-height: 125vh;
            position: relative;
        }

        /* MOTIF */
        .motif-top-right, .motif-bottom-left {
            position: absolute;
            width: 130px;
            opacity: 0.85;
            z-index: 5;
        }
        .motif-top-right { top: 20px; right: 25px; transform: rotate(12deg); }
        .motif-bottom-left { bottom: 20px; left: 25px; transform: rotate(-12deg); }

        .dosen-motif-top-right, .dosen-motif-bottom-left {
            position: absolute;
            width: 100px;
            opacity: 0.6;
            z-index: 2;
        }
        .dosen-motif-top-right { top: 25px; right: 25px; transform: rotate(15deg); }
        .dosen-motif-bottom-left { bottom: 25px; left: 25px; transform: rotate(-15deg); }

        /* =========================
           TITLE CONTAINER
        ========================= */
        .ppo-title-container,
        .dosen-title-container {
            position: relative;
            z-index: 15;
            text-align: center;
        }
        .ppo-title-container { padding-top: 100px; }
        .dosen-title-container { padding-top: 80px; margin-bottom: 40px; }

        /* =========================
           STACKED PREVIEW CARDS - DIUBAH
        ========================= */
        .preview-cards-stack,
        .dosen-preview-stack {
            position: relative;
            width: 550px; /* diperbesar agar proporsional */
            height: 260px; /* lebih tinggi agar card besar muat */
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1000px;
        }
        .stacked-card,
        .dosen-preview-card {
            position: absolute;
            transition: all 0.6s ease;
            cursor: pointer;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 200px; /* sebelumnya 130px */
            height: 230px; /* sebelumnya 150px */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            font-size: 1.3rem; /* sebelumnya 0.9rem */
            font-weight: bold;
            filter: drop-shadow(0 8px 18px rgba(0,0,0,0.45));
            border-radius: 18px;
        }
        .stacked-card.active, .dosen-preview-card.active {
            transform: translateX(0) scale(1.2) rotate(0deg);
            z-index: 30;
        }
        .stacked-card.left-card, .dosen-preview-card.left-preview {
            transform: translateX(-120px) scale(0.85) rotate(-15deg);
            opacity: 0.8; z-index: 20;
        }
        .stacked-card.right-card, .dosen-preview-card.right-preview {
            transform: translateX(120px) scale(0.85) rotate(15deg);
            opacity: 0.8; z-index: 20;
        }
        /* PPO Preview Images - SESUAI ASSET YANG ADA */
        .ppo-preview-bph { background-image: url('{{ asset("img/asset/2025/kartubph_ppo.png") }}'); }
        .ppo-preview-umum { background-image: url('{{ asset("img/asset/2025/kartuumum_ppo.png") }}'); }
        .ppo-preview-gramti { background-image: url('{{ asset("img/asset/2025/kartugramti_ppo.png") }}'); }
        .ppo-preview-tibum { background-image: url('{{ asset("img/asset/2025/kartutibum_ppo.png") }}'); }
        .ppo-preview-ppm { background-image: url('{{ asset("img/asset/2025/kartuppm_ppo.png") }}'); }
        .ppo-preview-acara { background-image: url('{{ asset("img/asset/2025/kartuumum_ppo.png") }}'); }
        .ppo-preview-lapk { background-image: url('{{ asset("img/asset/2025/kartulapk_ppo.png") }}'); }

        .dosen-preview-card.active {
            background-image: url('{{ asset("img/asset/2025/Preview_Highlight_dosen.png") }}');
        }

        .dosen-preview-card:not(.active) {
            background-image: url('{{ asset("img/asset/2025/Preview_Highlight_dosen.png") }}');
            opacity: 0.7;
        }

        /* =========================
           DESCRIPTION BOX
        ========================= */
        .description-container {
            max-width: 400px;
            text-align: center;
            margin-left: 40px;
        }

        .description-title {
            font-family: 'Bohemian Soul', cursive;
            font-size: 2.2rem;
            color: #2D3748;
            margin-bottom: 1rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(255,255,255,0.8);
        }

        .description-text {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #2D3748;
            background: rgba(255,255,255,0.25);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.4);
        }

        /* =========================
           MEMBER CARD (PPO)
        ========================= */
        .ppo-member-card,
        .dosen-member-card {
            width: 180px;
            height: 240px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            position: relative;
            padding-bottom: 30px;
            margin: 0 14px;
            cursor: pointer;
            transition: all 0.35s ease;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover; /* cover biar penuh card */
            border-radius: 16px; /* agar lebih lembut */
            overflow: hidden; /* rapikan isi */
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .ppo-member-card.highlight {
            background-image: url('{{ asset("img/asset/2025/Card PPO Highlight New.png") }}');
            transform: scale(1.05);
            z-index: 10;
        }

        .ppo-member-card.unhighlight {
            background-image: url('{{ asset("img/asset/2025/Card PPO Unhighlight.png") }}');
            opacity: 0.9;
        }

        .dosen-member-card {
            background-image: url('{{ asset("img/asset/2025/Card PPO Highlight New.png") }}');
        }

        /* =========================
           FOTO DALAM CARD
        ========================= */
        .ppo-member-card img,
        .dosen-member-card img {
            position: absolute;
            top: 35px; /* turunkan posisi foto */
            left: 50%;
            transform: translateX(-50%);
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 3px solid #fff;
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0,0,0,0.25);
            background: #fff; /* agar pinggiran foto halus */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        /* Efek interaktif saat hover */
        .ppo-member-card:hover img,
        .dosen-member-card:hover img {
            transform: translateX(-50%) scale(1.05);
            box-shadow: 0 6px 14px rgba(0,0,0,0.35);
        }
        /* =========================
        NAMA & JABATAN
        ========================= */
        .member-name {
            font-family: 'Bohemian Soul', cursive;
            font-size: 0.9rem;
            color: #2D3748;
            text-align: center;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.85);
            margin-top: 125px; /* posisi turun pas di bawah foto */
            line-height: 1.4;
            padding: 0 8px; /* biar nama panjang tetap rapi */
        }

        /* Jabatan */
        .member-position {
            font-size: 0.85rem;
            color: #2D3748;
            text-align: center;
            background: rgba(255,255,255,0.9);
            padding: 5px 14px;
            border-radius: 15px;
            font-weight: 600;
            border: 1px solid rgba(255,255,255,0.6);
            margin-top: 8px; /* jarak dari nama */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .preview-card-name {
            font-family: 'Bohemian Soul', cursive;
            font-size: 0.9rem;
            color: white;
            text-align: center;
            line-height: 1.2;
            font-weight: bold;
        }

        /* =========================
           CAROUSEL BUTTONS - DIUBAH
        ========================= */
        .carousel-chevron,
        .dosen-carousel-chevron {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 12px;
            transition: transform 0.3s ease;
            z-index: 25;
        }

        .carousel-chevron:hover,
        .dosen-carousel-chevron:hover {
            transform: scale(1.1);
        }

        .carousel-chevron img,
        .dosen-carousel-chevron img {
            width: 40px;
            height: 40px;
        }

        /* =========================
           LAYOUT CONTAINERS - DIUBAH
        ========================= */
        .carousel-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 3rem auto;
            padding: 0 40px;
            position: relative;
            min-height: 300px;
        }

        .dosen-preview-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 3rem auto;
            position: relative;
            min-height: 250px;
        }

        .members-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        /* Dosen Section Layout */
        .dosen-content { 
            position: relative; 
            z-index: 15; 
            padding-top: 100px; 
        }

        .dosen-title {
            font-family: 'Bohemian Soul', cursive;
            font-size: 2.5rem;
            color: white;
            text-align: center;
            font-weight: bold;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.4);
        }

        /* Maleo Bird */
        .maleo-bird {
            position: absolute;
            right: 20px;
            bottom: 20px;
            width: 120px;
            height: auto;
            z-index: 20;
        }

        /* Content Z-index */
        .content-z-index {
            position: relative;
            z-index: 10;
        }

        /* =========================
           RESPONSIVE DESIGN
        ========================= */
        @media (max-width: 1024px) {
            .preview-cards-stack,
            .dosen-preview-stack {
                width: 400px;
                height: 180px;
                margin: 0 40px;
            }

            .stacked-card,
            .dosen-preview-card {
                width: 140px;
                height: 160px;
            }

            .stacked-card.left-card,
            .dosen-preview-card.left-preview {
                transform: translateX(-120px) scale(0.85) rotate(-12deg);
            }

            .stacked-card.right-card,
            .dosen-preview-card.right-preview {
                transform: translateX(120px) scale(0.85) rotate(12deg);
            }

            .description-container {
                margin-left: 30px;
                max-width: 350px;
            }

            .carousel-container {
                flex-direction: column;
                gap: 40px;
            }

            .description-container {
                margin-left: 0;
                margin-top: 30px;
            }
        }

        @media (max-width: 768px) {
            .preview-cards-stack,
            .dosen-preview-stack {
                width: 320px;
                height: 150px;
                margin: 0 20px;
            }

            .stacked-card,
            .dosen-preview-card {
                width: 110px;
                height: 130px;
                font-size: 0.9rem;
            }

            .stacked-card.left-card,
            .dosen-preview-card.left-preview {
                transform: translateX(-90px) scale(0.8) rotate(-10deg);
            }

            .stacked-card.right-card,
            .dosen-preview-card.right-preview {
                transform: translateX(90px) scale(0.8) rotate(10deg);
            }

            .description-title {
                font-size: 1.8rem;
            }

            .description-text {
                font-size: 1rem;
                padding: 15px;
            }

            .carousel-chevron img,
            .dosen-carousel-chevron img {
                width: 30px;
                height: 30px;
            }

            .ppo-member-card,
            .dosen-member-card {
                width: 150px;
                height: 170px;
            }

            .ppo-member-card img,
            .dosen-member-card img {
                width: 70px;
                height: 70px;
                top: 25px;
            }

            .dosen-title {
                font-size: 2rem;
            }

            .maleo-bird {
                width: 80px;
            }

            .motif-top-right, .motif-bottom-left {
                width: 100px;
            }

            .dosen-motif-top-right, .dosen-motif-bottom-left {
                width: 80px;
            }
        }
    </style>

    {{-- PPO Section --}}
    <section class="relative bg-ppo-pattern">
        {{-- Motif Decorations --}}
        <img src="{{ asset('img/asset/2025/motif pt1.png') }}" class="motif-top-right" alt="Motif Top Right">
        <img src="{{ asset('img/asset/2025/motif pt1.png') }}" class="motif-bottom-left" alt="Motif Bottom Left">
        
        {{-- PPO Title --}}
        <div class="ppo-title-container">
            <img src="{{ asset('img/asset/2025/Title PPO.png') }}" alt="Title PPO" class="w-80 md:w-96 mx-auto">
        </div>
        
        {{-- Main Content --}}
        <div class="content-z-index" x-data="ppoSlider()">
            {{-- Preview Cards Carousel dengan Stack Effect --}}
            <div class="carousel-container">
                {{-- Chevron Kiri --}}
                <button @click="prevDivision()" class="carousel-chevron">
                    <img src="{{ asset('img/asset/2025/chevron_panahkiri.png') }}" alt="Previous">
                </button>

                {{-- Stacked Preview Cards --}}
                <div class="preview-cards-stack">
                    <template x-for="(division, index) in visibleDivisions" :key="index">
                        <div @click="setActiveDivision(division.originalIndex)" 
                             class="stacked-card"
                             :class="[
                                getPreviewCardClass(division.shortName),
                                { 
                                    'active': division.originalIndex === activeDivision,
                                    'left-card': index === 0 && division.originalIndex !== activeDivision,
                                    'right-card': index === 2 && division.originalIndex !== activeDivision
                                }
                             ]">
                        </div>
                    </template>
                </div>

                {{-- Chevron Kanan --}}
                <button @click="nextDivision()" class="carousel-chevron">
                    <img src="{{ asset('img/asset/2025/chevron_panahkanan.png') }}" alt="Next">
                </button>

                {{-- Description --}}
                <div class="description-container">
                    <h3 class="description-title" x-text="divisionList[activeDivision].name"></h3>
                    <p class="description-text" x-text="divisionList[activeDivision].description"></p>
                </div>
            </div>

            {{-- Members Cards --}}
            <div class="members-container">
                <template x-for="(member, index) in divisionList[activeDivision].members" :key="member.nama">
                    <div @click="setActiveMember(index)" 
                         class="ppo-member-card"
                         :class="activeMember === index ? 'highlight' : 'unhighlight'">
                        <img :src="'{{ asset('') }}' + member.foto" 
                             alt="Foto Anggota"
                             onerror="this.src='{{ asset('img/default-profile.jpg') }}'">
                        <h3 class="member-name" x-text="member.nama"></h3>
                        <p class="member-position" x-text="member.jabatan"></p>
                    </div>
                </template>
            </div>
        </div>
    </section>

    {{-- Dosen/Tendik Section --}}
    <section class="relative dosen-backdrop" x-data="dosenSlider()">
        {{-- Pattern Overlay - DIUBAH --}}
        
        <div class="relative overflow-visible">
  <!-- Backdrop dasar -->
  <img 
    src="{{ asset('img/asset/2025/backdrop_Tendik.png') }}" 
    alt="Backdrop Tendik"
    class="absolute left-0 top-[-310px] w-full object-cover z-[0]"
  >

  <!-- Pattern backdrop dosen (di tengah) -->
  <img 
    src="{{ asset('img/asset/2025/Pattern Backdrop Dosen.png') }}" 
    alt="Backdrop Dosen"
    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-[1200px] z-[1]"
  >
</div>
        
        {{-- Motif untuk dosen --}}

        <img src="{{ asset('img/asset/2025/motif pt1.png') }}" class="dosen-motif-top-right" alt="Motif Top Right">
        <img src="{{ asset('img/asset/2025/motif pt1.png') }}" class="dosen-motif-bottom-left" alt="Motif Bottom Left">
        
        {{-- Dosen Title --}}
        <div class="dosen-title-container">
            <img src="{{ asset('img/asset/2025/Title Card Dosen.png') }}" alt="Judul Dosen Tendik" class="w-80 md:w-96 mx-auto">
        </div>

        {{-- Main Dosen Content --}}
        <div class="dosen-content">
            {{-- Preview Cards Stack --}}
            <div class="dosen-preview-container">
                {{-- Chevron Kiri --}}
                <button @click="prev()" class="dosen-carousel-chevron">
                    <img src="{{ asset('img/asset/2025/chevron_panahkiri.png') }}" alt="Previous">
                </button>

                {{-- Stacked Preview Cards --}}
                <div class="dosen-preview-stack">
                    <template x-for="(division, index) in visibleDosenDivisions" :key="index">
                        <div @click="setActive(division.originalIndex)" 
                             class="dosen-preview-card"
                             :class="{
                                'active': division.originalIndex === activeIndex,
                                'left-preview': index === 0 && division.originalIndex !== activeIndex,
                                'right-preview': index === 2 && division.originalIndex !== activeIndex
                             }">
                            <span x-text="division.name"></span>
                        </div>
                    </template>
                </div>

                {{-- Chevron Kanan --}}
                <button @click="next()" class="dosen-carousel-chevron">
                    <img src="{{ asset('img/asset/2025/chevron_panahkanan.png') }}" alt="Next">
                </button>
            </div>

            {{-- Division Title --}}
            <h2 class="dosen-title" x-text="divisions[activeIndex].name"></h2>

            {{-- Members Cards --}}
            <div class="members-container">
                <template x-for="member in divisions[activeIndex].members" :key="member.nama">
                    <div class="dosen-member-card">
                        <img :src="'{{ asset('') }}' + member.foto" 
                             alt="Foto Dosen"
                             onerror="this.src='{{ asset('img/default-profile.jpg') }}'">
                        <h3 class="member-name" x-text="member.nama"></h3>
                        <p class="member-position" x-text="member.jabatan"></p>
                    </div>
                </template>
            </div>
        </div>

        {{-- Maleo Bird --}}
        <img src="{{ asset('img/asset/2025/maleo.png') }}" class="maleo-bird" alt="Burung Maleo">
    </section>

    <script>
        function ppoSlider() {
            return {
                activeDivision: 0,
                activeMember: 0,
                visibleCount: 3,
                divisions: {
                    bph: {
                        name: 'Badan Pengurus Harian',
                        shortName: 'BPH',
                        description: 'Badan Pengurus Harian (BPH) merupakan inti dari struktur kepanitiaan PKKMB yang berperan sebagai pengarah, pengendali, dan penanggung jawab utama jalannya seluruh rangkaian kegiatan. BPH memastikan koordinasi antar divisi berjalan lancar, visi serta misi PKKMB tercapai, dan seluruh kebutuhan teknis maupun strategis dapat terselenggara sesuai rencana.',
                        members: @json($bph ?? [])
                    },
                    acara: {
                        name: 'Seksi Acara',
                        shortName: 'Acara',
                        description: 'Bertanggung jawab atas perencanaan, pelaksanaan, dan evaluasi seluruh rangkaian acara.',
                        members: @json($acara ?? [])
                    },
                    lapk: {
                        name: 'Seksi LAPK',
                        shortName: 'LAPK',
                        description: 'Seksi Penelitian dan Pengembangan, Akademik, dan Pendamping Kelompok (LAPK) berperan dalam merancang serta mengelola kegiatan akademik, penelitian, dan pendampingan kelompok mahasiswa baru selama PKKMB, guna memastikan pengalaman belajar yang optimal dan mendukung integrasi sosial di lingkungan kampus.',
                        members: @json($lapk ?? [])
                    },
                    gramti: {
                        name: 'Seksi Gramti',
                        shortName: 'Gramti',
                        description: 'Mengurus grafis, multimedia, dan teknologi informasi untuk mendukung publikasi dan acara.',
                        members: @json($gramti ?? [])
                    },
                    tibum: {
                        name: 'Seksi Tibum',
                        shortName: 'Tibum',
                        description: 'Menjaga ketertiban dan keamanan selama keberlangsungan seluruh rangkaian acara.',
                        members: @json($tibum ?? [])
                    },
                    ppm: {
                        name: 'Seksi PPM',
                        shortName: 'PPM',
                        description: 'Seksi Pertolongan Pertama dan Medis (PPM) bertanggung jawab atas penanganan kesehatan dan pertolongan pertama selama kegiatan berlangsung, memastikan keselamatan peserta dan panitia.',
                        members: @json($ppm ?? [])
                    },
                    umum: {
                        name: 'Seksi Umum',
                        shortName: 'Umum',
                        description: 'Membantu tugas-tugas umum kesekretariatan dan administrasi lainnya.',
                        members: @json($umum ?? [])
                    }
                },
                get divisionList() {
                    return Object.values(this.divisions);
                },
                get visibleDivisions() {
                    const divisions = this.divisionList;
                    const result = [];
                    
                    // Show current, previous, and next divisions
                    for (let i = -1; i <= 1; i++) {
                        const index = (this.activeDivision + i + divisions.length) % divisions.length;
                        result.push({
                            ...divisions[index],
                            originalIndex: index
                        });
                    }
                    
                    return result;
                },
                getPreviewCardClass(shortName) {
                    const classMap = {
                        'BPH': 'ppo-preview-bph',
                        'Acara': 'ppo-preview-acara',
                        'LAPK': 'ppo-preview-lapk',
                        'Gramti': 'ppo-preview-gramti',
                        'Tibum': 'ppo-preview-tibum',
                        'PPM': 'ppo-preview-ppm',
                        'Umum': 'ppo-preview-umum'
                    };
                    return classMap[shortName] || 'ppo-preview-bph';
                },
                setActiveDivision(index) {
                    this.activeDivision = index;
                    this.activeMember = 0;
                },
                setActiveMember(index) {
                    this.activeMember = index;
                },
                nextDivision() {
                    this.activeDivision = (this.activeDivision + 1) % this.divisionList.length;
                    this.activeMember = 0;
                },
                prevDivision() {
                    this.activeDivision = (this.activeDivision - 1 + this.divisionList.length) % this.divisionList.length;
                    this.activeMember = 0;
                }
            }
        }

        function dosenSlider() {
            return {
                activeIndex: 0,
                divisions: [
                    {
                        name: 'Pelindung',
                        members: @json($pelindung ?? [])
                    },
                    {
                        name: 'Pengarah',
                        members: @json($pengarah ?? [])
                    },
                    {
                        name: 'Pembina',
                        members: @json($pembina ?? [])
                    },
                    {
                        name: 'Penanggung Jawab',
                        members: @json($penanggung_jawab ?? [])
                    },
                    {
                        name: 'Pengawas',
                        members: @json($pengawas ?? [])
                    }
                ],
                get visibleDosenDivisions() {
                    const divisions = this.divisions;
                    const result = [];
                    
                    // Show current, previous, and next divisions
                    for (let i = -1; i <= 1; i++) {
                        const index = (this.activeIndex + i + divisions.length) % divisions.length;
                        result.push({
                            ...divisions[index],
                            originalIndex: index
                        });
                    }
                    
                    return result;
                },
                setActive(index) {
                    this.activeIndex = index;
                },
                next() {
                    this.activeIndex = (this.activeIndex + 1) % this.divisions.length;
                },
                prev() {
                    this.activeIndex = (this.activeIndex - 1 + this.divisions.length) % this.divisions.length;
                }
            }
        }
    </script>
</x-home-layout>