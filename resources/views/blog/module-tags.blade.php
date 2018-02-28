
<div class="row">
    <div class="col">
        <div class="module-area">
            <h4>タグ</h4>
            <ul>
                @foreach(\App\Models\Tag::orderBy('path')->get() as $tag)
                    <li>
                        <a href="{{ route('blog', ['tag' => $tag->id]) }}">
                            {{ $tag->path ?? '-' }}
                        </a> ({{ optional($tag->articles)->count() }})
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>