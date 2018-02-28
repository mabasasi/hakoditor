
<div class="row">
    <div class="col">
        <div class="module-area">
            <h4>最新の記事</h4>
            <ul>
                @foreach(\App\Models\Article::latest()->get() as $article)
                    <li>
                        <a href="{{ route('blog.view', ['name' => $article->url ?? $article->id]) }}">
                            {{ $article->title ?? '-' }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>