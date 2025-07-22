<x-auth>
    {{-- title --}}
    <x-slot name="title">
        Edit Users
    </x-slot>

    {{-- main --}}
    <section class="container-fluid m-0 p-0">
        <div class="d-grid place-items-center">
            {{-- form --}}
            <x-form id="form-edit-staff" class="border rounded p-4 shadow-lg w-100" :is-put="true">
                <h4 class="primary-color mb-3">
                    <x-icon type="edit" />
                    Edit Staff
                </h4>
                <div class="row">
                    {{-- fname --}}
                    <div class="col-sm-6">
                        <x-input type="text" label="First Name" name="fname" class="mb-3" :is-required="true"
                            placeholder="First Name" value="{{$user->f_name}}" />
                    </div>
                    {{-- mname --}}
                    <div class="col-sm-6">
                        <x-input type="text" label="Middle Name" name="mname" class="mb-3" :is-required="false"
                            placeholder="Middle Name" value="{{$user->m_name}}" />
                    </div>
                    {{-- lname --}}
                    <div class="col-sm-6">
                        <x-input type="text" label="Last Name" name="lname" class="mb-3" :is-required="true"
                            placeholder="Last Name" value="{{$user->l_name}}" />
                    </div>
                    {{-- bdate --}}
                    <div class="col-sm-6">
                        <x-input type="date" label="Birth Date" name="bdate" class="mb-3"
                            value="{{Carbon\Carbon::parse($user->b_date)->format('Y-m-d')}}" :is-required="true" />
                    </div>
                    {{-- bplace --}}
                    <div class="col-sm-6">
                        <x-input type="text" label="Birth Place" name="bplace" class="mb-3" value="{{$user->b_place}}"
                            :is-required="true" placeholder="Birth Place" />
                    </div>
                    {{-- sex --}}
                    <div class="col-sm-6">
                        <x-select name="sex" label="Sex" class="mb-3" :is-required="true">
                            <option value="">--Select Sex--</option>
                            <option value="1" {{$user->sex == 1 ? 'selected' : ''}}>Male</option>
                            <option value="2" {{$user->sex == 2 ? 'selected' : ''}}>Female</option>
                        </x-select>
                    </div>
                    {{-- civil status --}}
                    <div class="col-sm-6">
                        <x-select name="civil_status" label="Civil Status" class="mb-3" :is-required="true">
                            <option value="">--Select Status--</option>
                            <option value="1" {{$user->civil_status == 1 ? 'selected' : ''}}>Single</option>
                            <option value="2" {{$user->civil_status == 2 ? 'selected' : ''}}>Married</option>
                            <option value="3" {{$user->civil_status == 3 ? 'selected' : ''}}>Widowed</option>
                        </x-select>
                    </div>

                    {{-- email --}}
                    <div class="col-sm-6">
                        <x-input type="email" label="Email" name="email" class="mb-3" value="{{$user->email}}"
                            :is-required="true" placeholder="email@example.com" />
                    </div>

                    {{-- new password --}}
                    <div class="col-sm-6">
                        <x-input type="text" label="New Password" name="new_password" class="mb-3" :is-required="false"
                            placeholder="Password must atleast 8 character" />
                    </div>
                </div>

                {{-- buttons --}}
                <div class="d-flex align-items-center justify-content-end gap-2">
                    <a href="{{route('admin.users.list')}}" class="btn btn-sm btn-primary text-white">
                        <x-icon type="arrow-left text-white" />
                        Back
                    </a>
                    <x-button type="submit" id="submit-btn" class="btn-sm btn-primary" icon="check"
                        data-id="{{ Illuminate\Support\Facades\Crypt::encrypt($user->id)}}">
                        Update
                    </x-button>
                </div>
            </x-form>
        </div>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // update staff account
            update();
        });

        // submit edit form
        function update(){
            const form = document.getElementById('form-edit-staff');
            const submit_btn = document.getElementById('submit-btn');
            const id = submit_btn.dataset.id;

            // form submission
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                submit_btn.disabled = true;

                try {
                    // formdata, url and put request
                    let formData = new FormData(form);
                    const url = `/admin/users/list/${encodeURIComponent(id)}`;
                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData
                    });

                    // if response was not ok throw new Error
                    if(!response.ok){
                        throw new Error("");
                    }

                    // show success alert
                    Swal.fire({
                        title: 'Success',
                        icon: 'success',
                        text: 'Successfully Update Account'
                    });
                    submit_btn.disabled = false;
                } catch (error) {
                    /**
                     * log error
                     * show error alert
                     */
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Something Went Wrong!, Pls Contact Developer'
                    });
                    submit_btn.disabled = false;
                    console.error(error.message);
                }
            });
        }
    </script>
</x-auth>