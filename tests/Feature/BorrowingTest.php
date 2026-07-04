<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Borrower;
use App\Models\Borrowing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BorrowingTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_data()
    {
        $response = $this->get('/borrowing');
        $response->assertStatus(200);
    }

    public function test_store_data()
    {
        $book = Book::factory()->create();
        $borrower = Borrower::create([
            'name' => 'Budi Santoso',
            'kontak' => '08123456789'
        ]);

        $borrowingData = [
            'book_id' => $book->id,
            'borrower_id' => $borrower->id,
        ];

        $response = $this->post('/borrowing', $borrowingData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('borrowings', $borrowingData);
    }

    public function test_edit_data()
    {
        $book = Book::factory()->create();
        $borrower = Borrower::create([
            'name' => 'John Doe',
            'kontak' => '08987654321'
        ]);

        $borrowing = Borrowing::create([
            'book_id' => $book->id,
            'borrower_id' => $borrower->id,
        ]);

        $response = $this->get("/borrowing/{$borrowing->id}/edit");
        $response->assertStatus(200);
    }

    public function test_update_data()
    {
        $book1 = Book::factory()->create();
        $borrower1 = Borrower::create([
            'name' => 'Jane Doe',
            'kontak' => '08555555555'
        ]);

        $borrowing = Borrowing::create([
            'book_id' => $book1->id,
            'borrower_id' => $borrower1->id,
        ]);

        $book2 = Book::factory()->create();
        $borrower2 = Borrower::create([
            'name' => 'Jane Doe Updated',
            'kontak' => '08111111111'
        ]);

        $updatedData = [
            'book_id' => $book2->id,
            'borrower_id' => $borrower2->id,
        ];

        $response = $this->put("/borrowing/{$borrowing->id}", $updatedData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('borrowings', $updatedData);
    }

    public function test_destroy_data()
    {
        $book = Book::factory()->create();
        $borrower = Borrower::create([
            'name' => 'Michael Smith',
            'kontak' => '08777777777'
        ]);

        $borrowing = Borrowing::create([
            'book_id' => $book->id,
            'borrower_id' => $borrower->id,
        ]);

        $response = $this->delete("/borrowing/{$borrowing->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('borrowings', ['id' => $borrowing->id]);
    }
}
