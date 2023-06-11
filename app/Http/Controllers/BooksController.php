<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $book->u_id = Auth::user()->id;
        $book->title = $request->title;
        $book->sakusya = $request->sakusya;
        $book->readend = $request->date;


        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            //dd($path);
            $book->image_path = $path;
        }
        $book->save();


        $review = new Review();
        $review->u_id = $book->u_id;
        $review->book_id = $book->id;
        $review->score = $request->socore;
        $review->review = $request->review;
        $review->save();

        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)//$id=booksテーブルのid
    {
        $u_id = Auth::user()->id;
        $book = Book::findOrFail($id);//findorfailはBookに指定のidがない場合404を返す
        $reviews = Review::where('book_id', $id)->get();//Reviewモデルからbook_idが$idとお同じものを取得
        return view('contents.review',compact('book','reviews','u_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //edit.blade.phpを表示する

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
