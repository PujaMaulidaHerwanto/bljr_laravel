@extends('layouts.main')
@section('container')
  
    <h1>Tentang Saya</h1>
    <ul>
        <li> {{ $name }} </li>
        <li> {{ $email }} </li>
        <img src="img/{{ $image }}" alt="{{ $name }}" width="300">
    </ul>

@endsection