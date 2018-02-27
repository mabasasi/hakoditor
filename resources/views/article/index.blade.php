@extends('layouts.hakoditor')

@section('container-fluid')
    <div class="row">
        <div class="col">
            @component('parts.general-card-component')
                <a href="{{ route('articles.create') }}" class="btn btn-warning" role="button" aria-pressed="true">
                    <i class="fas fa-plus-square"></i> 新規作成
                </a>
            @endcomponent
        </div>
    </div>


    <div class="row">
        <div class="col">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>タイトル</th>
                    <th>url</th>
                    <th>変換方法</th>
                    <th>公開</th>
                    <th>はこ数</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($articles as $article)
                    <tr>
                        <th>{{ $article->id }}</th>
                        <td>{{ $article->title ?? '-' }}</td>
                        <td>
                            <a href="{{ route('view', ['name' => $article->url ?? $article->id]) }}" class="btn btn-tr btn-info" role="button" aria-pressed="true">
                                <i class="fas fa-window-maximize"></i> {{ $article->url ?? $article->id }}
                            </a>
                        </td>
                        <td>{{ optional($article->articleType)->name ?? '-' }}</td>
                        <td>{!! $article->is_public ? '<i class="fas fa-check"></i>' : '-' !!}</td>
                        <td>{{ $article->hakos->count() }}</td>
                        <td>
                            <a href="{{ route('articles.show', ['article' => $article->id]) }}" class="btn btn-tr btn-success" role="button" aria-pressed="true">
                                <i class="fas fa-newspaper"></i> 記事編集
                            </a>
                            <a href="{{ route('articles.edit', ['article' => $article->id]) }}" class="btn btn-tr btn-outline-success" role="button" aria-pressed="true">
                                <i class="fas fa-edit"></i> 情報編集
                            </a>
                            <a href="{{ route('articles.destroy', ['article' => $article->id]) }}" class="btn btn-tr btn-danger" role="button" aria-pressed="true">
                                <i class="fas fa-trash"></i> 削除
                            </a>
                        </td>
                    </tr>
                @empty
                    <p>No Data.</p>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection