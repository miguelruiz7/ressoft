<select class="form-control" multiple="multiple" id="cmbDisponibles" name="cmbDisponibles" size="11" ondblclick="agregar(this.value, document.getElementById('cmbDisponibles').options[document.getElementById('cmbDisponibles').selectedIndex].text, 'cmbDisponibles', 'cmbSeleccionados');">
    @foreach ( $unidadesDisponibles as $valor )
    <option value="{{$valor ->un_uuid}}">{{$valor ->un_nom}} ({{$valor ->un_sgl}})</option>
    @endforeach
</select>
