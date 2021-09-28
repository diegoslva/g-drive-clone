<?php

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BuildingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Building::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'name' => $this->faker->company,
        'address' => $this->faker->address,
        'cnpj' => '23.663.478/0001-24',
        'monthly_payment' => 'Sim', 
        'monthly_fee' => '20.00',
        'slug' => Str::of($this->faker->company)->slug('-')
      ];
    }

}
