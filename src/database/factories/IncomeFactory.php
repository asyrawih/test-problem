<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Income::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id'  => Customer::factory()->create()->id,
            'nama_barang'  => $this->faker->sentence,
            'harga_barang' => rand(1000, 10000),
            'qty'          => rand(1, 100),
            'total'        => rand(200 , 100),
            'images'       => 'pp.jpeg',
        ];
    }
}
