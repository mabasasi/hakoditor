@extends('layouts.blog')
@section('title', '記事一覧')

@section('container')
    <div class="row">
        <div class="col-xl-8">
            @include('blog.module-list')
        </div>

        <div class="col-xl-4">
            @include('blog.module-webmaster')
            @include('blog.module-webmaster')
        </div>
    </div>
@endsection