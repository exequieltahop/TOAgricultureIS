<x-auth>

    <style>
        * {
            color: var(--primary)
        }
    </style>

    {{-- title --}}
    <x-slot name="title">
        Edit Users
    </x-slot>

    {{-- main content --}}
    <section class="container-fluid m-0 p-0">
        <div class="d-grid place-items-center">
            {{-- form --}}
            <x-form id="form-create-staff" class="border rounded p-4 shadow-lg w-100">
                <h4 class="primary-color mb-3">
                    <x-icon type="user-plus" />
                    Create Staff
                </h4>
                <div class="row">
                    {{-- fname --}}
                    <div class="col-sm-6">
                        <x-input type="text" label="First Name" name="fname" class="mb-3" :is-required="true"
                            placeholder="First Name" />
                    </div>
                    {{-- mname --}}
                    <div class="col-sm-6">
                        <x-input type="text" label="Middle Name" name="mname" class="mb-3" :is-required="false"
                            placeholder="Middle Name" />
                    </div>
                    {{-- lname --}}
                    <div class="col-sm-6">
                        <x-input type="text" label="Last Name" name="lname" class="mb-3" :is-required="true"
                            placeholder="Last Name" />
                    </div>
                    {{-- bdate --}}
                    <div class="col-sm-6">
                        <x-input type="date" label="Birth Date" name="bdate" class="mb-3" :is-required="true" />
                    </div>
                    {{-- bplace --}}
                    <div class="col-sm-6">
                        <x-input type="text" label="Birth Place" name="bplace" class="mb-3" :is-required="true"
                            placeholder="Birth Place" />
                    </div>
                    {{-- sex --}}
                    <div class="col-sm-6">
                        <label for="sex" class="fw-bold">Sex</label>
                        <select name="sex" id="sex" class="form-control">
                            <option value="">--Select Sex--</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                    {{-- civil status --}}
                    <div class="col-sm-6">
                        <label for="civil_status" class="fw-bold">Civil Status</label>
                        <select name="civil_status" id="civil_status" class="form-control">
                            <option value="">--Select Status--</option>
                            <option value="1">Single</option>
                            <option value="2">Married</option>
                            <option value="3">Widowed</option>
                        </select>
                    </div>

                    {{-- email --}}
                    <div class="col-sm-6">
                        <x-input type="email" label="Email" name="email" class="mb-3" :is-required="true"
                            placeholder="email@example.com" />
                    </div>

                    {{-- password --}}
                    <div class="col-sm-6">
                        <x-input type="text" label="Password" name="password" class="mb-3" :is-required="true"
                            placeholder="Password must atleast 8 character" />
                    </div>
                </div>


                {{-- buttons --}}
                <div class="d-flex align-items-center justify-content-end gap-2">
                    <a href="" class="btn btn-sm bg-primary-color text-white">
                        <x-icon type="arrow-left text-white" />
                        Back
                    </a>
                    <x-button type="submit" id="submit-btn" class="btn-sm bg-primary-color text-white" icon="check">
                        Create
                    </x-button>
                </div>
            </x-form>
        </div>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // create staff account
            createStaff();
        });

        // create user
        function createStaff(){
            const form = document.getElementById('form-create-staff');
            const submit_btn = document.getElementById('submit-btn');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                // disabled submit btn
                submit_btn.disabled = true;

                try {
                    const url = `/admin/users/list/store`;
                    const response = await fetch(url, {
                        method: 'POST',
                        body: new FormData(form)
                    });

                    // if response was not ok then throw new Error
                    if(!response.ok){
                        throw new Error("");
                    }

                    // success
                    Swal.fire({
                        title: 'Success',
                        icon: 'success',
                        text: 'Successfully Create Staff Account',
                    }).then(()=>{
                        window.location.href = '/admin/users/list'
                    });
                } catch (error) {
                    /**
                     * log error
                     * show error alert
                     */
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Something Went Wrong!'
                    });
                    console.error(error.message);

                }
            });
        }
    </script>
</x-auth>