<select class="form-control" id="cmbSeleccionados" multiple="multiple" name="cmbSeleccionados" size="11" ondblclick="agregar(this.value, document.getElementById('cmbSeleccionados').options[document.getElementById('cmbSeleccionados').selectedIndex].text, 'cmbSeleccionados', 'cmbDisponibles');">
    @foreach ( $unidadesSeleccionados as $valor )
    <option value="{{$valor ->vmed_un_uuid}}">{{$valor ->un_nom}} ({{$valor ->un_sgl}})</option>
    @endforeach
</select>
