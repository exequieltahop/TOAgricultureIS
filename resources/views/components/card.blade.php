<div {{$attributes->merge(['class' => 'card'])}}>

    {{-- card header --}}
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between m-0 p-0">
            {{-- card header icon and title --}}
            <div class="d-flex align-items-center">
                <x-icon type="{{$iconType}}" />
                <h5 class="m-0">{{$cardTitle}}</h5>
            </div>

            {{-- addons like search --}}
            {{$addons}}
        </div>
    </div>

    {{-- card body --}}
    <div class="card-body">
        {{$slot}}
    </div>
</div>