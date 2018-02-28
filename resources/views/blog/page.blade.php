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

    <div class="row">
        <div class="col">
            <hr>
            <footer>
                COPYRIGHT &#169; 2018 mabasasi.net ALL RIGHTS RESERVED. <br>
                このページは自動生成されています.
            </footer>
        </div>
    </div>
@endsection