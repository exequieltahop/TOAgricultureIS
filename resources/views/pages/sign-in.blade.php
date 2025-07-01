<x-guest>
    {{-- title --}}
    <x-slot name="title">
        {{ __('Sign In') }}
    </x-slot>

    {{-- main form sign in form --}}
    <section class="container-fluid p-0 m-0 d-grid vh-100" style="place-items: center;">

        {{-- form --}}
        <x-form class="w-100 border p-4 rouned shadow-lg" style="max-width: 500px" id="form-signin">
            {{-- email --}}
            <x-input-group input-type="email" name="email" icon="envelope" class="mb-3"
                placeholder="email@example.com" />

            {{-- password --}}
            <x-input-group input-type="password" name="password" icon="key" class="mb-3" placeholder="********"
                :input-other-attribute='"minlength=8"' />

            {{-- btn --}}
            <x-button type="submit" class="btn-success w-100" icon="check">
                Sign In
            </x-button>

        </x-form>

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const form = document.getElementById('form-signin');
            form.addEventListener('submit', async (e)=>{
                    e.preventDefault();
                e.stopImmediatePropagation();

                try {
                    // url
                    const url = `/sign-in-process`;
                    // post request
                    const response = await fetch(url, {
                        method: 'POST',
                        headers : {
                            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: new FormData(form)
                    });

                    // if 500
                    if(response.status == 500) throw new Error("");

                    // if 401
                    if(response.status == 401){
                        toastr.error("Error", "Invalid Credentials");
                        return;
                    }
                    // else show success toast
                    toastr.success("Success", "Successfully Log In");

                    // redirect
                    setInterval(async () => {
                        const data = await response.json(); // parse reponse json

                        window.location.href = `${data.url}`;
                    }, 1500);

                } catch (error) {
                    /**
                     * log error
                     * show error alert
                     */
                    console.error(error.message);
                    toastr.error("Error", "Somethnig Went Wrong Pls Contact Developer");
                }
            });
        });
    </script>
</x-guest>