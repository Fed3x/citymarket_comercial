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
                            href="/rendiciones">Rendiciones</a>
                        </li>
                        {{-- <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Institucion</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1"
                                        href="infraestructura">Infraestructura</a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Even More..</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                        <li class="dropdown-submenu"><a class="dropdown-item" href="#">another
                                                level</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Perfiles y Usuarios</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="/usuarios">Usuarios</a></li>
                                <li class="dropdown-item"><a href="/perfiles">Perfiles</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Hover me for more options</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="#">Second level</a></li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Even More..</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                        <li class="dropdown-submenu"><a class="dropdown-item" href="#">another
                                                level</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Hover me for more options</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="#">Second level</a></li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Even More..</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                        <li class="dropdown-submenu"><a class="dropdown-item" href="#">another
                                                level</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-clipboard"></i> Reportes
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li class="dropdown-item"><a tabindex="-1"
                            href="/generar_reportes">Generar</a>
                        </li>
                        {{-- <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Institucion</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1"
                                        href="infraestructura">Infraestructura</a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Even More..</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                        <li class="dropdown-submenu"><a class="dropdown-item" href="#">another
                                                level</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Perfiles y Usuarios</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="/usuarios">Usuarios</a></li>
                                <li class="dropdown-item"><a href="/perfiles">Perfiles</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Hover me for more options</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="#">Second level</a></li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Even More..</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                        <li class="dropdown-submenu"><a class="dropdown-item" href="#">another
                                                level</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Hover me for more options</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="#">Second level</a></li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Even More..</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                        <li class="dropdown-submenu"><a class="dropdown-item" href="#">another
                                                level</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Administracion
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Institucion</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1"
                                        href="infraestructura">Infraestructura</a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Even More..</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                        <li class="dropdown-submenu"><a class="dropdown-item" href="#">another
                                                level</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Perfiles y Usuarios</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="/usuarios">Usuarios</a></li>
                                <li class="dropdown-item"><a href="/perfiles">Perfiles</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Hover me for more options</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="#">Second level</a></li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Even More..</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                        <li class="dropdown-submenu"><a class="dropdown-item" href="#">another
                                                level</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Hover me for more options</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="#">Second level</a></li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Even More..</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                        <li class="dropdown-submenu"><a class="dropdown-item" href="#">another
                                                level</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-item"><a href="#">3rd level</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                                <li class="dropdown-item"><a href="#">Second level</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                        Settings
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        {{-- <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Referencias</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Geograficos</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">Paises</a></li>
                                        <li class="dropdown-item"><a href="#">Departamentos</a></li>
                                        <li class="dropdown-item"><a href="#">Ciudades</a></li>
                                        <li class="dropdown-item"><a href="#">Barrios</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Admisiones</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">Tipos de Admision</a></li>
                                        <li class="dropdown-item"><a href="#">Sub Tipos de Admision</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1" href="infraestructura">Obras
                                        Sociales</a>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1"
                                        href="infraestructura">Instituciones</a>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1" href="infraestructura">Estados
                                        Civiles</a>
                                </li>

                                <li class="dropdown-item"><a tabindex="-1"
                                        href="infraestructura">Nacionalidades</a>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1" href="infraestructura">Tipos de
                                        Documentos</a>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1" href="infraestructura">Generos</a>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1"
                                        href="infraestructura">Diagnosticos</a>
                                </li>


                            </ul>
                        </li> --}}
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#"><i class="fab fa-product-hunt"></i> Products</a>
                            <ul class="dropdown-menu">
                                {{-- <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Geograficos</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">Paises</a></li>
                                        <li class="dropdown-item"><a href="#">Departamentos</a></li>
                                        <li class="dropdown-item"><a href="#">Ciudades</a></li>
                                        <li class="dropdown-item"><a href="#">Barrios</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#">Admisiones</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">Tipos de Admision</a></li>
                                        <li class="dropdown-item"><a href="#">Sub Tipos de Admision</a></li>
                                    </ul>
                                </li> --}}
                                <li class="dropdown-item"><a tabindex="-1" href="/productos_estructura"><i class="fas fa-align-center"></i> Estructura</a>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1" href="/distancias">Distancias</a>
                                </li>
                                <li class="dropdown-item"><a tabindex="-1" href="/importSQLSRV">Importar Distancias SQLSRV</a>
                                </li>
                                
                                {{-- <li class="dropdown-item"><a tabindex="-1" href="/pruebas"> Pruebas SITIOS SQLSRV</a>
                                </li> --}}
                            </ul>
                        </li>
                    </ul>

                </li>
            </ul>

            <usuario-component :user="{{ auth()->user() }}"></usuario-component>

        </div>
        @endauth
    </div>


</nav>