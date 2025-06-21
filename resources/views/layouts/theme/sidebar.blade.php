<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        {{--
        * Componente: Sidebar de navegación principal
        * Funcionalidad: Menú colapsable con items basados en permisos
        * Estructura:
          - Contenedor principal con clases de estilo
          - Lista no ordenada como contenedor de items
          - Cada item verifica permisos con @can antes de renderizar
          - Items pueden tener submenús colapsables
        * Comportamiento:
          - Acordeón con submenús (data-toggle="collapse")
          - Estado activo basado en ruta actual (Request::is())
        --}}
        <ul class="list-unstyled menu-categories" id="accordionExample">
            {{--
            * Ejemplo de directiva Blade comentada:
            * @can('Home_Index') ... @endcan
            * Esto no será interpretado por Blade
            --}}
            @can('Home_Index')
            <!--
            * Item: Tablero (documentación visible en HTML)
            * Permiso requerido: Home_Index
            * Ruta: /sys-admin/home
            * Icono: SVG personalizado (ícono de tablero)
            * Estado activo: Basado en coincidencia de ruta
            -->
            <li class="menu">
                <a href="{{ url('sys-admin/home') }}" data-active="{{ Request::is('sys-admin/home') ? 'active' : '' }}"
                    aria-expanded="{{ Request::is('sys-admin/home') ? 'true' : 'false' }}" class="dropdown-toggle ">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"
                            fill="none" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" stroke="white">
                            <path
                                d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4q0 1 .25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75Q6 13 6 12H2s-2 0-2-2zm1.398-.855a.76.76 0 0 0-.254.302A1.5 1.5 0 0 0 1 4.01V10c0 .325.078.502.145.602q.105.156.302.254a1.5 1.5 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.76.76 0 0 0 .254-.302 1.5 1.5 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.76.76 0 0 0-.302-.254A1.5 1.5 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145" />
                        </svg>
                        <span class="text-sidebar">Tablero</span>
                    </div>
                </a>
            </li>
            @endcan
            @can('Company_Index')
            <!--
            * Item: Compañia (con submenú)
            * Permiso requerido: Company_Index
            * Subitems:
              - Ajustes (/sys-admin/company)
            * Icono: SVG de engranaje (bi bi-gear)
            * Comportamiento:
              - Acordeón colapsable (data-toggle="collapse")
              - Flecha indicadora de submenú (feather-chevron-right)
            -->
            <li class="menu">
                <a href="#settings" data-active="{{Request::is('sys-admin/company') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="{{Request::is('sys-admin/company') ? 'true' : 'false' }}" class="dropdown-toggle " >
                    <div class="text-sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" class="bi bi-gear" stroke="white" viewBox="0 0 16 16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                        </svg>
                        <span class="text-sidebar">Compañia</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{Request::is('sys-admin/company') ? 'show' : '' }}" id="settings" data-parent="#accordionExample">
                    <li class="{{ Request::is('sys-admin/company') ? 'active' : '' }}">
                        <a href="{{url('sys-admin/company')}}" class="text-white"> Ajustes </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('ClienteProveedor_Index')
            <li class="menu">
                <a href="{{ url('sys-admin/partners') }}"
                    data-active="{{ Request::is('sys-admin/partners') ? 'active' : '' }}"
                    aria-expanded="{{ Request::is('sys-admin/partners') ? 'true' : 'false' }}" class="dropdown-toggle ">
                    <div>
                        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                            </polygon>
                        </svg>
                        <span class="text-sidebar">Clientes</span>
                    </div>
                </a>
            </li>
            @endcan
            @can('Usuario_Index')
            <li class="menu">
                <a href="#loans" data-toggle="collapse"
                    data-active="{{ Request::is('sys-admin/loans') || Request::is('sys-admin/payments') ? 'active' : '' }}"
                    aria-expanded="{{ Request::is('sys-admin/loans') || Request::is('sys-admin/payments') ? 'true' : 'false' }}"
                    class="dropdown-toggle ">
                    <div class="text-sidebar">
                        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span>Prestamos</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ Request::is('sys-admin/loans') || Request::is('sys-admin/payments') ? 'show' : '' }}"
                    id="loans" data-parent="#accordionExample">
                    <li class="{{ Request::is('sys-admin/loans') ? 'active' : '' }}">
                        <a href="{{ url('sys-admin/loans') }}" class="text-white"> Prestamos </a>
                    </li>
                    <li class="{{ Request::is('sys-admin/payments') ? 'active' : '' }}">
                        <a href="{{ url('sys-admin/payments') }}" class="text-white"> Pagos </a>
                    </li>
                </ul>
            </li>
            @endcan   
            @can('Usuario_Index')
            <li class="menu">
                <a href="#users" data-toggle="collapse"
                    data-active="{{ Request::is('sys-admin/users') || Request::is('sys-admin/roles') || Request::is('sys-admin/permisos') || Request::is('sys-admin/asignar') ? 'active' : '' }}"
                    aria-expanded="{{ Request::is('sys-admin/users') || Request::is('sys-admin/roles') || Request::is('sys-admin/permisos') || Request::is('sys-admin/asignar') ? 'true' : 'false' }}"
                    class="dropdown-toggle ">
                    <div class="text-sidebar">
                        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Autenticación</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ Request::is('sys-admin/users') || Request::is('sys-admin/roles') || Request::is('sys-admin/permisos') || Request::is('sys-admin/asignar') ? 'show' : '' }}"
                    id="users" data-parent="#accordionExample">
                    <li class="{{ Request::is('sys-admin/users') ? 'active' : '' }}">
                        <a href="{{ url('sys-admin/users') }}" class="text-white"> Usuarios </a>
                    </li>
                    <li class="{{ Request::is('sys-admin/roles') ? 'active' : '' }}">
                        <a href="{{ url('sys-admin/roles') }}" class="text-white"> Roles </a>
                    </li>
                    <li class="{{ Request::is('sys-admin/permisos') ? 'active' : '' }}">
                        <a href="{{ url('sys-admin/permisos') }}" class="text-white"> Permisos </a>
                    </li>
                    <li class="{{ Request::is('sys-admin/asignar') ? 'active' : '' }}">
                        <a href="{{ url('sys-admin/asignar') }}" class="text-white"> Asignar </a>
                    </li>
                </ul>
            </li>
            @endcan
        </ul>
    </nav>
</div>


