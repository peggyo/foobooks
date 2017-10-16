
@extends('layouts.master')


@section('title')
    All books
@endsection

<!-- Removed push of css file, not needed here -->

@section('content')
    <h1>All Books</h1>

    <!-- <?php dump($books); ?> -->

    @foreach ($books as $title => $book)
        <div class='book'>
            <h2>{{ $title }} </h2>
            Authored by: {{ $book['author'] }}
        </div>
    @endforeach
@endsection

<!-- Removed push of js file, not needed here -->
