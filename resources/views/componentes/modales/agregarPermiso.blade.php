<div class="offcanvas-header m-3">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Agregar un nuevo permiso</h5>
    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
</div>
<form id="permisos">

    <div class="form-floating  mb-3">
        <input type="text" id="per_nom"  name="per_nom" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput">
        <label>Nombre del proceso o módulo</label>
     <div id="e_per_nom" class="form-text text-danger m-2"> </div>
    </div>

    <div class="form-floating  mb-3">
        <input type="text" id="per_sigl"  name="per_sigl" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput">
        <label>Siglas del modulo (Ejemplo: usr,mod2,act)</label>
     <div id="e_per_sigl" class="form-text text-danger m-2"> </div>
    </div>



  {{--   <div class="form-floating mb-3">
        <select id="per_per" name="per_per" class="form-select form-control border-bottom border-0 border-bottom-2  rounded-0">
            <option value="">Selecciona: </option>
            <option value="1">Lectura</option>
            <option value="2">Escritura</option>
        </select>
        <label>Acceso a:</label>
        <div id="e_per_per" class="form-text text-danger m-2"> </div>
    </div> --}}



    @csrf

    <div class="text-center">
        <button id="btnEnviar" type="button" onclick="cargarClases();" class="btn btn-success ">Aceptar</button>
    </div>
</form>


