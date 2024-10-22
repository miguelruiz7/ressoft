<select class="form-control" multiple="multiple" id="cmbDisponibles" name="cmbDisponibles" size="11" ondblclick="agregar(this.value, document.getElementById('cmbDisponibles').options[document.getElementById('cmbDisponibles').selectedIndex].text, 'cmbDisponibles', 'cmbSeleccionados');">
    @foreach ( $permisosDisponibles as $valor )
    <option value="{{$valor ->per_uuid}}">{{$valor ->per_desc}}</option>
    @endforeach
</select>
