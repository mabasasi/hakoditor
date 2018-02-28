@extends('layouts.blog')
@section('title', (isset($article)) ? $article->title : '')

@section('container')
    <div class="row">
        <div class="col-xl-8">
            @if($mode === 'list')
                @include('blog.module-list')
            @elseif($mode === 'show')
                @if(request('tag'))
                    @include('blog.module-alert')
                @endif
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
            </footer>
        </div>
    </div>
@endsection