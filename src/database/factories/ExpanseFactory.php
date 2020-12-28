<?php

namespace Database\Factories;

use App\Models\Expanse;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpanseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expanse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_barang' => $this->faker->colorName,
            'qty'         => rand(2, 10),
            'images'      => $this->faker->imageUrl(),
            'nama_sup'    => $this->faker->name,
            'alamat_sub'  => $this->faker->address,
            'total'       => rand(200, 300)
        ];
    }
}
