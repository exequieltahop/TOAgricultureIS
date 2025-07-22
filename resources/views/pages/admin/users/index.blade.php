<x-auth>
    {{-- title --}}
    <x-slot name="title">
        Users
    </x-slot>

    {{-- users list --}}
    <section class="container-fluid p-0 m-0">
        <div class="d-flex justify-content-end">
            <a href="{{route('admin.users.list.create')}}" class="btn btn-sm bg-primary-color text-white mb-3 align-end">
                <x-icon type="user-plus primary-color text-white"/>
                Create User
            </a>
        </div>

        <x-card class="shadow-lg" card-title="Users List" icon-type="user-plus">

            {{-- form search user --}}
            <x-slot name="addons">
                <x-form class="d-flex align-items-center m-0 p-0">
                    <x-input type="search" name="search" placeholder="Search Account Name" />
                    <x-button type="submit" id="form-search-submit-btn" icon="search" />
                </x-form>
            </x-slot>

            {{-- table --}}
            <x-table table-class="table-sm table-hover"
                :ths="['No.', 'Name', 'Email', 'Date Account Created', 'Action']">
                @forelse ($users as $item)
                <tr class="align-middle text-nowarp">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->created_at->format('F j, Y')}}</td>
                    <td>
                        <div class="d-flex align-items-center gap-1">
                            <a href="{{route('admin.users.edit', ['id' => urlencode(Illuminate\Support\Facades\Crypt::encrypt($item->id))])}}" class="btn btn-sm btn-warning text-nowrap">
                                <x-icon type="edit" />
                                Edit
                            </a>
                            <x-button class="btn btn-sm btn-danger text-nowrap delete-staff-btn" type="button"
                                data-id="{{Illuminate\Support\Facades\Crypt::encrypt($item->id)}}">
                                <x-icon type="trash" />
                                Delete
                            </x-button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="text-center" colspan="5">
                    <td class="text-secondary" colspan="5">No Data</td>
                </tr>
                @endforelse

            </x-table>

            {{-- pagination --}}
            {{$users->links()}}
        </x-card>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // delete staff
            deleteStaff();
        });

        // delete staff
        function deleteStaff() {
            const delete_btn = document.querySelectorAll('.delete-staff-btn');

            // onclick delete btn
            delete_btn.forEach(item => {
                item.addEventListener('click', async function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    // get id
                    const id = e.target.dataset.id;


                    // confirmation
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then(async (result) => {
                        if (result.isConfirmed) {

                            try {
                                /**
                                 * url
                                 * delete request
                                 */

                                const url = `/admin/users/delete/${encodeURIComponent(id)}`;
                                const response = await fetch(url, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN' : token
                                    }
                                });

                                // if response was 500
                                if(!response.ok){
                                    throw new Error();
                                }

                                // else
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "User/Staff has been deleted.",
                                    icon: "success"
                                }).then(()=>{
                                    // then reload page for changes to update
                                    window.location.reload();
                                });
                            } catch (error) {
                                /**
                                 * log error
                                 * show error alert
                                 */
                                Swal.fire({
                                    title: 'Error',
                                    icon: 'error',
                                    text: 'Something Went Wrong Pls Contact Developer, Thank You!',
                                });
                                console.error(error.message);
                            }
                        }
                    });
                });
            });
        }
    </script>
</x-auth>