@extends('layouts.blog')
@section('title', $article->title)

@section('container')
    <div class="row">
        <div class="col-xl-8" style="background-color: lightyellow;">
            @include('blog.module-article')
        </div>

        <div class="col-xl-4" style="background-color: lavenderblush;">
            @include('blog.module-webmaster')

            <hr>
            その他いろいろ...
        </div>
    </div>
@endsection