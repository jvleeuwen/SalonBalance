<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomersTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_store_a_customer()
    {
        $response = $this->postJson('/api/customers', [
            'name'             => 'John Doe',
            'telephone_number' => '0612345678',
            'street_address'   => 'Main Street 1',
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, Customer::all());
    }

    public function test_it_can_show_a_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->getJson("/api/customers/{$customer->id}");

        $response->assertStatus(200);
        $this->assertEquals($customer->name, $response->json('data.name'));
    }

    public function test_it_can_update_a_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->putJson("/api/customers/{$customer->id}", [
            'name'             => 'Jane Doe',
            'telephone_number' => '0687654321',
            'street_address'   => 'Second Street 2',
        ]);

        $response->assertStatus(200);
        $this->assertEquals('Jane Doe', Customer::find($customer->id)->name);
    }

    public function test_it_can_delete_a_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->deleteJson("/api/customers/{$customer->id}");

        $response->assertStatus(204);
        $this->assertCount(0, Customer::all());
    }
}