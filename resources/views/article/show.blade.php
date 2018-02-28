@extends('layouts.hakoditor')
@section('title', $article->title)

@php($container = request('extend') ? 'container-fluid' : 'container')
@section($container)

    <div class="row">
        <div class="col">

            @component('parts.general-card-component')
                {{ Form::open(['id' => 'handling', 'method' => 'post', 'url' => route('articles.handling', ['article'=> $article->id])]) }}

                <button id="exec" class="btn btn-primary" type="button">
                    <i class="far fa-save"></i> 保存
                </button>

                <button id="new-hako" class="btn btn-outline-primary" type="button">
                    <i class="fas fa-archive"></i> 新しい はこ
                </button>

                <div class="float-right">
                    <a href="{{ route('articles.show', ['article' => $article->id, 'extend' => request('extend') xor true]) }}" class="btn btn-outline-dark mr-3" area-pressed="true">
                        {{ request('extend') ? 'プレビュー無効化' : 'プレビュー有効化' }}
                    </a>

                    <a href="{{ route('articles.edit', ['article' => $article->id]) }}" class="btn btn-outline-success" role="button" aria-pressed="true">
                        <i class="fas fa-edit"></i> 情報編集
                    </a>

                    <a href="{{ route('blog.view', ['name' => $article->url ?? $article->id]) }}" class="btn btn-info" role="button" aria-pressed="true">
                        <i class="fas fa-window-maximize"></i> 表示
                    </a>

                    <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<ul><li>クリックで編集</li><li>[Alt + Enter]で新たな はこ の作成</li><li>ドラッグで並び替え</li><li>[Ctrl + S]で保存</li><ul>">
                        <i class="fas fa-question-circle"></i>
                    </button>
                </div>

                {{ Form::close() }}
            @endcomponent

            <h1>{{ $article->title ?? 'No Title' }}</h1>

            <hr>
        </div>
    </div>


    <div class="row">
        <div class="{{ request('extend') ? 'col-6' : 'col' }}">

            {{--アラートがあれば表示--}}
            @if(\Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endisset

            <div class="hako-area">
                {{--各 はこ の配置--}}
                @foreach(optional($article->hakos)->sortBy('params.order') as $hako)
                    {{-- TODO ここを変更する際は、script も忘れずに変更するべし--}}

                    <div class="card margin bg-light block">
                        <div class="card-body">
                            <div class="hako" data-id="{{ $hako->id }}" data-content="{{ $hako->content }}">
                                {!! nl2br($hako->content) !!}
                            </div>
                        </div>
                    </div>
                @endforeach


                {{--最下部要素--}}
                <div id="dummy-last"></div>
            </div>
        </div>

        @if(request('extend'))
            <div class="col-6">
                @include('blog.module-article', ['article' => $article])
            </div>
        @endif
    </div>

@endsection


@push('scripts')
<script>
    $(function() {
        // card -> card-body -> hako




        // アラート閉じる
        setTimeout(function() {
            $(".alert").slideUp(function(dom) {
                dom.alert('close');
            });
        }, 3000);









        $('.hako-area').sortable();

        // submit
        $(document).on('click', '#exec', function() {
            var form = $('form#handling');

            // 先に、すべてのブロックを閉じておく
            $('.hako-edit').each(function(i, html) {
                closeEditor($(html));
            });

            // 各種オブジェクトから値を抜き取ってフォームを作成する
            var doms = $('.hako');
            var cnt = 1;
            doms.each(function(i, html) {
                var dom = $(html);
                var id      = dom.data('id') || 0;
                var content = dom.data('content') || '';
                var order   = cnt ++;

                form.append('<input type="hidden" name="id['+i+']" value="'+id+'">');
                form.append('<input type="hidden" name="content['+i+']" value="'+content+'">');
                form.append('<input type="hidden" name="order['+i+']" value="'+order+'">');
            });

            form.submit();
        });


        // キー選択
        $(window).keydown(function(event) {
            // ctrl + s で 保存
            if (event.ctrlKey) {
                if (event.keyCode === 83) {
                    console.log('save');
                    $('#exec').click();

                    return false;
                }
            }

            // alt + enter で 確定 and 新規作成
            if (event.altKey) {
                if (event.keyCode === 13) {
                    console.log('new');
                    autoSwitchCreateEditor();
                    return false;
                }
            }
        });






        // 箱生成
        $(document).on('click', '#new-hako', function() {
            autoSwitchCreateEditor();
        });



        // ブロック選択で、エディットモードへ
        $(document).on('click', '.block', function() {
            var hako = $(this).find('.hako');
            openEditor($(hako));
        });




        // 新規 はこ 作成
        // $(document).on('dblclick', function(event) {
        //     console.log('create');
        //
        //     // 座標取得
        //     var y = event.pageY;
        //     console.log('>> '+y);
        //
        //     // 各オブジェクトの左上座標を取得する
        //     var doms = $('.block');
        //     console.log(doms.length);
        //     for (var i=0; i<doms.length; i++) {
        //         // 左上座標の取得
        //         var dom   = $(doms[i]);
        //         var divy  = dom.offset().top;
        //
        //         // 左上座標を超えたら、その要素の上に挿入する
        //         console.log(i+' => '+divy+' > '+ y);
        //         if (divy > y) {
        //             createEditor(dom);
        //             return;
        //         }
        //     }
        //
        //     // もし、どれにも該当しない場合、最下部に挿入する
        //     console.log('last');
        //     createEditor($('#dummy-last'));
        // });
        //
        //
        //




        var autoSwitchCreateEditor = function() {
            var focused = $(':focus');

            if (focused.is('input, textarea, [contenteditable=true]')) {
                // テキストエリアを選択しているならば、自身の下に
                var wrap = focused.parents('.block');
                createEditor(wrap, true);

            } else {
                // それ以外は最下部に
                createEditor($('#dummy-last'));
            }
        };



        var createEditor = function(dom, is_after) {
            console.log('create');

            var new_html = '<div class="card margin bg-light"><div class="card-body"><div class="hako"></div></div></div>';
            var new_dom  = $(new_html);

            if (is_after) {
                dom.after(new_dom);
            } else {
                dom.before(new_dom);
            }

            new_dom.ready(function() {
                var choose_dom = new_dom.find('.hako');
                openEditor(choose_dom);
            });
        };


        var openEditor = function(dom) {
            console.log('open');

            // 前処理
            var text = dom.data('content');

            // dom 作成
            var row = $.str_count(text, /[\n\r]/g) + 5;
            var html = '<textarea class="form-control" rows="'+row+'"></textarea>';

            // dom メタ変更
            var textarea = $(html);
            dom.empty().append(textarea);
            textarea.focus().val(text);     // キャレットの位置を末尾にするため

            // 後処理
            dom.attr('class', 'hako-edit');
        };

        var closeEditor = function(dom) {

            // 前処理
            var text = dom.find('textarea').val();

            // もし、空なら要素を削除する
            if (text.length === 0) {
                console.log('remove');
                dom.parents('.card').remove();
                return;
            }

            // dom 作成
            var html = $.nl2br(text);

            // dom 追加
            var div = dom.empty().append(html);

            // 後処理
            dom.attr('class', 'hako');
            dom.data('content', text);

            console.log('close');
        };

    });
</script>
@endpush