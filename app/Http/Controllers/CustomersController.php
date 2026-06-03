<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Services\CustomerService;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CustomersController extends Controller
{
    public function __construct(
        private readonly CustomerService $customerService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View|JsonResponse
    {
        try {
            $customers = Customer::query()->with('treatments')->paginate(25);

            return view('customers.index', compact('customers'));
        } catch (\Exception $e) {
            Log::error('Error fetching customers', ['exception' => $e->getMessage()]);

            return response()->json(['message' => 'Internal server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request): JsonResponse
    {
        try {
            $this->customerService->create($request->validated());

            return response()->json(['message' => 'Customer created.'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error('Error creating customer', ['exception' => $e->getMessage()]);

            return response()->json(['message' => 'Internal server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): JsonResponse
    {
        try {
            return response()->json(new CustomerResource($customer));
        } catch (\Exception $e) {
            Log::error('Error fetching customer', ['exception' => $e->getMessage()]);

            return response()->json(['message' => 'Internal server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): View
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        try {
            $this->customerService->update($customer, $request->validated());

            return response()->json(['message' => 'Customer updated.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Error updating customer', ['exception' => $e->getMessage()]);

            return response()->json(['message' => 'Internal server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): JsonResponse
    {
        try {
            $this->customerService->delete($customer);

            return response()->json(['message' => 'Customer deleted.'], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            Log::error('Error deleting customer', ['exception' => $e->getMessage()]);

            return response()->json(['message' => 'Internal server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}