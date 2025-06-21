@if (Auth::check())
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item flex-row ml-md-auto mt-3">
                <li class="nav-item dropdown user-profile-dropdown">
                    <div class="dropdown  custom-dropdown-icon">
                        <a class="dropdown-toggle text-white" href="#" role="button" id="customDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-uppercase font-weight-bold">
                                {{ auth()->user()->name }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right bg-white" aria-labelledby="customDropdown">
                            <a class="dropdown-item text-dark" data-value="Divisas" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                    <path fill-rule="evenodd"
                                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                </svg>
                                Cerrar Session
                            </a>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-md" style="height: 30px;">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-three-dots text-black" viewBox="0 0 16 16">
                    <path
                        d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                </svg>
            </a>
            @if (Request::is('sys-admin/pos'))
                <ul class="navbar-nav flex-row m-auto ">
                    <li class="nav-item theme-text mt-1">
                        <livewire:search>
                    </li>
                </ul>
            @endif
        </header>
    </div>

@endif
