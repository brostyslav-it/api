<?php

namespace Database\Factories\Customer;

use App\Models\Customer\Enums\CustomerType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{

    public function definition(): array
    {
        $type = $this->faker->randomElement(CustomerType::toArray());

        return [
            'name' => $type === CustomerType::INDIVIDUAL->value ? $this->faker->name() : $this->faker->company(),
            'type' => $type,
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->citySuffix(),
            'postal_code' => $this->faker->postcode(),
        ];
    }
}
