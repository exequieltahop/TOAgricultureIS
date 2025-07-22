@php
$filtered_name = preg_replace('/-/','_', $name);
@endphp
<div {{$attributes->merge(['class' => ''])}}>
    @if ($label)
    <label for="{{$name}}" class="fw-bold">{{$label}}</label>
    @endif
    <select id={{$name}} name="{{$filtered_name}}" class="form-control" {{$addons}} {{ $isRequired==true ? 'required'
        : '' }}>
        {{$slot}}
    </select>
</div>