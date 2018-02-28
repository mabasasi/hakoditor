@extends('layouts.blog')

@section('container')
    <div class="row">
        <div class="col-xl-8" style="background-color: lightyellow;">
            まばさしのブログ
        </div>

        <div class="col-xl-4" style="background-color: lavenderblush;">
            @include('blog.module-webmaster')

            <hr>
            その他いろいろ...
        </div>
    </div>
@endsection