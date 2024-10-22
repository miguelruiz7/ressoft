<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 id="tituloPagina" class="h2">Unidades por variable</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

            <form id="variablesUnidades">
            <div class="form-floating m-3">
                <select id="txtVar" name="txtVar" class="form-control" aria-label="Iniciar como:" onchange="cargarAsignacionClases('disponibles'); cargarAsignacionClases('seleccionados');">
                  <option value="" selected>Selecciona</option>
                  @foreach ( $variables as $valor )
                  <option value="{{$valor->vmed_uuid}}">{{$valor->vmed_nom}}</option>
                  @endforeach

                </select>
                <label>Variable de medición:</label>
                <div id="e_vmed_uuid" class="form-text text-danger m-2"> </div>
            </div>
            @csrf
        </form>
        </div>

    </div>
</div>


<div class="container px-4" id="featured-3">

<form id="variablesUnidadesGenerar">



    <input type="hidden" name="vmed_un_uuid" id="vmed_un_uuid" value="">
    <input type="hidden" name="vmed_uuid" id="vmed_uuid" value="">
    @csrf


    <div class="row g-4 py-5 row-cols-1 row-cols-lg-2">
      <div class="feature col">
        <h3 class="fs-2 text-body-emphasis">Unidades disponibles</h3>
       <div class="container" id="disponibles">



       </div>
      </div>

      <div class="feature col">

        <h3 class="fs-2 text-body-emphasis">Unidades seleccionadas</h3>

        <div class="container" id="seleccionados">

        </div>

      </div>



    </div>

    <div class="row mb-6">
        <div class="text-center">
            <button id="btnEnviar" type="button" onclick="cargarClases('variablesUnidadesGenerar');" class="btn btn-success "><i class="fa-solid fa-file-export"></i> Guardar cambios</button>
        </div>
    </div>

</form>


  </div>



<script>
    function cargarAsignacionClases(metodo) {
    var formularioCheck = $("form").attr('id');
    var formulario = $("form");

    if (formulario.length) {
        var formData = new FormData(formulario[0]);

        $('#vmed_uuid').val(formData.get('txtVar'));

        formData.append('txtMetodo', metodo);

        $.ajax({
            url: 'func/' + formularioCheck,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#' + metodo).html(response);
                formulario = $("#cmbSeleccionados");
                formularioCheck = formulario.attr('id');

                if(metodo == 'seleccionados'){

                var select = formulario[0];

                    var values = [];
                    for (var i = 0; i < select.options.length; i++) {
                        values.push(select.options[i].value);
                    }
                    $('#vmed_un_uuid').val(values.join(', '));
            }

            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud:', status, error);
            }
        });
    } else {
        console.error('No se encontró ningún formulario.');
    }
}

function agregar(id, valor, objeto2, objeto1){
          var x = document.getElementById(objeto1);
          var option = document.createElement("option");
          option.text = valor;
          option.value = id;
          x.add(option);
          quitar(id,objeto2);
       }

       function quitar(id,objeto2){
        var selectobject = document.getElementById(objeto2);
        for (var i=0; i<selectobject.length; i++) {
            if (selectobject.options[i].value == id)
                selectobject.remove(i);
        }

        var selectobject = document.getElementById('cmbSeleccionados');
        var seleccionados='';
        for (var i=0; i<selectobject.length; i++) {
            seleccionados+=selectobject.options[i].value+',';
        }
        seleccionados=seleccionados.substring(0, seleccionados.length -1);
        document.getElementById('vmed_un_uuid').value=seleccionados
       }








</script>

