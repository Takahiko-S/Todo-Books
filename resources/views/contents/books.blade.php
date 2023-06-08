<x-base-layout>
<x-slot name="title">読書リスト</x-slot>
<x-slot name="main">
    <div class="container mt-5">
    <h1 class="text-center mb-5">各ユーザー名表示させるの読書リスト</h1>
    <div class="row">
        @foreach ($books as $book)
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="" class="card-img-top" alt="Book Image">
          <div class="card-body">
            <h5 class="card-title">{{ $book->title}}</h5>
            <p class="card-text">{{$book->sakusya}}</p>
           @if($book->readend && $book->readend>now())
           <p>日付が間違っています</p>
           @else
           <p>読書済み</p>
           @endif
           <a href="{{ route('books.show', ['book' => $book->id]) }}" class="btn btn-primary mt-3">詳細を見る</a>

          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</x-slot>
<x-slot name="script">

</x-slot>


</x-base-layout>
