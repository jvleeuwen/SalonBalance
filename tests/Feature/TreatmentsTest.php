<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Treatment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TreatmentsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_treatment(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->postJson('/treatments', [
            'customer_id' => $customer->id,
            'name'        => $this->faker->word(),
            'price'       => 49.99,
            'version'     => 1,
        ]);

        $response->assertStatus(201);
        $data = $response->json('treatment');
        $this->assertDatabaseHas('treatments', [
            'name'        => $data['name'],
            'price'       => $data['price'],
            'customer_id' => $customer->id,
        ]);
    }

    public function test_show_treatment(): void
    {
        $treatment = Treatment::factory()->create();

        $response = $this->getJson("/treatments/{$treatment->id}");

        $response->assertStatus(200);
        $this->assertEquals($treatment->name, $response->json('name'));
    }

    public function test_update_treatment(): void
    {
        $treatment = Treatment::factory()->create();
        $newName  = $this->faker->word();
        $newPrice = 75.00;

        $response = $this->putJson("/treatments/{$treatment->id}", [
            'name'  => $newName,
            'price' => $newPrice,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('treatments', [
            'id'    => $treatment->id,
            'name'  => $newName,
            'price' => $newPrice,
        ]);
    }

    public function test_delete_treatment(): void
    {
        $treatment = Treatment::factory()->create();

        $response = $this->deleteJson("/treatments/{$treatment->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('treatments', ['id' => $treatment->id]);
    }
}