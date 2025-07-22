@php
$filtered_name = preg_replace('/-/','_', $name);
@endphp
<div {{$attributes->merge(['class' => ''])}}>
    @if ($label)
        <label for="{{$name}}" class="fw-bold">{{$label}}</label>
    @endif
    <input type="{{$type}}" id={{$name}} name="{{$filtered_name}}" class="form-control" value="{{$value}}" placeholder="{{$placeholder}}"
        {{$addons}} {{ $isRequired==true ? 'required' : '' }}>
</div>