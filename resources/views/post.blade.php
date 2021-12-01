@extends('layouts.main')
@section('container')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-5">
                <h2>{{ $post->title }}</h2>

                <p>By. <a href="/posts?author={{ $post->author->username }}"> {{ $post->author->name }} </a> in <a href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a></p>

                @if ($post->image)
                    <div style="max-height:400px; overflow:hidden">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid">
                @endif
                
                <article class="my-4 fs-5">
                    {!! $post->body !!}
                </article>

                <a href="/posts" class="d-block my-3"> Back To Posts </a>
        
            </div>
        </div>
    </div>
    
        

        {{-- Kurung kurawal dua itu artinya PHP echo dan udah menggunakan komponen htmlspecialchars makanya kalau ada something html bakal dihilangkan atau ditangguhkan --}}

        {{-- {{ $post->body }} --}}


@endsection