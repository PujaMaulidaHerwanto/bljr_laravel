@extends('layouts.main')
@section('container')


    <h1 style="mb-5">Post Category : {{ $category }}</h1>

    @foreach ($posts as $post)
        <article>
            <h2>
                <a href="/posts/{{ $post->slug }}"> {{ $post->title }} </a>
            </h2>
            <p>{{ $post->excerpt }}</p>
        </article>
    @endforeach

    <a href="/categories"> Back To Categories </a>

@endsection
