<?php

namespace Tests\Feature;

use App\Models\Treatment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TreatmentsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_treatment()
    {
        $response = $this->postJson('/treatments', [
            'name' => $this->faker->word,
            'price' => rand(10, 100),
            'version' => rand(1, 5),
        ]);

        $response->assertStatus(201);
        $treatment = json_decode($response->getContent(), true);
        $this->assertDatabaseHas('treatments', [
            'name' => $treatment['name'],
            'price' => $treatment['price'],
            'version' => $treatment['version'],
        ]);
    }

    public function test_show_treatment()
    {
        $treatment = Treatment::factory()->create();
        $response = $this->getJson("/treatments/{$treatment->id}");

        $response->assertStatus(200);
        $this->assertEquals($treatment->name, json_decode($response->getContent(), true)['name']);
    }

    public function test_update_treatment()
    {
        $treatment = Treatment::factory()->create();
        $newName = $this->faker->word;
        $newPrice = rand(10, 100);
        $newVersion = rand(1, 5);

        $response = $this->putJson("/treatments/{$treatment->id}", [
            'name' => $newName,
            'price' => $newPrice,
            'version' => $newVersion,
        ]);

        $response->assertStatus(201);
        $updatedTreatment = json_decode($response->getContent(), true);
        $this->assertDatabaseHas('treatments', [
            'id' => $treatment->id,
            'name' => $updatedTreatment['name'],
            'price' => $updatedTreatment['price'],
            'version' => $updatedTreatment['version'],
        ]);
    }

    public function test_delete_treatment()
    {
        $treatment = Treatment::factory()->create();
        $response = $this->deleteJson("/treatments/{$treatment->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('treatments', [
            'id' => $treatment->id,
        ]);
    }
}