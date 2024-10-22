<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white text-uppercase">
    <span>Sistema</span>
</h6>

<ul class="nav flex-column">

    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_per_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-dismiss="offcanvas"
                data-bs-target="#sidebarMenu" aria-label="Close" onclick="cargarPagina('permisos')">
                <i class="fa-solid fa-check"></i>
                Permisos
            </button>
        </li>
    @endif

    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_rol_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-dismiss="offcanvas"
                data-bs-target="#sidebarMenu" aria-label="Close" onclick="cargarPagina('roles')">
                <i class="fa-solid fa-book"></i>
                Roles
            </button>
        </li>
    @endif

    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_rol_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-dismiss="offcanvas"
                data-bs-target="#sidebarMenu" aria-label="Close" onclick="cargarPagina('rolesAsignacion')">
                <i class="fa-solid fa-address-book"></i>
                Permisos por roles
            </button>
        </li>
    @endif

    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_usu_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-dismiss="offcanvas"
                data-bs-target="#sidebarMenu" aria-label="Close" onclick="cargarPagina('usuarios')">
                <i class="fa-solid fa-users"></i>
                Usuarios
            </button>
        </li>
    @endif


    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_uni_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-dismiss="offcanvas"
                data-bs-target="#sidebarMenu" aria-label="Close" onclick="cargarPagina('unidades')">
                <i class="fa-solid fa-scale-unbalanced-flip"></i>
                Unidades de medida
            </button>
        </li>
    @endif


    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_uni_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-dismiss="offcanvas"
                data-bs-target="#sidebarMenu" aria-label="Close" onclick="cargarPagina('variables')">
                <i class="fa-solid fa-square-root-variable"></i>
                Var. de medicion
            </button>
        </li>
    @endif


    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_uni_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-dismiss="offcanvas"
                data-bs-target="#sidebarMenu" aria-label="Close" onclick="cargarPagina('variablesAsignacion')">
                <i class="fa-solid fa-book"></i>
                Unidades por variable
            </button>
        </li>
    @endif



    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_adm_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-toggle="modal"
                data-bs-target="#formulariomodal" aria-expanded="true" onclick="cargarFormularioClases('admin')">
                <i class="fa-solid fa-key"></i>
                Act. credenciales (admin)
            </button>
        </li>
    @endif

    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_cor_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-toggle="modal"
                data-bs-target="#formulariomodal" aria-expanded="true" onclick="cargarFormularioClases('correo')">
                <i class="fa-solid fa-envelopes-bulk"></i>
                Act. correo con.
            </button>
        </li>
    @endif



</ul>

<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white text-uppercase">
    <span>Plataforma </span>
</h6>



<ul class="nav flex-column">

    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_dis_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-dismiss="offcanvas"
                data-bs-target="#sidebarMenu" aria-label="Close" onclick="cargarPagina('dispositivos')">
                <i class="fa-solid fa-tachograph-digital"></i>
                Dispositivos
            </button>
        </li>
    @endif

    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_sen_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-dismiss="offcanvas"
                data-bs-target="#sidebarMenu" aria-label="Close" onclick="cargarPagina('sensores')">
                <i class="fa-solid fa-weight-scale"></i>
                Sensores
            </button>
        </li>
    @endif


    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_sen_lec'))
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center fw-light text-white gap-2" data-bs-dismiss="offcanvas"
                data-bs-target="#sidebarMenu" aria-label="Close" onclick="cargarPagina('sensores')">
                <i class="fa-solid fa-sliders"></i>
                Sensores (Configuración)
            </button>
        </li>
    @endif


</ul>
