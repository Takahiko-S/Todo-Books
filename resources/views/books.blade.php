<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>読書リスト</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h1 class="text-center mb-5">My 読書リスト</h1>
    <div class="row">
        @foreach ($books as $book)
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="本の画像URL" class="card-img-top" alt="Book Image">
          <div class="card-body">
            <h5 class="card-title">{{ $book->title}}</h5>
            <p class="card-text">{{$book->sakusya}}</p>
           @if($book->readend && $book->readend>now())
           <p>日付が間違っています</p>
           @else
           <p>読書済み</p>
           @endif
            <a href="/books{{ $book->id }}reviews" class="btn btn-primary mt-3">詳細を見る</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
