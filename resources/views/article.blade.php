@extends('layouts.hakoditor')
@section('title', $article->title)

@section('container')

    <h1>{{ $article->title ?? 'No Title' }}</h1>

    {!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($article->html_content) !!}

@endsection