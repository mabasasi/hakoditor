@extends('layouts.hakoditor')
@section('title', $article->title)

@section('container')

    <h1>{{ $article->title ?? 'No Title' }}</h1>

    {!! nl2br($article->html_content) !!}

    <hr>

    @component('parts.general-card-component', ['class' => 'bg-light'])
        {!! json_encode($article->toArray(), JSON_UNESCAPED_UNICODE) !!}
    @endcomponent

@endsection