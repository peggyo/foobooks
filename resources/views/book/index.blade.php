
@extends('layouts.master')


@push('head')
    <link href='/css/book.css' rel='stylesheet'>
@endpush

@section('title')
    All books
@endsection

@section('content')
    <h1>All Books</h1>

    <!-- <?php dump($books); ?> -->

    @foreach ($books as $book)
    <div class='book cf'>
        <img src='{{ $book['cover'] }}' class='cover' alt='Cover image for {{ $book['title'] }}'>
        <h2>{{ $book['title'] }}</h2>
        <p>By {{ $book['author'] }}</p>
        <a href='/book/{{ ($book['id']) }}'> View </a>|
        <a href='/book/{{ $book['id'] }}/edit'> Edit </a>|
        <a href='/book/{{ $book['id'] }}/delete'> Delete</a>
    </div>
    @endforeach


@endsection

<!-- Removed push of js file, not needed here -->
