<x-base-layout>
    <x-slot name="title">詳細</x-slot>
    <x-slot name="css">
        <style>
            .card-img-top {
                height: 35%;
                width: 35%;
                object-fit: cover;
                object-position: center;
            }
        </style>
    </x-slot>
    <x-slot name="main">
        <div class="container mt-5">
            <h1 class="text-center mb-5">本の詳細</h1>
            <img class="card-img-top mx-auto mb-3" src="{{ asset('storage/' . $book->image_path) }}" alt="Book Image">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-3">詳細</h2>
                    <h5 class="card-text mb-2">書籍名： {{ $book->title }}</h5>
                    <h5 class="card-text mb-2">作者名： {{ $book->sakusya }}</h5>
                    <h5 class="card-text mb-2">読書終了日： {{ $book->readend }}</h5>
                    <!--reviewがない時とある時の条件分岐-->
                    @if ($reviews->isEmpty())
                        <h2 class="mt-4 mb-3">感想</h2>
                        <h5 class="card-title mb-2">点数：</h5>
                        <p class="card-text">この本にはまだレビューがありません。</p>
                    @else
                        @foreach ($reviews as $review)
                            <h2 class="mt-4 mb-3">感想</h2>
                            <h5 class="card-title mb-2">点数： {{ $review->score }}</h5>
                            <p class="card-text">{{ $review->review }}</p>

                            {{-- 編集・削除ボタン データ登録したユーザーのみ表示するボタン --}}
                            @if (Auth::id() == $review->u_id)
                            <a href="{{ route('revbiew.edit', $review->id) }}" class="btn btn-primary">編集</a>
                            <form method="POST" action="{{ route('review.destroy', ['review' => $review->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                            @endif
                        @endforeach

                    @endif

                </div>
            </div>




        </div>
    </x-slot>
    <x-slot name="script">

    </x-slot>
</x-base-layout>
