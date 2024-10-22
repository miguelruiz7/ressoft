<div class="offcanvas-header m-3">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Actualizar credenciales de administrador</h5>
    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
</div>
<form id="admin">


    <div class="form-floating  mb-3">
        <input type="text" id="admin_usr"  name="admin_usr" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput"  value="{{ $administrador['admin_usr'] }}">
        <label>Nombre de usuario nuevo</label>
     <div id="e_admin_usr" class="form-text text-danger m-2"> </div>
    </div>


    <div class="form-floating  mb-3">
        <input type="password" id="admin_con"  name="admin_con" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput" >
        <label>Contraseña</label>
     <div id="e_admin_con" class="form-text text-danger m-2"> </div>
    </div>

    <div class="form-floating  mb-3">
        <input type="password" id="admin_con_"  name="admin_con_" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput">
        <label>Contraseña</label>
     <div id="e_admin_con_" class="form-text text-danger m-2"> </div>
    </div>



    @csrf

    <div class="text-center">
        <button id="btnEnviar" type="button" onclick="cargarClases();" class="btn btn-success ">Aceptar</button>
    </div>
</form>


