<form {{$attributes->merge(['class' => ''])}} >
    @csrf
    @if($isPut)
        @method('PUT')
    @endif
    {{$slot}}
</form>