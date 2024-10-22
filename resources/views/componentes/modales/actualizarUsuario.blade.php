<div class="offcanvas-header m-3">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Actualizar usuario</h5>
    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
</div>
<form id="usuariosAct">

    <input type="hidden" id="usr_uuid"  name="usr_uuid" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput"  value="{{$usuario->usr_uuid}}">

    <div class="form-floating  mb-3">
        <input type="text" id="usr_nom"  name="usr_nom" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput"  value="{{$usuario->usr_nom}}">
        <label>Nombre de pila</label>
     <div id="e_usr_nom" class="form-text text-danger m-2"> </div>
    </div>

 {{--    <div class="form-floating  mb-3">
        <input type="text" id="usr_usu"  name="usr_usu" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput">
        <label>Nombre de usuario</label>
     <div id="e_usr_usu" class="form-text text-danger m-2"> </div>
    </div> --}}



    <div class="form-floating mb-3">
        <select id="usr_rol_uuid" name="usr_rol_uuid" class="form-select form-control border-bottom border-0 border-bottom-2 rounded-0">
            <option value="">Selecciona: </option>

            @foreach($roles as $valor)
            <option value="{{ $valor->rol_uuid }}" {{ old('usr_rol_uuid', $usuario->usr_rol_uuid) == $valor->rol_uuid ? 'selected' : '' }}>
                {{ $valor->rol_nom }}
            </option>
            @endforeach

        </select>
        <label>Selecciona el rol de usuario</label>
        <div id="e_usr_rol_uuid" class="form-text text-danger m-2"> </div>
    </div>



    <div class="form-floating mb-3">
        <select id="usr_vis" name="usr_vis" class="form-select form-control border-bottom border-0 border-bottom-2  rounded-0">
            <option value="">Selecciona: </option>
            <option value="0" {{ old('usr_vis', $usuario->usr_vis) == '0' ? 'selected' : '' }} >Desactivado</option>
            <option value="1" {{ old('usr_vis', $usuario->usr_vis) == '1' ? 'selected' : '' }} >Activado</option>
        </select>
        <label>Visibilidad del usuario</label>
        <div id="e_usr_vis" class="form-text text-danger m-2"> </div>
    </div>


    <div class="form-floating  mb-3">
        <input type="password" id="usr_con"  name="usr_con" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput" >
        <label>Contraseña</label>
     <div id="e_usr_con" class="form-text text-danger m-2"> </div>
    </div>

    <div class="form-floating  mb-3">
        <input type="password" id="usr_con_"  name="usr_con_" class="form-control border-bottom border-0 border-bottom-2  bg-transparent rounded-0 " id="floatingInput">
        <label>Contraseña</label>
     <div id="e_usr_con_" class="form-text text-danger m-2"> </div>
    </div>



    @csrf

    <div class="text-center">
        <button id="btnEnviar" type="button" onclick="cargarClases();" class="btn btn-success ">Aceptar</button>
    </div>
</form>


