<?php

namespace Tests\Feature;

use App\Models\Borrower;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BorrowerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_data()
    {
        $response = $this->get('/borrower');
        $response->assertStatus(200);
    }

    public function test_store_data()
    {
        $borrowerData = [
            'name' => 'Budi Santoso',
            'kontak' => '08123456789'
        ];

        $response = $this->post('/borrower', $borrowerData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('borrowers', $borrowerData);
    }

    public function test_edit_data()
    {
        $borrower = Borrower::create([
            'name' => 'John Doe',
            'kontak' => '08987654321'
        ]);

        $response = $this->get("/borrower/{$borrower->id}/edit");
        $response->assertStatus(200);
    }

    public function test_update_data()
    {
        $borrower = Borrower::create([
            'name' => 'Jane Doe',
            'kontak' => '08555555555'
        ]);

        $updatedData = [
            'name' => 'Jane Doe Updated',
            'kontak' => '08111111111'
        ];

        $response = $this->put("/borrower/{$borrower->id}", $updatedData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('borrowers', $updatedData);
    }

    public function test_destroy_data()
    {
        $borrower = Borrower::create([
            'name' => 'Michael Smith',
            'kontak' => '08777777777'
        ]);

        $response = $this->delete("/borrower/{$borrower->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('borrowers', ['id' => $borrower->id]);
    }
}
