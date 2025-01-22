<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected array $customerTypes = ['I', 'B'];

    public function definition(): array
    {
        $type = $this->faker->randomElement($this->customerTypes);

        return [
            'name' => $type === 'I' ? $this->faker->name() : $this->faker->company(),
            'type' => $type,
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->citySuffix(),
            'postal_code' => $this->faker->postcode(),
        ];
    }
}
