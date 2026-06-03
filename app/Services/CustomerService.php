<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    public function create(array $validated): Customer
    {
        return DB::transaction(static function () use ($validated): Customer {
            return Customer::create($validated);
        });
    }

    public function update(Customer $customer, array $validated): Customer
    {
        $customer->update($validated);

        return $customer->fresh();
    }

    public function delete(Customer $customer): void
    {
        $customer->delete();
    }
}