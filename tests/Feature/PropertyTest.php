<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_list(): void
    {
        $response = $this->getJson('/api/real-estate');
        $response->assertStatus(200)
					->assertJson(fn (AssertableJson $json) =>
    					$json->has('data')
         					->has('links')
         					->has('meta')
         					->has('meta.current_page')
         					->has('meta.from')
         					->missing('msg')
					)
					->assertJsonCount(3);
    }

	public function test_add_empty(): void
	{
		$response = $this->postJson('/api/real-estate/add');
		$response->assertStatus(422);
	}

	public function test_add_property(): void
	{
		$response = $this->postJson('/api/real-estate/add', [
			"name" => "Property One",
			"real_estate_type" => "Department",
			"street" => "Street One",
			"external_number" => "EXT-One",
			"internal_number" => "INT-One",
			"neighborhood" => "neighborhood One",
			"city" => "Delhi",
			"country" => "IN",
			"rooms" => 2,
			"bathrooms" => 1,
			"comments" => "Comments Text One"
		]);

		$response->assertStatus(201)
				->assertJson(fn (AssertableJson $json) =>
					$json->has('data')
						->where('data.PropertyName', "Property One")
			)->assertJsonCount(1);
	}

	public function test_view(): void
	{
		$response = $this->getJson('/api/real-estate/view/5');
		$response->assertStatus(200)
				->assertJson(fn (AssertableJson $json) =>
					$json->has('data')
						->missing('error')
						->where('data.PropertyId', 5)
				)
				->assertJsonCount(1);
	}
}
