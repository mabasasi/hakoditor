
@php($random = str_random(8))
@php($method = isset($method) ? $method : 'POST')
@php($href   = isset($href) ? $href : '')
@php($class  = isset($class) ? 'class="'.$class.'"' : '')

<a {!! $class !!} href="{{ $href }}" onclick="event.preventDefault(); document.getElementById('{{ $random }}').submit();">
    {{ $slot }}
</a>

{{ Form::open(['method' => $method, 'url' => $href, 'id' => $random]) }}
{{ Form::close() }}
