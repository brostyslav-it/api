<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::factory()->count(10)->hasInvoices(5)->create();
        Customer::factory()->count(10)->create();
        Customer::factory()->count(10)->hasInvoices(10)->create();
    }
}
