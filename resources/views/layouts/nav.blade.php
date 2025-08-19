<!-- Toggle-Button für das Offcanvas-Menü -->
<nav class="navbar bg-primary">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <button class="btn btn-outline p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
            <div style="width: 5rem">
                @include('svgs.hogwarts-crest')
            </div>
        </button>
        @auth
            <div class="d-flex align-items-center">
                <div class="dropdown me-2">
                    <a href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/avatars/default.png') }}"
                             class="rounded-circle"
                             style="width: 48px; height: 48px; object-fit: cover;"
                             alt="Avatar">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item" href="#">Einstellungen</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="text-start text-black me-3 lh-sm">
                    <div class="fs-4">{{ Auth::user()->name }}</div>

                    @if($role = Auth::user()->getRoleNames()->first())
                        <div class="fs-6">
                            {{ __('roles.' . $role) }}
                        </div>
                    @endif
                </div>
            </div>
        @endauth
    </div>
</nav>

<!-- Offcanvas-Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">{{__('nav.navigation')}}</h5>
        <button type="button" class="btn-close btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link text-black">{{__('nav.start')}}</a>
            </li>
            @role('admin|headmaster|professor')
            <li class="nav-item">
                <a href="{{ route('students.index') }}" class="nav-link text-black">{{__('nav.students')}}</a>
            </li>
            @endrole
            @role('admin')
            <li class="nav-item">
                <a href="#" class="nav-link text-black">{{__('nav.houses')}}</a>
            </li>
            @endrole
        </ul>
    </div>
</div>
