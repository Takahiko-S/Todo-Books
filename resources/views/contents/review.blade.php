<x-base-layout>
<x-slot name="title">詳細</x-slot>
<x-slot name="main">
<div class="container mt-5">
    <img class="card-img-top mx-auto" src="{{ asset('storage/' . $book->image_path) }}" alt="Book Image" style ="width:70%; height:auto;">
    <div class="card">
        <div class="card-body">
            <h2 class="mb-3">詳細</h2>
            <h5 class="card-text mb-2">書籍名： {{ $book->title }}</h5>
            <h5 class="card-text mb-2">作者名： {{ $book->sakusya }}</h5>
            <h5 class="card-text mb-2">読書終了日： {{ $book->readend }}</h5>
            @if($reviews->isEmpty())
                <h2 class="mt-4 mb-3">感想</h2>
                <h5 class="card-title mb-2">点数：</h5>
                <p class="card-text">この本にはまだレビューがありません。</p>
            @else
            @foreach ($reviews as $review)
                <h2 class="mt-4 mb-3">感想</h2>
                <h5 class="card-title mb-2">点数： {{ $review->score }}</h5>
                <p class="card-text">{{ $review->review }}</p>
            @endforeach
            @endif
        </div>
    </div>




</div>
</x-slot>
<x-slot name="script">

</x-slot>
</x-base-layout>
