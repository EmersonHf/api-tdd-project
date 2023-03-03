<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Http\Controllers\API\BooksController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BooksControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_books_endpoint(): void
    {
        $books = Book::factory(3)->create();

        $response = $this->getJson('/api/books');


        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJson(function (AssertableJson $json) use($books){
            $json->whereAllType([
                '0.id'=> 'integer',
                '0.title'=> 'string',
                '0.isbn'=> 'string'
            ]);

            $json->hasAll(['0.id','0.title','0.isbn'])->etc();

            $book = $books->first();

            $json->whereAll([
                '0.id' => $book->id,
                '0.title' => $book->title,
                '0.isbn' => $book->isbn
            ]);

        });


    }


}
