@php
$filtered_name = preg_replace('/-/','_', $name);
@endphp
<div {{$attributes->merge(['class' => ''])}}>
    <label for="{{$name}}">{{$label}}</label>
    <input type="{{$type}}" id={{$name}} name="{{$filtered_name}}" class="form-control" {{ $isRequired==true
        ? 'required' : '' }}>
</div>