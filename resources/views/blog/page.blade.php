@extends('layouts.blog')
@section('title', ($mode === 'list') ? '記事一覧' : (isset($article) ? $article->title : 'No Title'))

@section('container')
    <div class="row">
        <div class="col-xl-8">
            @if($mode === 'list')
                @if(request('tag') or request('search'))
                    @include('blog.module-alert')
                @endif
                @include('blog.module-list')
            @elseif($mode === 'show')
                @include('blog.module-article')
            @endif
        </div>

        <div class="col-xl-4">
            @include('blog.module-webmaster')
            @include('blog.module-latest')
            @include('blog.module-tags')
        </div>
    </div>

    <div class="row">
        <div class="col">
            <hr>
            <footer>
                COPYRIGHT &#169; 2018 mabasasi.net ALL RIGHTS RESERVED. <br>
                このページは自動生成されています.
                @guest
                    &nbsp;&nbsp;<a href="{{ route('login') }}">管理者</a>はこちら.
                @endcan
            </footer>
        </div>
    </div>
@endsection