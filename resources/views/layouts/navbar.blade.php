<nav class="navbar navbar-expand-lg navbar-light fixed-top">
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

            @auth
                <li class="nav-item mr-4">
                    <a class="nav-link" href="{{ route('blog.view', ['name' => 'todo']) }}">TODO</a>
                </li>
            @endauth

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
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ optional(\Auth::user())->name }}&nbsp;さん
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('blog') }}">
                            &nbsp;&nbsp;&nbsp;&nbsp; ブログ
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('articles.index') }}">
                            <i class="far fa-newspaper"></i> 記事管理
                        </a>
                        <a class="dropdown-item" href="{{ route('tags.index') }}">
                            <i class="fas fa-tags"></i> タグ管理
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('register') }}">
                            &nbsp;&nbsp;&nbsp;&nbsp; 新規登録
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> ログアウト
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