<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" conten            t="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Inicia sesión | Geommo</title>
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css') }}" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>


<body class="d-flex align-items-center py-4 bg-body-tertiary">



    <!-- Notificaciones -->
    <div class="text-center toast-container position-fixed bottom-0 end-0 p-3 w-100">
        <button class="btn" data-bs-dismiss="toast" aria-label="Close">
            <div id="toast_alert" class="toast align-items-center bg-dark" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div>

                    <div class="toast-body text-light"><i class="fa-solid fa-circle-dot"></i>
                        <div id="mensaje"></div>
                    </div>
                </div>
            </div>
        </button>
    </div>


    <main class="form-signin w-100 m-auto">
        <form id="admin" autocomplete="off">
            <!--  <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
            <h1 class="h3 mb-3 fw-normal">Inicia sesión</h1>



            <div class="form-floating">
                <input type="text" name="txtUsuario" class="form-control" id="floatingInput" placeholder="Usuario">
                <label for="floatingInput"><i class="fa-solid fa-user"></i> Usuario</label>
                <div id="e_txtUsuario" class="form-text text-danger m-2"> </div> <div class="valid-feedback">
                    Looks good!
                  </div>
            </div>

            <div class="form-floating">
                <input type="password" name="txtContrasena" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword"><i class="fa-solid fa-lock"></i> Contraseña</label>
                <div id="e_txtContrasena" class="form-text text-danger m-2"> </div>
            </div>



            <div class="form-floating m-3">
                <select id="txtTipo" name="txtTipo" class="form-control" aria-label="Iniciar como:">
                  <option value="1" selected>Usuario</option>
                  <option value="2">Administrador</option>
                </select>
                <label>Iniciar cómo:</label>
            </div>


            @csrf

            <button id="btnEnviar" onclick="iniciarSesion()" class="btn btn-primary w-100 py-2" type="button"><i
                    class="fa-solid fa-right-to-bracket"></i> Iniciar sesión</button>

            <p class="mt-5 mb-3 text-body-secondary">&copy; 2024 fnx</p>

        </form>
    </main>

    <script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/sesion.js') }}"></script>
</body>

</html>
