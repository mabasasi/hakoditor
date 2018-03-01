@extends('layouts.frame')

@section('body')
    <!-- Navivation Bar -->
    @includeIf('layouts.navbar')

    <main>
        @if(request('error') == 'true')
            <!-- Debug Error View-->
            @includeIf('layouts.error')
        @endif

        <!-- Main Content -->
        <div class="container">
            @yield('container')
        </div>
    </main>
    
@endsection
