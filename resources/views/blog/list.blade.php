@extends('layouts.blog')
@section('title', '記事一覧')

@section('container')
    <div class="row">
        <div class="col-xl-8" style="background-color: gray;">
            @include('blog.module-list')
        </div>

        <div class="col-xl-4" style="background-color: lavenderblush;">
            @include('blog.module-webmaster')

            <hr>
            その他いろいろ...
        </div>
    </div>
@endsection