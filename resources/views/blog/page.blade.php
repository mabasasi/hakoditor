@extends('layouts.blog')
@section('title', $article->title)

@section('container')
    <div class="row">
        <div class="col-xl-8">
            @include('blog.module-article')
        </div>

        <div class="col-xl-4">
            @include('blog.module-webmaster')
            @include('blog.module-webmaster')
        </div>
    </div>
@endsection