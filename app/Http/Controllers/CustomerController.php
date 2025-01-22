<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(): CustomerCollection
    {
        return new CustomerCollection(Customer::paginate());
    }

    public function store(StoreCustomerRequest $request)
    {

    }

    public function show(Customer $customer): CustomerResource
    {
        return new CustomerResource($customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {

    }

    public function destroy(Customer $customer)
    {

    }
}
