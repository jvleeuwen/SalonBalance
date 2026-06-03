<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_customer()
    {
        $response = $this->postJson('/customers', [
            'name' => $this->faker->name,
            'telephone_number' => $this->faker->e164PhoneNumber,
            'street_address' => $this->faker->address,
        ]);

        $response->assertStatus(201);
        $customer = json_decode($response->getContent(), true);
        $this->assertDatabaseHas('customers', [
            'name' => $customer['name'],
            'telephone_number' => $customer['telephone_number'],
            'street_address' => $customer['street_address'],
        ]);
    }

    public function test_show_customer()
    {
        $customer = Customer::factory()->create();
        $response = $this->getJson("/customers/{$customer->id}");

        $response->assertStatus(200);
        $this->assertEquals($customer->name, json_decode($response->getContent(), true)['name']);
    }

    public function test_update_customer()
    {
        $customer = Customer::factory()->create();
        $newName = $this->faker->name;
        $newTelephoneNumber = $this->faker->e164PhoneNumber;
        $newStreetAddress = $this->faker->address;

        $response = $this->putJson("/customers/{$customer->id}", [
            'name' => $newName,
            'telephone_number' => $newTelephoneNumber,
            'street_address' => $newStreetAddress,
        ]);

        $response->assertStatus(201);
        $updatedCustomer = json_decode($response->getContent(), true);
        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'name' => $updatedCustomer['name'],
            'telephone_number' => $updatedCustomer['telephone_number'],
            'street_address' => $updatedCustomer['street_address'],
        ]);
    }

    public function test_delete_customer()
    {
        $customer = Customer::factory()->create();
        $response = $this->deleteJson("/customers/{$customer->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id,
        ]);
    }
}