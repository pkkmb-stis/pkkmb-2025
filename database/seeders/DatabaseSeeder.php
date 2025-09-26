<?php

namespace Database\Seeders;

use App\Models\Poin\Poin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Permission Seeder
        $this->call([
            MenuPermissionSeeder::class,
            AdministratorMenuPermissionSeeder::class,
            LapkMenuPermissionSeeder::class,
            InformasiMenuPermissionSeeder::class,
            TibumMenuPermissionSeeder::class,
            MabaMenuPermissionSeeder::class,
            AbsensiSeeder::class,
            PermissionPoinKelompokSeeder::class,
            PermissionLaporanKegiatan::class,
        ]);

        // Role Seeder
        $this->call(RoleSeeder::class);
        $this->call(RolePengawasSeeder::class);
        // $this->call(PermissionTibumToPoinKelompokSeeder::class);

        // Jenis Poin
        $this->call(JenisPoinSeeder::class);

        // Jenis Poin Tambahan
        $this->call(JenisPoinKelompokSeeder::class);

        // Indikator Penilaian
        $this->call(IndikatorPenilaian::class);

        // Provinsi dan Kabkota
        $this->call([
            ProvinsiSeeder::class,
            KabkotSeeder::class
        ]);

        // kalau di local pass maba dan panitia sama dengan usernamenya, kalau di production password maba akan diisi sesuai dengan pass md5 yang dikasih sama kampus sedangkan untuk panitia akan digenerate random dan harus reset password

        // User Panitia
        $this->call(PPOSeeder::class);
        $this->call(PPMDanUmumSeeder::class);

        // User Maba
        $this->call(MabaSeeder::class);
        $this->call(MabaTambahanSeeder::class);
        $this->call(MawaMengulangSeeder::class);

        // User Dosen
        $this->call(DosenSeeder::class);

        // Video in home seeder
        $this->call(VideoSeeder::class);

        // Timeline seeder
        $this->call(TimelineSeeder::class);

        // FAQ seeder
        $this->call(FaqSeeder::class);

        // Generate kelompok
        $this->call(KelompokSeeder::class);

        // Warna seeder
        $this->call(WarnaCoCardKelompokSeeder::class);

        // Day seeder
        $this->call(DaySeeder::class);

        //  Jika environment local maka generate data dummy
        if (env('APP_ENV') == 'local') {
            // Generate poin
            Poin::factory()->count(2000)->create();
        }
    }
}
