@extends('layouts.hakoditor')

@section('container-fluid')
    <div class="row">
        <div class="col">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>タイトル</th>
                    <th>url</th>
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
                            <a href="{{ route('view', ['name' => $article->url ?? $article->id]) }}">
                                {{ $article->url ?? $article->id }}
                            </a>
                        </td>
                        <td>{{ $article->hakos->count() }}</td>
                        <td></td>
                    </tr>
                @empty
                    <p>No Data.</p>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection