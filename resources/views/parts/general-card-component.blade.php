
{{--Heigit 最大化支援--}}
@php($doExpand = isset($expand) ? $expand : false)

<div class="card margin{{ out_if_true($doExpand, ' expand-height') }}{{ isset($class) ? ' '.$class : '' }}">
    @isset($header)
        <div class="card-header">
            {{ $header }}
        </div>
    @endisset

    <div class="card-body card-body-sm{{ isset($bodyClass) ? ' '.$bodyClass : '' }}">
        {{ $slot }}
    </div>
</div>
