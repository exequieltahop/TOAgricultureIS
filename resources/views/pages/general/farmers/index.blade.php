<x-auth>
    {{-- title --}}
    <x-slot name="title">
        Farmers
    </x-slot>

    {{-- farmers list --}}
    <section class="container-fluid p-0 m-0">
        <a href="{{route('farmers.create')}}" class="btn btn-sm btn-primary">
            <x-icon type="user-plus" />
            Add Farmer
        </a>
        {{-- table list --}}
        <x-card class="shadow-lg" card-title="Farmers" icon-type="users">

            {{-- table list of farmers --}}
            <x-table :ths="['Action', 'Name', 'Sex', 'Address', 'Birth Date', 'Birth Place', 'Age', 'Registered Date']"
                table-class="table-sm table-hover table-bordered">
                {{-- loop farmers --}}
                @forelse ($farmers as $item)
                <tr class="align-middle">
                    <td class="">
                        <div class="d-flex align-items-center justify-content-center flex-nowrap gap-2">
                            {{-- delete --}}
                            <x-button class="btn btn-sm btn-danger delete-farmer-btn text-nowrap w-100"
                                data-id="{{$item->id}}" icon="trash">
                                Delete
                            </x-button>
                            {{-- edit --}}
                            <x-button class="btn btn-sm btn-warning edit-farmer-btn text-nowrap w-100"
                                data-id="{{$item->id}}" icon="pencil">
                                Edit
                            </x-button>
                        </div>
                    </td>
                    <td>
                        @if ($item->mname == "")
                        {{$item->fname . ' ' . $item->lname}}
                        @else
                        {{$item->fname . ' ' . $item->mname . ' ' . $item->lname}}
                        @endif

                    </td>
                    <td>
                        {{$item->sex == 1 ? 'Male' : 'Female'}}
                    </td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->bdate->format('F j, Y')}}</td>
                    <td>{{$item->bplace}}</td>
                    <td>{{Carbon\Carbon::parse($item->bdate)->age}}</td>
                    <td>{{$item->created_at->format('F j, Y')}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-secondary">No Data</td>
                </tr>
                @endforelse
            </x-table>
        </x-card>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // init delete farmer
            deleteFarmer();
        });

        // delete farmer
        function deleteFarmer(){
            const delete_btn = document.querySelectorAll('.delete-farmer-btn');

            // loop all the delete btn
            delete_btn.forEach(item => {
                // get data id
                const id = item.dataset.id;

                item.addEventListener('click', async function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    // prompt confirmation
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then(async (result) => {

                        // if confirmed
                        if (result.isConfirmed) {
                            try {
                                Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            }).then(()=>{
                                window.location.reload();
                            });
                            } catch (error) {
                                Swal.fire({
                                    title: 'Error',
                                    icon: 'error',
                                    text: 'Something Went Wrong, Pls Contact Developer'
                                })
                            }

                        }
                    });
                });
            });
        };
    </script>
</x-auth>