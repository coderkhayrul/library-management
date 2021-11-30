<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCategoryStore;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('book_category.index');
    }

    public function allBookCategory()
    {
        $data = BookCategory::orderBy('id', 'DESC')->get();
        return response()->json($data);
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
    public function store(BookCategoryStore $request)
    {
        $data = BookCategory::insert([
            'name' => $request->name
        ]);
        return response()->json([
            'status' => 200,
            'message' => "Category Create Successfully",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookCategory  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BookCategory $bookCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookCategory  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BookCategory $bookCategory, $id)
    {
        $data = BookCategory::findOrFail($id);
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookCategory  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function update(BookCategoryStore $request, BookCategory $bookCategory, $id)
    {
        $bookCategory = BookCategory::findOrFail($id);
        $bookCategory->name = $request->name;
        $bookCategory->update();

        return response()->json([
            'status' => 200,
            'message' => "Book Category updated successfully",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookCategory  $bookCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookCategory $bookCategory, $id)
    {
        $category = BookCategory::findOrFail($id);
        $category->delete();
        return response()->json([
            'status' => 200,
            'message' => "Book Category deleted successfully",
        ]);
    }
}
