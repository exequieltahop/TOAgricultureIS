<button {{$attributes->merge(['class' => 'btn'])}}>
    <x-icon type="{{$icon}}" />
    {{$slot}}
</button>