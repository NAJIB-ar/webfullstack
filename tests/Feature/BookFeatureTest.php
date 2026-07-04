<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookFeatureTest extends TestCase
{
    use RefreshDatabase;
    public function test_index_data() {
        $response = $this->get('/books');
        $response->assertStatus(200);
    }
    
    public function test_store_data() {
        $book = Book::factory()->make();
        $response = $this->post('/books', $book->toArray());
        $response->assertStatus(302);
        $this->assertDatabaseHas('books', [
            'title' => $book->title,
            'author' => $book->author,
            'year' => $book->year,
        ]);
    }
        
    public function test_edit_data() {
        $book = Book::factory()->create();    
        $response = $this->get("/books/{$book->id}/edit");
        $response->assertStatus(200);
        $book->delete();
        }
            
    public function test_update_data() {
        $book = Book::factory()->create();

        $updatedBookData = [
            'title' => 'Judul Update',
            'author' => 'Penulis Update',
            'year' => 2025
        ];

        $response = $this->put("/books/{$book->id}", $updatedBookData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('books', $updatedBookData);
        $book->delete();
    }

    public function test_destroy_data() {
        $book = Book::factory()->create();
        $response = $this->delete("/books/{$book->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
        $book->delete();
    }
}
