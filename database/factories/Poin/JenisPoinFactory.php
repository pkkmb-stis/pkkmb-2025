<?php

namespace Database\Factories\Poin;

use App\Models\Poin\JenisPoin;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenisPoinFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JenisPoin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = rand(1,3);
        $type = null;
        $poin = null;
        if($category == 3){
            $type = rand(1,3);
            $poin = [POIN_PENEBUSAN_RINGAN,POIN_PENEBUSAN_SEDANG,POIN_PENEBUSAN_BERAT][$type-1];
        }
        return [
            'nama' => $this->faker->sentence(3),
            'category' => $category,
            'poin' => $poin ?? rand(1,3),
            'type' => $type,
            'deadline' => null,
            'detail' => $this->faker->sentence(12),
        ];
    }
}
