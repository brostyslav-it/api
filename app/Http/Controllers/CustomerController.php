<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Filters\CustomersFilter;

class CustomerController extends Controller
{
    public function index(CustomersFilter $filter): CustomerCollection
    {
        $customers = Customer::where($filter->transform(request()));

        if (request()->query('includeInvoices')) {
            $customers->with(['invoices']);
        }

        return new CustomerCollection($customers->paginate()->appends(request()->query()));
    }

    public function store(StoreCustomerRequest $request): CustomerResource
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    public function show(Customer $customer): CustomerResource
    {
        if (request()->query('includeInvoices')) {
            return new CustomerResource($customer->loadMissing('invoices'));
        }

        return new CustomerResource($customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): CustomerResource
    {
        $customer->update($request->all());

        return new CustomerResource($customer);
    }

    public function destroy(Customer $customer)
    {

    }
}
