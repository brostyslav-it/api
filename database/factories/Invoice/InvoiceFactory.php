<?php

namespace Database\Factories\Invoice;

use App\Models\Customer\Customer;
use App\Models\Invoice\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        $status = $this->faker->randomElement(InvoiceStatus::toArray());

        return [
            'customer_id' => Customer::factory(),
            'amount' => $this->faker->numberBetween(50, 10000),
            'status' => $status,
            'billed_at' => $this->faker->dateTimeThisDecade(),
            'paid_at' => $status === 'P' ? $this->faker->dateTimeThisDecade() : null,
        ];
    }
}
