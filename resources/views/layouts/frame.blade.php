<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="keywords" content="はこディタ">
        <meta name="description" content="はこディタ.">
        <meta name="author" content="mabasasi">

        @if (View::hasSection('title'))
            <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
        @else
            <title>{{ config('app.name', 'Laravel') }}</title>
        @endif

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Site Icons -->
        <link rel="icon" type="image/vnd.microsoft.icon" href="{{ url('/favicon.ico') }}">
        <link rel="shortcut icon" href="{{ url('/favicon.ico') }}">
        {{-- <link rel="apple-touch-icon" sizes="48x48" href="{{ url('/apple-touch-icon.png') }}"> --}}

        <!-- Styles -->
        @includeIf('layouts.styles')
        @stack('styles')
    </head>
    <body>
        <!-- Body Contents -->
        @yield('body')

        <!-- Scripts -->
        @includeIf('layouts.scripts')
        @stack('scripts')

        {{--デバッグ用リロード JS--}}
        @if(request('reload') > 0)
            @push('scripts')
                <script>
                    setTimeout(function () {
                        window.location.reload();
                    }, "{{ request('reload') }}");
                </script>
            @endpush
        @endif
    </body>
</html>
