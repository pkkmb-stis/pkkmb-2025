<?php

namespace Database\Factories;

use App\Models\Kelompok;
use Illuminate\Database\Eloquent\Factories\Factory;

class KelompokFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kelompok::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->words(2, true),
            'description' => $this->faker->text(30),
            'link_group_wa' => $this->faker->url,
            'link_zoom' => $this->faker->url,
            'link_classroom' => $this->faker->url
        ];
    }
}
