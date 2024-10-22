<div class="offcanvas-header m-3">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Actualizar credenciales de correo</h5>
    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
</div>
<form id="correo">


    <div class="form-floating  mb-3">
        <input type="text" id="cor_usr"  name="cor_usr" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput"  value="{{ $correo['cor_usr'] }}">
        <label>Correo electrónico</label>
     <div id="e_cor_usr" class="form-text text-danger m-2"> </div>
    </div>


    <div class="form-floating  mb-3">
        <input type="text" id="cor_con"  name="cor_con" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput"  value="{{ $correo['cor_con'] }}" >
        <label>Contraseña</label>
     <div id="e_cor_con" class="form-text text-danger m-2"> </div>
    </div>




    @csrf

    <div class="text-center">
        <button id="btnEnviar" type="button" onclick="cargarClases();" class="btn btn-success ">Aceptar</button>
    </div>
</form>


