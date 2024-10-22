<!doctype html>
<html lang="es" data-bs-theme="light">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="pagina" content="">
    <title>Administrador | Web</title>
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>

<body>

    <!-- Notificaciones -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3 w-100">
        <button class="btn" data-bs-dismiss="toast" aria-label="Close">
            <div id="toast_alert" class="toast align-items-center bg-dark" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div>
                    <div class="toast-body text-light"><i class="fa-solid fa-circle-dot"></i>
                        <div id="mensaje"></div>
                    </div>
                    <!-- <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button> -->
                </div>
            </div>
        </button>
    </div>



    <header id="encabezado" class="navbar  sticky-top flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white"><i class="fa-solid fa-tv"></i> Ressoft
            <small>v2.0</small></a>

        <ul class="navbar-nav flex-row d-md-none">

            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </li>
        </ul>


    </header>



    <div class="container-fluid">
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-dark overflow-y-auto"
                style="
   /*  height: 98vh; */
">
                <div class="offcanvas-md offcanvas-end bg-dark " tabindex="-1" id="sidebarMenu"
                    aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">Ressoft <small>v1.0</small></h5>
                        <button type="button" class="btn btn-close text-white" data-bs-dismiss="offcanvas"
                            data-bs-target="#sidebarMenu" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">

                        <div class="mb-0 container-fluid bg-none text-center p-3 border-bottom">



                            <svg class="bd-placeholder-img rounded-circle" width="50" height="50"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="white"></rect><text x="40%" y="52%"
                                    fill="#084f88" dy=".3em">{{ Str::substr($usuario['usr_nom'], 0, 1) }}</text>
                            </svg>
                            <h5 class="fw-light text-light m-3">{{ $usuario['usr_nom'] }}</h5>
                            <h6 class="fw-light text-light m-3">({{ $usuario['rol_nom'] }})</h6>

                        </div>

                        @include('componentes.menus.menu')


                        <hr class="my-3">

                        <ul class="nav flex-column mb-auto">

                            <li class="nav-item">
                                <button class="nav-link d-flex align-items-center fw-light text-white gap-2"
                                    onclick="cerrarSesion()">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    Cerrar sesión
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <main id="contenedorPrincipal" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


            </main>

            <!-- Contenedor formularios -->
            <div class="modal fade" id="formulariomodal" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content" id="contenidoformulario">
                        <div class="modal-body m-3">
                            <div id="notificacionesform" class="sticky-top"></div>
                            <div id="contenedorFormularios">
                                <!-- Se vaciará el contenido del formulario -->
                                <div class="container text-center">
                                    <div class="spinner-border  text-center" role="status" data-bs-dismiss="modal"
                                        aria-label="Close"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Finaliza contenedor formulario -->

        </div>
    </div>

    <script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</html>
