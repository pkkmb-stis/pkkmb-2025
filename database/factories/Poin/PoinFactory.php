<?php

namespace Database\Factories\Poin;

use App\Models\Poin\JenisPoin;
use App\Models\Poin\Poin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PoinFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Poin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jenis_poin = JenisPoin::whereIn('category', [CATEGORY_JENISPOIN_PELANGGARAN, CATEGORY_JENISPOIN_PENGHARGAAN])
            ->inRandomOrder()
            ->first();

        $urutanInput = $this->faker->dateTimeBetween('-4 days');
        $idUser = User::inRandomOrder()->first()->id;

        // kalau jenis pelanggaran dan sudah pernah dapat maka kalikan dua poinnya
        if ($jenis_poin->category == CATEGORY_JENISPOIN_PELANGGARAN)
            $pengaliPoin = Poin::where('user_id', $idUser)->where('jenis_poin_id', $jenis_poin->id)->exists() ? 2 : 1;
        else $pengaliPoin = 1;

        $poin = $jenis_poin->poin;
        $alasan = $pengaliPoin == 2 ? 'Kamu sudah pernah mendapatkan poin ini sehingga poinnya dikalikan dua, dari ' . $poin . ' menjadi ' . ($poin * 2) : $this->faker->paragraph(5);

        return [
            'user_id' => $idUser,
            'created_at' => $urutanInput,
            'updated_at' => $urutanInput,
            'urutan_input' => $urutanInput,
            'jenis_poin_id' => $jenis_poin->id,
            'poin' => $jenis_poin->poin * $pengaliPoin,
            'alasan' => $alasan
        ];
    }
}
