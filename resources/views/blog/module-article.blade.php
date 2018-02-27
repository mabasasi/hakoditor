
<div class="row">
    <div class="col">

        <article>

            <div id="time-badges">
                <span>
                    <i class="far fa-clock"></i> {{ optional($article->created_at)->toDateString() }}
                </span>
                <span>
                    <i class="fas fa-wrench"></i> {{ optional($article->updated_at)->toDateString() }}
                </span>
            </div>

            <h1>{{ $article->title ?? 'No Title.' }}</h1>

            <div id="article-buttons">
                <a href="" class="btn btn-sm btn-outline-secondary">たぐ1</a>
                <a href="" class="btn btn-sm btn-outline-secondary">たぐ2</a>
                <a href="" class="btn btn-sm btn-outline-secondary">たぐ3</a>

                <div class="float-right">
                    <a href="{{ route('articles.show', ['name' => $article->id]) }}" class="btn btn-sm btn-outline-success" role="button" aria-pressed="true">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
            </div>

            <hr>

            <div id="content">
                {!! $article->content !!}
            </div>

        </article>

    </div>
</div>