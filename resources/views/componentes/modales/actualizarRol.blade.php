<div class="offcanvas-header m-3">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Actualizar rol</h5>
    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
</div>
<form id="rolesAct">

    <input type="hidden" id="rol_uuid"  name="rol_uuid" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput"  value="{{$rol->rol_uuid}}">

    <div class="form-floating  mb-3">
        <input type="text" id="rol_nom"  name="rol_nom" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput" value="{{$rol->rol_nom}}">
        <label>Nombre</label>
     <div id="e_rol_nom" class="form-text text-danger m-2"> </div>
    </div>

    <div class="form-floating  mb-3">
        <input type="text" id="rol_desc"  name="rol_desc" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput"  value="{{$rol->rol_desc}}">
        <label>Descripción breve</label>
     <div id="e_rol_desc" class="form-text text-danger m-2"> </div>
    </div>

    <div class="form-floating mb-3">
        <select id="rol_vis" name="rol_vis" class="form-select form-control border-bottom border-0 border-bottom-2  rounded-0">
            <option value="">Selecciona: </option>
            <option value="0" {{ old('rol_vis', $rol->rol_vis) == '0' ? 'selected' : '' }}>Desactivado</option>
            <option value="1" {{ old('rol_vis', $rol->rol_vis) == '1' ? 'selected' : '' }}>Activado</option>
        </select>
        <label>Visibilidad del rol</label>
        <div id="e_rol_vis" class="form-text text-danger m-2"> </div>
    </div>



    @csrf

    <div class="text-center">
        <button id="btnEnviar" type="button" onclick="cargarClases();" class="btn btn-success ">Aceptar</button>
    </div>
</form>


