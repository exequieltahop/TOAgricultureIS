<x-app>
    {{-- title --}}
    <x-slot name="title">
        {{ $title ?? ''}}
    </x-slot>

    {{-- header --}}
    <x-slot name="header">
        {{$header ?? ''}}
    </x-slot>


    <div class="d-flex">
        {{-- aside --}}
        <x-sidenav/>

        <div class="d-flex flex-column w-100 gap-3">
            <x-header/>
            <main>
                {{-- main --}}
                {{$slot}}
            </main>
        </div>
    </div>

    {{-- footer --}}
    <x-slot name="footer">
        {{$footer ?? ''}}
    </x-slot>
</x-app>