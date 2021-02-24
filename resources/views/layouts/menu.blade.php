<ul class="navbar-nav theme-brand flex-row  text-center">
    <li class="nav-item theme-logo">
        <a href="index.html">
            <img src="{{asset('assets/img/90x90.png')}}" class="navbar-logo" alt="logo">
        </a>
    </li>
    <li class="nav-item theme-text">
        <a href="index.html" class="nav-link"> DIRECTV </a>
    </li>
</ul>

<ul class="list-unstyled menu-categories" id="accordionExample">
    <li class="menu {{ (request()->is('dashboard/almacen')) ? 'active' : '' }}">
        <a href="{{route('almacen.dashboard')}}" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-home">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>DASHBOARD</span>
            </div>
        </a>
    </li>

    <li class="menu {{ (request()->is('almacen*')) ? 'active' : '' }}">
        <a href="#almacen" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-terminal">
                    <polyline points="4 17 10 11 4 5"></polyline>
                    <line x1="12" y1="19" x2="20" y2="19"></line>
                </svg>
                <span>ALMACEN</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </a>
        <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled show"
            id="almacen" data-parent="#accordionExample">
            <li class="menu {{ (request()->is('almacen/guide-list')) ? 'active' : '' }}">
                <a href="{{route('almacen.listguide')}}"> INGRESO DE GUIAS </a>
            </li>
            <li class="menu {{ (request()->is('almacen/warehouse/give')) ? 'active' : '' }}">
                <a href="{{route('warehouse.give')}}" > REPARTO DECOS </a>
            </li>
            <li class="menu {{ (request()->is('almacen/warehouse/list')) ? 'active' : '' }}">
                <a href="{{route('warehouse.list')}}"> LISTA DECOS </a>
            </li>
        </ul>
    </li>
</ul>
