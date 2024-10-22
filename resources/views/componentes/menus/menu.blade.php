<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white text-uppercase">
    <span>Sistema</span>
</h6>

<ul class="list-unstyled ps-0 ">



    <li>
        <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
            data-bs-toggle="collapse" data-bs-target="#divPermisos" aria-expanded="true">
            <h6 class="sidebar-heading    text-white text-uppercase"> <i class="fa-solid fa-user-check"></i> Control de
                permisos </h6>
        </button>

        <div class="collapse" id="divPermisos">
            <ul class="btn-toggle-nav  fw-normal small gap-3">


                @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_per_lec'))
                    <li> <button
                            class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                            data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"
                            onclick="cargarPagina('permisos')">
                            <small> <i class="fa-solid fa-check"></i>
                                Permisos </small>
                        </button>
                    </li>
                @endif

                @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_rol_lec'))
                    <li> <button
                            class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                            data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"
                            onclick="cargarPagina('roles')">
                            <small> <i class="fa-solid fa-book"></i>
                                Roles </small>
                        </button>
                    </li>
                @endif

                @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_rol_lec'))
                    <li> <button
                            class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                            data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"
                            onclick="cargarPagina('rolesAsignacion')">
                            <small> <i class="fa-solid fa-bars-staggered"></i>
                                Permisos por roles </small>
                        </button>
                @endif
    </li>

</ul>
</div>
</li>

<li>
    <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
        data-bs-toggle="collapse" data-bs-target="#divVariables" aria-expanded="true">
        <h6 class="sidebar-heading    text-white text-uppercase"> <i class="fa-solid fa-book"></i> Control de variables
        </h6>
    </button>

    <div class="collapse" id="divVariables">
        <ul class="btn-toggle-nav  fw-normal small gap-3">


          {{--   @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_per_lec'))
                <li> <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                        data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"
                        onclick="cargarPagina('unidades')">
                        <small> <i class="fa-solid fa-scale-unbalanced-flip"></i>
                            Unidades de medida </small>
                    </button>
                </li>
            @endif --}}

         {{--    @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_rol_lec'))
                <li> <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                        data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"
                        onclick="cargarPagina('variables')">
                        <small> <i class="fa-solid fa-square-root-variable"></i>
                            Variables </small>
                    </button>
                </li>
            @endif --}}

          {{--   @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_rol_lec'))
                <li> <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                        data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"
                        onclick="cargarPagina('variablesAsignacion')">
                        <small> <i class="fa-solid fa-bars-staggered"></i>
                            Unidades por variable </small>
                    </button>
            @endif --}}
</li>

</ul>
</div>
</li>



<li>
    <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
        data-bs-toggle="collapse" data-bs-target="#divUsuarios" aria-expanded="true">
        <h6 class="sidebar-heading    text-white text-uppercase"> <i class="fa-solid fa-users"></i> Control de usuarios
        </h6>
    </button>

    <div class="collapse" id="divUsuarios">
        <ul class="btn-toggle-nav  fw-normal small gap-3">

            @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_usu_lec'))
                <li> <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                        data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"
                        onclick="cargarPagina('usuarios')">
                        <small> <i class="fa-solid fa-users-gear"></i>
                            Usuarios </small>
                    </button>
                </li>
            @endif



        </ul>
    </div>
</li>


<li>
    <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
        data-bs-toggle="collapse" data-bs-target="#divSistemas" aria-expanded="true">
        <h6 class="sidebar-heading    text-white text-uppercase"> <i class="fa-solid fa-gears"></i> Control de sistemas
        </h6>
    </button>

    <div class="collapse" id="divSistemas">
        <ul class="btn-toggle-nav  fw-normal small gap-3">


            @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_adm_lec'))
                <li> <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                        data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true"
                        onclick="cargarFormularioClases('admin')">
                        <small> <i class="fa-solid fa-key"></i>
                            Conf. admin </small>
                    </button>
                </li>
            @endif

            @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_cor_lec'))
                <li> <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                        data-bs-dismiss="offcanvas" data-bs-toggle="modal" data-bs-target="#formulariomodal"
                        aria-expanded="true" onclick="cargarFormularioClases('correo')">
                        <small> <i class="fa-solid fa-envelopes-bulk"></i>
                            Conf. correo </small>
                    </button>
                </li>
            @endif


</li>

</ul>
</div>
</li>

</ul>

<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white text-uppercase">
    <span>Plataforma</span>
</h6>



<ul class="list-unstyled ps-0 ">


<li>
    <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
        data-bs-toggle="collapse" data-bs-target="#divDispositivos" aria-expanded="true">
        <h6 class="sidebar-heading    text-white text-uppercase"> {{-- <i class="fa-solid fa-microchip"></i> --}} Item nuevo </h6>
    </button>

    <div class="collapse" id="divDispositivos">
        <ul class="btn-toggle-nav  fw-normal small gap-3">


            @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_dis_lec'))
                <li> <button
                        class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                        data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"
                        onclick="cargarPagina('dispositivos')">
                        <small> <i class="fa-solid fa-tachograph-digital"></i>
                            Dispositivos </small>
                    </button>
                </li>
            @endif

            @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_sen_lec'))
                <li> <button
                        class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                        data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"
                        onclick="cargarPagina('sensores')">
                        <small> <i class="fa-solid fa-weight-scale"></i>
                            Sensores </small>
                    </button>
                </li>
            @endif

            {{-- @if (session()->has('admin_gbl') || \App\Helpers\PermisoHelper::tienePermiso('per_sen_lec'))
                <li> <button
                        class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light gap-2"
                        data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"
                        onclick="cargarPagina('sensoresConfiguracion')">
                        <small> <i class="fa-solid fa-sliders"></i>
                           Config. sensores </small>
                    </button>
            @endif --}}
</li>

</ul>
</div>
</li>



</ul>


