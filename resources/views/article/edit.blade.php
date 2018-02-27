@extends('layouts.hakoditor')
@section('title', '記事編集')

@section('container')

    @component('parts.general-card-component')
        @slot('header')
            記事編集
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

            @component('parts.inline-form-component', ['name' => 'article_type_id', 'label' => '変換方法'])
                {{ Form::select('article_type_id', \App\Models\ArticleType::selectPluck(true),
                    old('article_type_id', $article->article_type_id), ['class' => 'form-control']) }}
            @endcomponent

            @component('parts.inline-form-component', ['name' => 'is_public', 'label' => '公開する'])
                {{ Form::hidden('is_public', '0') }}
                {{ Form::checkbox('is_public', '1', old('is_public', $article->is_public), ['class' => 'form-control']) }}
            @endcomponent

            @component('parts.group-form-component')
                {{ Form::submit('保存', ['class' => 'btn btn-primary']) }}
            @endcomponent

        {{ Form::close() }}
    @endcomponent

@endsection