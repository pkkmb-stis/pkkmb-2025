<?php

namespace Database\Factories\Poin;

use App\Models\Poin\JenisPoin;
use App\Models\Poin\Penebusan;
use App\Models\Poin\Poin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenebusanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Penebusan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $condition = rand(1, 5);
        $deadline = rand(1, 7);
        $jenis_poin = JenisPoin::where('category', 3)->inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        // Kondisi 1 status: Menunggu Upload dan kondisi 5 maba terlambat
        $data = [
            'user_id' => $user->id,
            'jenis_poin_id' => $jenis_poin->id,
            'deadline' => now()->addDays($deadline),
            'status' => MAP_CATEGORY['penebusan_user'][$condition - 1],
            'taken_at' => now(),
        ];

        // Kondisi 2 status: Sedang dikoreksi
        // Maba sudah pilih tugas, sudah upload tepat waktu, belum diaccept tibum
        if ($condition == 2) {
            $data['link'] = $this->faker->url();
            $data['submited_at'] = now()->addDays($deadline - 1);
        }

        // Kondisi 3 status: Butuh Revisi
        // Maba sudah upload tepat waktu, butuh revisi
        if ($condition == 3) {
            $data['deadline'] = now()->addDays(2);
            $data['link'] = $this->faker->url();
            $data['catatan'] = 'Perbaiki bagian ' . $this->faker->sentence();
        }

        // Kondisi 4 status: Selesai
        // Maba sudah pilih tugas, sudah upload tepat waktu, sudah diaccept tibum
        if ($condition == 4) {
            $poin = Poin::create([
                'poin' => $jenis_poin->poin,
                'alasan' => 'Telah menyelesaikan penebusan',
                'jenis_poin_id' => $jenis_poin->id,
                'user_id' => $user->id,
            ]);

            $data['poin_id'] = $poin->id;
            $data['link'] = $this->faker->url();
            $data['submited_at'] = now()->addDays($deadline - 1);
            $data['accepted_at'] = now()->addDays($deadline);
        }

        return $data;
    }
}
