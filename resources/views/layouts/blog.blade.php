@extends('layouts.frame')

@section('body')
    <!-- Navivation Bar -->
    @includeIf('layouts.navbar')

    @if(request('error') == 'true')
        <!-- Debug Error View-->
        @includeIf('layouts.error')
    @endif

    <!-- Main Content -->
    <div class="container">
        @yield('container')
    </div>
@endsection
