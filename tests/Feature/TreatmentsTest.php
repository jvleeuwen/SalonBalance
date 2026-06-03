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

        $response = $this->postJson('/api/treatments', [
            'customer_id' => $customer->id,
            'name'        => 'Haircut',
            'price'       => 49.99,
            'version'     => 1,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('treatments', [
            'name'        => 'Haircut',
            'customer_id' => $customer->id,
        ]);
    }

    public function test_show_treatment(): void
    {
        $treatment = Treatment::factory()->create();

        $response = $this->getJson("/api/treatments/{$treatment->id}");

        $response->assertStatus(200);
        $this->assertEquals($treatment->name, $response->json('data.name'));
    }

    public function test_update_treatment(): void
    {
        $treatment = Treatment::factory()->create();
        $newName   = 'Updated Treatment';
        $newPrice  = 75.00;

        $response = $this->putJson("/api/treatments/{$treatment->id}", [
            'name'  => $newName,
            'price' => $newPrice,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('treatments', [
            'id'   => $treatment->id,
            'name' => $newName,
        ]);
    }

    public function test_delete_treatment(): void
    {
        $treatment = Treatment::factory()->create();

        $response = $this->deleteJson("/api/treatments/{$treatment->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('treatments', ['id' => $treatment->id]);
    }
}