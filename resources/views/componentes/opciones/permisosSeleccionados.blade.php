<select class="form-control" id="cmbSeleccionados" multiple="multiple" name="cmbSeleccionados" size="11" ondblclick="agregar(this.value, document.getElementById('cmbSeleccionados').options[document.getElementById('cmbSeleccionados').selectedIndex].text, 'cmbSeleccionados', 'cmbDisponibles');">
    @foreach ( $permisosSeleccionados as $valor )
    <option value="{{$valor ->rol_per_uuid}}">{{$valor ->per_desc}}</option>
    @endforeach
</select>
