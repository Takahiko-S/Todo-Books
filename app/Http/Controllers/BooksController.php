<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

        return view('contents.books',['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = new Book(); // 新しい Book モデルのインスタンスを作成

        $book->title = $request->title;
        $book->sakusya = $request->sakusya;
        $book->readend = $request->date;
        $book->image = $request->imagePath;

        $book->save();

        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $book = Book::findOrFail($id);
        $reviews = Review::where('book_id', $id)->get();
        return view('contents.review',compact('book','reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
