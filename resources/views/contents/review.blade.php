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

                            <h5 class="card-title mb-2">点数： {{ $review->score }}</h5>
                            <h5 class="card-title my-2">感想</h5>
                            <h5 class="card-text mb-5">{{ $review->review }}</h5>

                            {{-- 編集・削除ボタン データ登録したユーザーのみ表示するボタン --}}
                            @if (Auth::id() == $review->u_id)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $review->id }}">
                                    編集
                                </button>

                                <button type="button" class="btn btn-danger ms-5" data-bs-toggle="modal"  data-bs-target="#deletemodal{{ $review->id }}">
                                    削除
                                </button>
                            <div class="modal fade" id="editModal{{ $review->id }}" tabindex="-1"
                                aria-labelledby="editModal{{ $review->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModal{{ $review->id }}Label">Modal title </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @endif

                </div>
            </div>
        </div>

    </x-slot>
    <x-slot name="script">
        <script></script>
    </x-slot>
</x-base-layout>
