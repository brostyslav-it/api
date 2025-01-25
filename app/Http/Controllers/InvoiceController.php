<?php

namespace App\Http\Controllers;

use App\Filters\InvoicesFilter;
use App\Http\Requests\BulkStoreInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceCollection;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    public function index(InvoicesFilter $filter): InvoiceCollection
    {
        return new InvoiceCollection(Invoice::where($filter->transform(request()))->paginate()->appends(request()->query()));
    }

    public function store(StoreInvoiceRequest $request)
    {

    }

    public function bulkStore(BulkStoreInvoiceRequest $request): JsonResponse
    {
        $bulk = collect($request->all())->map(function (array $value) {
            return Arr::except($value, ['customerId', 'billedAt', 'paidAt']);
        });

        return response()->json(['success' => Invoice::insert($bulk->toArray())]);
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
