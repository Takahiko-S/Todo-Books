<?php

namespace App\Http\Controllers;

use App\Http\Requests\BooksRequest;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Auth::user();
        $books = Book::all();

        return view('contents.books', compact('books', 'users'));
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
    public function store(BooksRequest $request)
    {
        $book = new Book(); // 新しい Book モデルのインスタンスを作成
        $book->u_id = Auth::user()->id;
        $book->title = $request->title;
        $book->sakusya = $request->sakusya;
        $book->readend = $request->readend;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $book->image_path = $path;
        }
        $book->save();

        $review = new Review();
        $review->u_id = $book->u_id;
        $review->book_id = $book->id;
        $review->score = $request->score;
        $review->review = $request->review;
        $review->save();



        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) //$id=booksテーブルのid
    {
        $u_id = Auth::user()->id;
        $book = Book::findOrFail($id); //findorfailはBookに指定のidがない場合404を返す
        $reviews = Review::where('book_id', $id)->get(); //Reviewモデルからbook_idが$idとお同じものを取得
        //dd($reviews);
        return view('contents.review', compact('book', 'reviews', 'u_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BooksRequest $request, $id)
    {


        //本の編集画面
        $book_data = Book::find($id);
        $book_data->title = $request->title;
        $book_data->sakusya = $request->sakusya;
        $book_data->readend = $request->readend;
        $book_data->save();


        $review_data = Review::where('book_id', $id)->first();
        $review_data->score = $request->score;
        $review_data->review = $request->review;
        $review_data->save();

        return redirect(route('books.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Book::find($id);
        $image = $data->image_path;
        Storage::delete("public/" . $image);
        Book::find($id)->delete();
        Review::where('book_id', $id)->delete();
        return redirect(route('books.index'));
    }
}
