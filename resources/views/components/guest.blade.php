<x-app>
    <x-slot name="title">
        {{ $title ?? ''}}
    </x-slot>
    {{-- header --}}
    <x-slot name="header">
        {{$header ?? ''}}
    </x-slot>

    {{-- main --}}
    <x-slot name="guest">
        <div {{$attributes->merge(['class' => 'container-fluid p-0 m-0'])}}>
            {{$slot}}
        </div>
    </x-slot>

    {{-- footer --}}
    <x-slot name="footer">
        {{$footer ?? ''}}
    </x-slot>
</x-app>
