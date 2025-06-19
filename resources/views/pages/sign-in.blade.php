<x-guest>
    {{-- title --}}
    <x-slot name="title">
        {{ __('Sign In') }}
    </x-slot>

    {{-- main form sign in form --}}
    <section class="container-fluid p-0 m-0 d-grid vh-100" style="place-items: center;">
        <x-form class="w-100 border p-4 rouned shadow-lg" style="max-width: 500px">
            {{-- h3 --}}
            <h3>{{__('Sign In Here')}}</h3>

            {{-- email --}}
            <x-input type="email" name="email" label="Email" :is-required="true" class="mb-3"/>

            <div class="d-flex align-items-center justify-content-center">
                <x-button type="submit" class="btn-success" icon="check">
                    Sign In
                </x-button>
            </div>
        </x-form>
    </section>
</x-guest>