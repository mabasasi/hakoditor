@extends('layouts.blog')
@section('title', '記事一覧')

@section('container')
    <div class="row">
        <div class="col-xl-8">
            @if(request('tag'))
                @include('blog.module-alert')
            @endif

            @include('blog.module-list')
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
                COPYRIGHT &#169; 2018 mabasasi.net ALL RIGHTS RESERVED.
                このページは自動生成されています.
            </footer>
        </div>
    </div>
@endsection