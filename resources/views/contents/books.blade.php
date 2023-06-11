<x-base-layout>
    <x-slot name="title">読書リスト</x-slot>
    <x-slot name="css">
        <style>

        </style>
        </x-slot>
    <x-slot name="main">
        <div class="container mt-5">
            <h1 class="text-center mb-5">各ユーザー名表示させるの読書リスト</h1>
            <div class="row">
                <div class="col-12 text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookModal">
                        新しい本を追加
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="bookModalLabel">新しい本を追加</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="閉じる"></button>
                                </div>
                                <form action="{{route('books.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <!-- input fields for book title, author, etc. -->
                                        <div class="form-group">
                                            <label for="syoseki" class="form-label">書籍名</label>
                                            <input type="text" id="syoseki"name="title" placeholder="書籍名"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sakusya" class="form-label">作者名</label>
                                            <input type="text" id="sakusya" name="sakusya" placeholder="作者名"
                                                required>

                                        </div>
                                        <div class="form-group">
                                            <label for="date" class="form-label">読書完了日</label>
                                            <input type="date" id="date" name="date" value="2023-11-10"
                                                required>
                                        </div>
                                        <!-- input field for image -->
                                        <input type="file" name="image">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">閉じる</button>
                                        <button type="submit" class="btn btn-primary">保存</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $book->image_path) }}" class="card-img-top" alt="Book Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">{{ $book->sakusya }}</p>
                                @if ($book->readend && $book->readend > now())
                                    <p>読書済み：{{ $book->readend }}</p>
                                @else
                                    <p>未読</p>
                                @endif
                                <a href="{{ route('books.show', ['book' => $book->id]) }}"
                                    class="btn btn-primary mt-3">詳細を見る</a>

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
