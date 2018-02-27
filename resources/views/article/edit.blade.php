@extends('layouts.hakoditor')

@section('container')

    @component('parts.general-card-component')
        @slot('header')
            記事情報 編集 or 作成
        @endslot

        {{ Form::openResource('articles', $article->id ?? 0) }}

            {{ Form::hidden('id', $article->id ?? '0') }}

            @component('parts.inline-form-component', ['name' => 'title', 'label' => '記事タイトル'])
                {{ Form::text('title', old('title', $article->title), ['class' => 'form-control']) }}
            @endcomponent

            @component('parts.inline-form-component', ['name' => 'url', 'label' => '記事URL'])
                @slot('header')
                    <div class="badge badge-info">空白可</div>
                @endslot
                {{ Form::text('url', old('url', $article->url), ['class' => 'form-control']) }}
            @endcomponent

            @component('parts.group-form-component')
                {{ Form::submit('保存', ['class' => 'btn btn-primary']) }}
            @endcomponent

        {{ Form::close() }}
    @endcomponent

@endsection