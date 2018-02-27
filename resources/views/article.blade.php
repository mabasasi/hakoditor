@extends('layouts.hakoditor')
@section('title', $article->title)

@section('container')

    <h1>{{ $article->title ?? 'No Title' }}</h1>

    {!! $article->content !!}

@endsection