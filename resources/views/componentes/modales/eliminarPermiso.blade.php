<div class="text-center m-4">
    <h5 class="offcanvas-title " id="offcanvasExampleLabel">¿Estás seguro que deseas eliminar el permiso?
    </h5>
</div>
<div class="text-center">
    <form id="permisosElim">
        <input type="hidden" name="per_uuid" value="{{$id}}">
        <button id="btnEnviar" type="button" onclick="cargarClases()" class="btn btn-danger">Aceptar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cancelar</button>
        @csrf
    </form>
</div>
