@extends('layouts.hakoditor')
@section('title', $article->title)

@section('container')

    <div class="row">
        <div class="col">

            <div class="alert alert-info mt-2" role="alert">
                <ul>
                    <li>編集したい はこ をクリック!</li>
                    <li>[Alt + Enter]で確定</li>
                    <li>[ダブルクリック]で新しい はこ を作成</li>
                </ul>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col">

            <h1>{{ $article->title ?? 'No Title' }}</h1>

            {{--各 はこ の配置--}}
            @foreach($article->hakos as $hako)
                {{-- TODO ここを変更する際は、script も忘れずに変更するべし--}}

                {{--@component('parts.general-card-component', ['class' => 'bg-light'])--}}
                {{--<div class="hako" data-content="{{ $hako->content }}">--}}
                {{--{{ $hako->content }}--}}
                {{--</div>--}}
                {{--@endcomponent--}}

                <div class="card margin bg-light">
                    <div class="card-body">
                        <div class="hako" data-id="{{ $hako->id }}" data-content="{{ $hako->content }}">
                            {{ $hako->content }}
                        </div>
                    </div>
                </div>
            @endforeach


            {{--最下部要素--}}
            <div id="dummy-last"></div>

            {{ Form::open(['id' => 'handling', 'method' => 'post', 'url' => route('articles.handling', ['article'=> $article->id])]) }}
            {{ Form::button('保存', ['id' => 'exec', 'class' => 'btn btn-primary']) }}
            {{ Form::close() }}
            {{--<hr>--}}

            {{--@component('parts.general-card-component', ['class' => 'bg-light'])--}}
                {{--{!! json_encode($article->toArray(), JSON_UNESCAPED_UNICODE) !!}--}}
            {{--@endcomponent--}}

        </div>
    </div>

@endsection


@push('scripts')
<script>
    $(function() {
        // card -> card-body -> hako

        // submit
        $(document).on('click', '#exec', function() {
            var form = $('form#handling');

            // 各種オブジェクトから値を抜き取ってフォームを作成する
            var doms = $('.hako');
            var cnt = 1;
            doms.each(function(i, html) {
                var dom = $(html);
                var id       = dom.data('id') || 0;
                var content  = dom.data('content') || '';
                var priority = cnt ++;

                form.append('<input type="hidden" name="id['+i+']" value="'+id+'">');
                form.append('<input type="hidden" name="content['+i+']" value="'+content+'">');
                form.append('<input type="hidden" name="priority['+i+']" value="'+priority+'">');
            });

            form.submit();
        });




        // はこ -> エディタ
        $(document).on('click', '.hako', function() {
            openEditor($(this));
        });



        // エディタ -> はこ
        $(document).on('change focusout', '.hako-edit', function() {
            closeEditor($(this));
        });

        // 全 はこ を閉じる or submit
        $(window).keydown(function(event) {
            if(event.altKey) {
                if(event.keyCode === 13) {
                    console.log('alt enter');

                    var doms = $('.hako-edit');
                    doms.each(function(i, dom) {
                        closeEditor($(dom));
                    });

                    if (doms.length === 0) {
                        $('#exec').click();
                    }

                    return false;
                }
            }
        });

        // 新規 はこ 作成
        $(document).on('dblclick', function(event) {
            console.log('create');

            // 座標取得
            var y = event.pageY;
            console.log('>> '+y);

            // 各オブジェクトの左上座標を取得する
            var doms = $('.hako');
            console.log(doms.length);
            for (var i=0; i<doms.length; i++) {
                // 左上座標の取得
                var dom   = $(doms[i]);
                var divy  = dom.offset().top;

                // 左上座標を超えたら、その要素の上に挿入する
                console.log(i+' => '+divy+' > '+ y);
                if (divy > y) {
                    var wrap = dom.parents('.card');
                    createEditor(wrap);
                    return;
                }
            }

            // もし、どれにも該当しない場合、最下部に挿入する
            console.log('last');
            createEditor($('#dummy-last'));
        });









        var createEditor = function(dom) {
            console.log('create');

            var new_html = '<div class="card margin bg-light"><div class="card-body"><div class="hako"></div></div></div>';
            var new_dom  = $(new_html);

            dom.before(new_dom);
            dom.ready(function() {
                var choose_dom = new_dom.find('.hako');
                openEditor(choose_dom);
            });
        };


        var openEditor = function(dom) {
            console.log('open');

            // 前処理
            var text = dom.data('content');

            // dom 作成
            var html = '<textarea class="form-control" rows="5"></textarea>';

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


            // dom 追加
            dom.empty().append(text);

            // 後処理
            dom.attr('class', 'hako');
            dom.data('content', text);

            console.log('close');
        };

    });
</script>
@endpush