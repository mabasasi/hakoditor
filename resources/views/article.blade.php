@extends('layouts.hakoditor')
@section('title', $article->title)

@section('container')

    <h1>{{ $article->title ?? 'No Title' }}</h1>

    {!! nl2br($article->html_content) !!}

@endsection