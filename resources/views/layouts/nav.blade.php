<!-- Toggle-Button für das Offcanvas-Menü -->
<nav class="navbar bg-primary">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <button class="btn btn-outline p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
            <div style="width: 5rem">
                @include('svgs.hogwarts-crest')
            </div>
        </button>

        @auth
            <div class="text-end text-black fs-3 me-3">
                {{ Auth::user()->name }}
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
            @role('professor|headmaster|admin')
            <li class="nav-item">
                <a href="#" class="nav-link text-black">{{__('nav.students')}}</a>
            </li>
            @endrole
            @role('headmaster|admin')
            <li class="nav-item">
                <a href="#" class="nav-link text-black">{{__('nav.houses')}}</a>
            </li>
            @endrole
        </ul>
    </div>
</div>
