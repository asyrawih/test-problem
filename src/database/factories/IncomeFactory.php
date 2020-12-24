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
            'images'       => 'https://images.unsplash.com/photo-1459802071246-377c0346da93?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=652&q=80',
        ];
    }
}
