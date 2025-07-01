@php
$sanitizeName = preg_replace('/-/','_', $name);
@endphp

<div {{$attributes->merge(['class' => 'input-group'])}}>
    <label for="{{$name}}" class="input-group-text">
        <x-icon type="{{$icon}}"/>
        {{$labelName}}
    </label>
    <input type="{{$inputType}}" class="form-control" name="{{$sanitizeName}}" id="{{$name}}"
        placeholder="{{$placeholder}}" {!!$inputOtherAttribute!!} {{$isRequired==true ? 'required' : '' }}>
</div>