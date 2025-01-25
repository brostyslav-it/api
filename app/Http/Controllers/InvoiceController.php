<?php

namespace App\Http\Controllers;

use App\Filters\InvoicesFilter;
use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceCollection;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class InvoiceController extends Controller
{
    public function index(InvoicesFilter $filter): InvoiceCollection
    {
        return new InvoiceCollection(Invoice::where($filter->transform(request()))->paginate()->appends(request()->query()));
    }

    public function store(StoreInvoiceRequest $request): JsonResponse
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

    public function update(UpdateInvoiceRequest $request, Invoice $invoice): InvoiceResource
    {
        $invoice->update($request->all());

        return new InvoiceResource($invoice);
    }

    public function destroy(Invoice $invoice): void
    {
        if (!request()->user()->tokenCan('delete')) {
            throw new AccessDeniedHttpException();
        }
        $invoice->delete();
    }
}
