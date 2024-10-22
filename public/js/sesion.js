/* La funcion se encarga de enviar los datos para el acceso al sistema  */



function iniciarSesion(camposExc = []) {
    /*  Clase para cargar los formularios de forma asíncrona para su posterior
    procesamiento para envió	 */
    $('#btnEnviar').prop('disabled', true);

  var formularioCheck = $("form").attr('id');
  var formulario = $("form");
  var pagina = $('meta[name="pagina"]').attr('content')

  if (formulario.length) {
    var formData = new FormData(formulario[0]);

    $.ajax({
      url: 'acceso',
      type: 'POST',
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        if(response.success) {
        muestraMensajes(response.mensaje);

        setInterval(function () {
            location.href = '/';
          }, 1800);


        } else {
        $('#btnEnviar').prop('disabled', false);
         limpiarCampos(formularioCheck);
        muestraMensajes(response.mensaje);
        const erroresForm = Object.keys(response.errores);
        let totalErrores = 0;
        erroresForm.forEach(key => {
            totalErrores += response.errores[key].length;
            $('#e_'+key+'').html(response.errores[key]);
        });
        console.log("Número de errores en el arreglo de errores:", totalErrores);
        }

      },
      error: function(error) {
        $('#btnEnviar').prop('disabled', false);
        muestraMensajes(erroresPagina(error.status));
      }
    });

  }
  }



//////////////////////////////////////////////////
//                                              //
//           Funciones complementarias          //
//                                              //
//////////////////////////////////////////////////


/* La funcion verifica que los campos de un formulario se encuentren llenos de lo contrario
  muestra un mensaje */

function verificarllenos(formulario, funcion) {
  const form = document.getElementById(formulario);

  const fields = form.querySelectorAll("input");


  let allFieldsFilled = true;
  fields.forEach((field) => {
    if (field.value.trim() === "") {
      allFieldsFilled = false;
    }
  });



  if (allFieldsFilled) {
    funcion();
  } else {
    muestraMensajes('Rellena los campos');
  }
}


/* Activa el mensaje a traves de modificacion de clases en un selector  */

function muestraMensajes(alerta) {
  //Se establece el mensaje en la etiqueta
  $("#mensaje").html(alerta);
  $('.toast').toast('show');
}

function limpiarCampos(formulario) {
  /* La función limpia los errores del formulario */

  const form = document.getElementById(formulario);
  const campos = form.querySelectorAll("input, select, textarea");
 // console.log(campos);
  campos.forEach((campo) => {
    $('#e_'+campo.name+'').html('');
  });

}

function erroresPagina(codigo) {
    switch (codigo) {
      case 0:
        return 'Sin conexión a red, o el servidor se encuentra fuera de servicio';
      case 404:
        return 'Página no encontrada';
      case 403:
        return 'Acceso prohibido';
      case 405:
        return 'Método no permitido';
      case 419:
        return 'La sesión ha expirado';
      case 422:
        return 'El contenido media no se puede procesar verifique que sea del la extensión y tamaños permitidos';
      case 500:
        return 'Error interno del servidor';
      case 503:
        return 'Servicio no disponible temporalmente';
      default:
        return 'Error desconocido';
    }
  }
