<x-auth>
    {{-- title --}}
    <x-slot name="title">
        Users
    </x-slot>

    {{-- users list --}}
    <section class="container-fluid p-0 m-0">
        <x-card class="shadow-lg" card-title="Users List" icon-type="user-plus">
            {{-- table --}}
            <x-table table-class="table-sm table-hover"
                :ths="['No.', 'Name', 'Email', 'Date Account Created', 'Action']">
                @forelse ($users as $item)
                    <tr class="align-middle">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->created_at->format('F j, Y')}}</td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <a href="" class="btn btn-sm btn-warning text-nowrap">
                                    <x-icon type="edit" />
                                    Edit
                                </a>
                                <x-button class="btn btn-sm btn-danger  text-nowrap">
                                    <x-icon type="trash" />
                                    Delete
                                </x-button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center" colspan="5">
                        <td class="">No Data</td>
                    </tr>
                @endforelse

            </x-table>
        </x-card>
    </section>
</x-auth>