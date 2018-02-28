@extends('layouts.hakoditor')

@section('container')
    <div class="row">
        <div class="col-md-8 offset-md-2">

            @component('parts.general-card-component')
                @slot('header')
                    ログイン
                @endslot

                {{ Form::open(['method' => 'POST', 'url' => route('login')]) }}

                @component('parts.inline-form-component', ['name' => 'userid', 'label' => 'ID'])
                    {{ Form::text('userid', old('userid'), ['class' => 'form-control']) }}
                @endcomponent

                @component('parts.inline-form-component', ['name' => 'password', 'label' => 'パスワード'])
                    {{ Form::password('password', ['class' => 'form-control']) }}
                @endcomponent

                @component('parts.group-form-component')
                    {{ Form::submit('ログイン', ['class' => 'btn btn-primary']) }}
                @endcomponent

                {{ Form::close() }}
            @endcomponent

        </div>
    </div>
@endsection
