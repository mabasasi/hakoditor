
@foreach($articles as $article)
    <div class="row">
        <div class="col">

            <a href="{{ route('blog.view', ['name' => $article->url ?? $article->id]) }}" class="article-caption" style="background-color: whitesmoke;">

                <div>
                    <h3>{{ $article->title }}</h3>

                    <div class="float-right">
                        <span>
                            <i class="far fa-clock"></i> {{ optional($article->created_at)->toDateString() }}
                        </span>
                        @if($article->is_update)
                            <span>
                                <i class="fas fa-wrench"></i> {{ optional($article->updated_at)->toDateString() }}
                            </span>
                        @endif
                    </div>
                </div>


                <div>
                    タグ：{{ $article->hasManyImplode('tags', 'name', ', ') ?? '-' }}
                </div>
            </a>

        </div>
    </div>

    <hr>
@endforeach

{{ $articles->appends(Request::query())->links() }}