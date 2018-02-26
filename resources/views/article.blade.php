@extends('layouts.hakoditor')

@section('content')

    {!! nl2br($article->html_content) !!}

    <hr>

    @component('parts.general-card-component', ['class' => 'bg-light'])
        {!! json_encode($article->toArray(), JSON_UNESCAPED_UNICODE) !!}
    @endcomponent

@endsection