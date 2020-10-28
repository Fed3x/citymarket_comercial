<nav class="navbar navbar-expand-md navbar-light shadow-navbar-sidebar text-white">
    <div class="navbar-sidebar">

        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/home"><i class="fas fa-tachometer-alt"></i> Dashboard<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-clipboard"></i> Operaciones
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li class="dropdown-item"><a tabindex="-1"
                            href="/generar_reportes">Generar Reportes</a>
                        </li>
                    </ul>
                </li>
                @if(auth()->user()->isAdministrador())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cogs"></i>
                        Configuraciones
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#"><i class="fas fa-users"></i> Usuarios y Perfiles </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="/configuraciones/usuarios"><i class="fas fa-user"></i> Usuarios</a>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1" href="/configuraciones/perfiles"><i class="fas fa-user-tie"></i> Perfiles </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#"><i class="fab fa-product-hunt"></i> Referencias </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="/configuraciones/departamentos"><i class="fas fa-sitemap"></i> Departamentos </a>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1" href="/configuraciones/trabajos"><i class="fas fa-briefcase"></i> Trabajos </a>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1" href="/configuraciones/departamentos_trabajos"><i class="fas fa-sign"></i> Asignacion de Trabajos - Departamentos </a>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1" href="/configuraciones/parametros_trabajos"><i class="fas fa-cog"></i> Asignacion de Trabajos - Parametros </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif

            </ul>

            <nav-usuario-component :user="{{ auth()->user() }}"></nav-usuario-component>

        </div>
        @endauth
    </div>


</nav>