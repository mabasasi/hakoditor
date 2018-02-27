
@foreach($articles as $article)
    <div class="row">
        <div class="col">

            <a href="{{ route('blog.view', ['name' => $article->url ?? $article->id]) }}" class="article-caption" style="background-color: whitesmoke;">

                {{ $article->title }}

                <span>
                    <i class="far fa-clock"></i> {{ optional($article->created_at)->toDateString() }}
                </span>
                <span>
                    <i class="fas fa-wrench"></i> {{ optional($article->updated_at)->toDateString() }}
                </span>
            </a>

        </div>
    </div>
@endforeach