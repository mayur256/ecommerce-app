<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'brand_name' => $this->faker->company,
            'brand_desc' => $this->faker->realText($maxNbChars = 100, $indexSize = 1)
        ];
    }
}
