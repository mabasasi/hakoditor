@extends('layouts.hakoditor')

@section('container')

    @component('parts.general-card-component')
        @slot('header')
            ログイン
        @endslot

        {{ Form::open(['method' => 'POST', 'url' => route('register')]) }}

        @component('parts.inline-form-component', ['name' => 'name', 'label' => 'ユーザー名'])
            {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
        @endcomponent

        @component('parts.inline-form-component', ['name' => 'email', 'label' => 'メールアドレス'])
            {{ Form::email('email', old('email'), ['class' => 'form-control']) }}
        @endcomponent

        @component('parts.inline-form-component', ['name' => 'userid', 'label' => 'ユーザー名'])
            @slot('header')
                <div class="badge badge-info">英数字</div>
            @endslot
            {{ Form::text('userid', old('userid'), ['class' => 'form-control']) }}
        @endcomponent

        @component('parts.inline-form-component', ['name' => 'password', 'label' => 'パスワード'])
                @slot('header')
                    <div class="badge badge-info">英数字</div>
                @endslot
            {{ Form::password('password', ['class' => 'form-control']) }}
        @endcomponent

        @component('parts.inline-form-component', ['name' => 'password_confirmation', 'label' => 'パスワード(再)'])
            {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        @endcomponent

        @component('parts.group-form-component')
            {{ Form::submit('作成', ['class' => 'btn btn-primary']) }}
        @endcomponent

        {{ Form::close() }}
    @endcomponent

@endsection
