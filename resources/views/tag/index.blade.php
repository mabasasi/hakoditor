@extends('layouts.hakoditor')
@section('title', 'タグ管理')

@section('container-fluid')
    <div class="row">
        <div class="col">
            @component('parts.general-card-component')
                <a href="{{ route('tags.create') }}" class="btn btn-dark" role="button" aria-pressed="true">
                    <i class="fas fa-plus-square"></i> 新規作成
                </a>

                <a class="btn btn-outline-dark" href="{{ route('tags.cache') }}" onclick="event.preventDefault(); document.getElementById('tag-cache').submit();">
                    キャッシュ作成
                </a>
                <form id="tag-cache" action="{{ route('tags.cache') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endcomponent
        </div>
    </div>


    <div class="row">
        <div class="col">

            @component('parts.general-card-component', ['expand' => 'true'])
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>タグ名</th>
                        <th>親のタグID</th>
                        <th>パス</th>
                        <th>ネスト</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tags as $tag)
                        <tr>
                            <th>{{ $tag->id }}</th>
                            <td>{{ $tag->name ?? '-' }}</td>
                            <td>{{ $tag->parent_tag_id ?? '-' }}</td>
                            <td>{{ $tag->path ?? '-' }}</td>
                            <td>{{ $tag->depth ?? '-' }}</td>
                            <td>
                                <a href="{{ route('tags.edit', ['tag' => $tag->id]) }}" class="btn btn-tr btn-success" role="button" aria-pressed="true">
                                    <i class="fas fa-edit"></i> 編集
                                </a>
                                <a href="{{ route('tags.destroy', ['tag' => $tag->id]) }}" class="btn btn-tr btn-danger" role="button" aria-pressed="true">
                                    <i class="fas fa-trash"></i> 削除
                                </a>
                            </td>
                        </tr>
                    @empty
                        <p>No Data.</p>
                    @endforelse
                    </tbody>
                </table>
            @endcomponent

        </div>
    </div>
@endsection