<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerQuery;

class CustomerController extends Controller
{
    public function index(): CustomerCollection
    {
        if (!empty($queryItems = CustomerQuery::transform(request()))) {
            return new CustomerCollection(Customer::where($queryItems)->paginate());
        }

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
