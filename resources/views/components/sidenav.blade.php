<aside class="">
    <nav class="">
        <ul class="nav flex-column p-3">
            <li class="nav-item">
                <a href="{{route('admin.dashboard')}}" class="nav-link d-flex align-items-center gap-1 rounded {{ str_contains(Route::currentRouteName(), 'admin.dashboard') ? 'bg-primary-color text-white' : 'text-dark' }}" style="letter-spacing: 1px;">
                    <x-icon type="dashboard {{ str_contains(Route::currentRouteName(), 'admin.dashboard') ? 'text-white' : 'text-dark' }}" />
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.users.list')}}" class="nav-link d-flex align-items-center gap-1 rounded {{ str_contains(Route::currentRouteName(), 'admin.users.list') ? 'bg-primary-color text-white' : 'text-dark' }}" style="letter-spacing: 1px;">
                    <x-icon type="users {{ str_contains(Route::currentRouteName(), 'admin.users.list') ? 'text-white' : 'text-dark' }}" />
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('signout')}}" class="nav-link d-flex align-items-center gap-1 rounded {{ str_contains(Route::currentRouteName(), 'signout') ? 'bg-primary-color text-white' : 'text-dark' }}" style="letter-spacing: 1px;">
                    <x-icon type="sign-out {{ str_contains(Route::currentRouteName(), 'signout') ? 'text-white' : 'text-dark' }}" />
                    Log Out
                </a>
            </li>
        </ul>
    </nav>
</aside>