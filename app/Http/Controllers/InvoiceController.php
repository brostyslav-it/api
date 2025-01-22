<?php

namespace App\Http\Controllers;

use App\Filters\InvoicesFilter;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceCollection;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index(InvoicesFilter $filter): InvoiceCollection
    {
        if (!empty($queryItems = $filter->transform(request()))) {
            return new InvoiceCollection(Invoice::where($queryItems)->paginate());
        }

        return new InvoiceCollection(Invoice::paginate());
    }

    public function store(StoreInvoiceRequest $request)
    {

    }

    public function show(Invoice $invoice): InvoiceResource
    {
        return new InvoiceResource($invoice);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {

    }

    public function destroy(Invoice $invoice)
    {

    }
}
