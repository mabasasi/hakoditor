<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('blog') }}">まばさし.net</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        {{--<!-- Left Element -->--}}
        <ul class="navbar-nav mr-auto">
        </ul>

        <!-- Right Element -->
        <ul class="navbar-nav">

            <li class="nav-item">
                {{ Form::open(['method' => 'GET', 'url' => route('blog'), 'class' => 'form-inline']) }}

                <div class="form-group row">
                    {{ Form::text('search', old('search'), ['class' => 'form-control mr-sm-2', 'placeholder' => 'Search...']) }}
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索</button>
                </div>

                {{ Form::close() }}
            </li>

            <span class="mr-3"></span>

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">管理者</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ optional(\Auth::user())->name }}&nbsp;さん
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('blog') }}">ブログトップ</a>
                        <a class="dropdown-item" href="{{ route('articles.index') }}">記事管理</a>
                        <a class="dropdown-item" href="{{ route('tags.index') }}">タグ管理</a>
                        <a class="dropdown-item" href="{{ route('register') }}">新規登録</a>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            @endcan

            <span class="mr-3"></span>

        </ul>
    </div>
</nav>