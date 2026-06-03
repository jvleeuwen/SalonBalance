<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;

class CustomersController extends Controller
{
    public function index()
    {
        return CustomerResource::collection(Customer::all());
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());

        return (new CustomerResource($customer))->response()->setStatusCode(201);
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return new CustomerResource($customer);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(null, 204);
    }
}