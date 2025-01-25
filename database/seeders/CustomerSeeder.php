<?php

namespace Database\Seeders;

use App\Models\Customer\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::factory(10)->hasInvoices(5)->create();
        Customer::factory(10)->create();
        Customer::factory(10)->hasInvoices(10)->create();
    }
}
