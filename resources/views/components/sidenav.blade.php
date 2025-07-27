<aside class="d-none d-md-block">
    <nav class="">
        <ul class="nav flex-column p-3">
            <li class="nav-item">
                <a href="{{route('admin.dashboard')}}" class="nav-link d-flex align-items-center gap-1 rounded {{ str_contains(Route::currentRouteName(), 'admin.dashboard') ? 'bg-primary-color text-white' : 'text-dark' }}" style="letter-spacing: 1px;">
                    <x-icon type="dashboard {{ str_contains(Route::currentRouteName(), 'admin.dashboard') ? 'text-white' : 'text-dark' }}" />
                    Dashboard
                </a>
            </li>
            @if (Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{route('admin.users.list')}}" class="nav-link d-flex align-items-center gap-1 rounded {{ str_contains(Route::currentRouteName(), 'admin.users') ? 'bg-primary-color text-white' : 'text-dark' }}" style="letter-spacing: 1px;">
                        <x-icon type="users {{ str_contains(Route::currentRouteName(), 'admin.users') ? 'text-white' : 'text-dark' }}" />
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('farmers.index')}}" class="nav-link d-flex align-items-center gap-1 rounded {{ str_contains(Route::currentRouteName(), 'farmers') ? 'bg-primary-color text-white' : 'text-dark' }}" style="letter-spacing: 1px;">
                        <x-icon type="users {{ str_contains(Route::currentRouteName(), 'farmers') ? 'text-white' : 'text-dark' }}" />
                        Farmers
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{route('signout')}}" class="nav-link d-flex align-items-center gap-1 rounded {{ str_contains(Route::currentRouteName(), 'signout') ? 'bg-primary-color text-white' : 'text-dark' }}" style="letter-spacing: 1px;">
                    <x-icon type="sign-out {{ str_contains(Route::currentRouteName(), 'signout') ? 'text-white' : 'text-dark' }}" />
                    Log Out
                </a>
            </li>
        </ul>
    </nav>
</aside>