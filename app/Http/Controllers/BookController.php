<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookCategories = DB::table('book_categories')->orderBy('id', 'DESC')->get();
        return view('book.index', compact('bookCategories'));
    }
    public function allBook()
    {
        $books = Book::get();
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $data = Book::insert([
            'name' => $request->name,
            'author_name' => $request->author_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => 1
        ]);
        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => "Book created successfully"
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => "Book Create Failed"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return response()->json([
            'status' => 200,
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookStoreRequest $request, $id)
    {
        $book = Book::find($id);
        $book->name = $request->name;
        $book->author_name = $request->author_name;
        $book->category_id = $request->category_id;
        $book->description = $request->description;
        $book->update();
        return response()->json([
            'status' => 200,
            'message' => 'Book Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
