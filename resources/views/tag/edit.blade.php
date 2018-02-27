@extends('layouts.hakoditor')
@section('title', 'タグ編集')

@section('container')

    @component('parts.general-card-component')
        @slot('header')
            タグ編集
        @endslot

        {{ Form::openResource('tags', $tag->id ?? 0) }}

        {{ Form::hidden('id', $tag->id ?? '0') }}

        @component('parts.inline-form-component', ['name' => 'name', 'label' => 'タグ名'])
            {{ Form::text('name', old('title', $tag->name), ['class' => 'form-control']) }}
        @endcomponent

        @component('parts.inline-form-component', ['name' => 'parent_tag_id', 'label' => '親のタグ'])
            @slot('header')
                <div class="badge badge-info">空白可</div>
            @endslot
            {{ Form::select('parent_tag_id', \App\Models\Tag::selectPluck(true),
                old('parent_tag_id', $tag->parent_tag_id), ['class' => 'form-control']) }}
        @endcomponent

        @component('parts.group-form-component')
            {{ Form::submit('保存', ['class' => 'btn btn-primary']) }}
        @endcomponent

        {{ Form::close() }}
    @endcomponent

@endsection