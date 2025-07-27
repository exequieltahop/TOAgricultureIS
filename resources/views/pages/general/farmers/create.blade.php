<x-auth>
    {{-- title --}}
    <x-slot name="title">
        Add Farmer
    </x-slot>

    {{-- farmers list --}}
    <section class="container-fluid p-0 m-0">
        <x-card class="shadow-lg" card-title="Register Farmers" icon-type="user-plus">
            {{-- form register farmer --}}
            <x-form class="p-2" id="form-register-farmer">
                <div class="row row-gap-2">
                    {{-- first name --}}
                    <div class="col-sm-6">
                        <x-input name="fname" label="First Name" :is-required="true" />
                    </div>
                    {{-- middle name --}}
                    <div class="col-sm-6">
                        <x-input name="mname" label="Middle Name" />
                    </div>
                    {{-- last name --}}
                    <div class="col-sm-6">
                        <x-input name="lname" label="Last Name" :is-required="true" />
                    </div>
                    {{-- birth date --}}
                    <div class="col-sm-6">
                        <x-input type="date" name="bdate" label="Birth Date" :is-required="true" />
                    </div>
                    {{-- birth place --}}
                    <div class="col-sm-6">
                        <x-input name="bplace" label="Birth Place" :is-required="true" />
                    </div>
                    {{-- sex --}}
                    <div class="col-sm-6">
                        <x-select name="sex" label="Sex" :is-required="true">
                            <option value="">--Select Sex--</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </x-select>
                    </div>
                    {{-- address --}}
                    <div class="col-sm-6">
                        <x-input name="address" label="Address" :is-required="true" />
                    </div>
                    {{-- civil status --}}
                    <div class="col-sm-6">
                        <x-select name="civil-status" label="Civil Status" :is-required="true">
                            <option value="">--Select Status--</option>
                            <option value="1">Single</option>
                            <option value="2">Married</option>
                        </x-select>
                    </div>
                    {{-- id type --}}
                    <div class="col-sm-6">
                        <x-select name="id-type" label="ID Type" :is-required="true">
                            <option value="">--Select ID Type--</option>
                            <option value="1">National ID</option>
                            <option value="2">Philhealth ID</option>
                            <option value="3">Driver's License ID</option>
                            <option value="4">TIN ID</option>
                            <option value="5">Passport ID</option>
                        </x-select>
                    </div>
                    {{-- id pic --}}
                    <div class="col-sm-6">
                        <x-input type="file" name="id-file" label="ID Picture" :is-required="true" />
                    </div>
                </div>

                {{-- btns --}}
                <div class="mt-3 d-flex align-items-center justify-content-end gap-2">
                    <a href="{{route('farmers.index')}}" class="btn btn-sm btn-primary">
                        <x-icon type="arrow-left" />
                        Back
                    </a>
                    {{-- register --}}
                    <x-button class="btn-sm btn-primary" type="submit" id="btn-submit" icon="check">
                        Register
                    </x-button>
                </div>
            </x-form>
        </x-card>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // init farmers registration
            registerFarmer();
        });

        // register farmer
        function registerFarmer(){
            // form & submit btn
            const form = document.getElementById('form-register-farmer');
            const submit_btn = document.getElementById('btn-submit');

            // add event listener submit
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                // disabled btn
                submit_btn.disabled = true;

                try {
                    /**
                     * url
                     * post request
                    */
                    const url = `{{route('farmers.store')}}`;
                    const response = await fetch(url, {
                        method: 'POST',
                        body: new FormData(form)
                    });

                    // if 500
                    if(response.status == 500){
                        throw new Error("status 500");
                    }

                    // if 422
                    if(response.status == 422){
                        Swal.fire({
                            title: 'Warning',
                            icon: 'warnng',
                            text: 'Make sure ID file was (.png, .jpg, .jpeg) only and file size do not exceed 10mb!',
                        });

                        // enable btn
                        submit_btn.disabled = false;

                        // return
                        return;
                    }


                    Swal.fire({
                        title: 'Registered',
                        icon: 'success',
                        text: 'Successfully Register Farmer!',
                    }).then(()=>{
                        // enable btn
                        submit_btn.disabled = false;
                        // redirect to index
                        window.location.href = `{{route('farmers.index')}}`;
                    });

                } catch (error) {
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Something Went Wrong!, Pls Contact Developer!',
                    });
                    console.error(error.message);
                    // enable btn
                    submit_btn.disabled = false;
                }
            });
        }
    </script>
</x-auth>