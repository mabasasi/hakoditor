
<div class="row">
    <div class="col">

        <div id="alerts" class="module-area">
            @if(request('tag'))
                @php($tag = \App\Models\Tag::find(request('tag')))
                タグ：{{ ($tag) ? ($tag->path ?? $tag->name) : '-' }}
            @endif

            <div class="float-right">
                <a href="{{ route('blog') }}" class="btn btn-outline-light btn-close">
                    <i class="far fa-times-circle"></i>
                </a>
            </div>
        </div>

    </div>
</div>