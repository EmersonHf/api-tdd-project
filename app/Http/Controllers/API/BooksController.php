<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BooksRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function __construct(private Book $book){

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Book $book)
    {

     return response()->json($book->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BooksRequest $request)
    {
      $book = $this->book->create($request->all());

      return response()->json($book,201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = $this->book->find($id);
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
       $book = Book::find($id);
       $book->update($request->all());

       return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $book = $this->book->find($id);
      $book->delete();

      return response()->json([],204);

    }
}
