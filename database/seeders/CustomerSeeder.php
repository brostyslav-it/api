<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::factory()->count(25)->hasInvoices(10)->create();
        Customer::factory()->count(40)->create();
        Customer::factory()->count(100)->hasInvoices(50)->create();
    }
}
