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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $review->id }}">
                                    編集
                                </button>

                                <button type="submit" class="btn btn-danger ms-5" data-bs-toggle="modal"
                                    data-bs-target="#deletemodal{{ $review->id }}">
                                    削除
                                </button>

                                <!---------------------------------------- 編集モーダル ---------------------------------------------->
                                <div class="modal fade" id="editModal{{ $review->id }}" tabindex="-1"
                                    aria-labelledby="editModal{{ $review->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModal{{ $review->id }}Label">Modal
                                                    title </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('books.update', $book->id) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">書籍名</label>
                                                        <input type="text" class="form-control" id="title"
                                                            name="title" value="{{ $book->title }} "required>
                                                        @error('title')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sakusya" class="form-label">作者名</label>
                                                        <input type="text" class="form-control" id="sakusya"
                                                            name="sakusya" value="{{ $book->sakusya }}"required>
                                                        @error('sakusya')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="readend" class="form-label">読書終了日</label>
                                                        <input type="text" class="form-control" id="readend"
                                                            name="readend" value="{{ $book->readend }}">
                                                        @error('readend')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="score" class="form-label">点数</label>
                                                        <input type="text" class="form-control" id="score"
                                                            name="score" value="{{ $review->score }}">
                                                        @error('score')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="review" class="form-label">感想</label>
                                                        <textarea class="form-control" id="review" name="review" rows="5" cols="50">{{ $review->review }}</textarea>
                                                    </div>
                                                    @error('review')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror


                                                    <button type="button" class="btn btn-secondary mt-5"
                                                        data-bs-dismiss="modal">閉じる</button>
                                                    <button type="submit" class="btn btn-primary mt-5">保存</button>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!---------------------------------------- 削除モーダル ---------------------------------------------->


                                <!-- Modal -->
                                <div class="modal fade" id="deletemodal{{ $review->id }}" tabindex="-1"
                                    aria-labelledby="deletemodal{{ $review->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deletemodal{{ $review->id }}Label">削除確認
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <p>本当に削除しますか？</p>
                                                <form method="post"
                                                    action="{{ route('books.destroy', $book->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">キャンセル</button>
                                                    <button type="submit" class="btn btn-primary">削除</button>
                                                </form>

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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if ($errors->any())
                    // ここでモーダルを表示する
                    $('#editModal{{ $review->id }}').modal('show');
                @endif
            });
        </script>
    </x-slot>
</x-base-layout>
