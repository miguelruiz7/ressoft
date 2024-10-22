
function cargarPagina(nombrePagina) {

 /*  Clase para cargar las páginas de forma asíncrona	 */

  $.ajax({
    url:  nombrePagina,
    type: 'GET',
    dataType: 'html',
    method: 'POST',
    data: {
      _token: $('meta[name="csrf-token"]').attr('content'),
    },
    success: function (data) {
      $('#contenedorPrincipal').html(data);
      $('meta[name="pagina"]').attr('content', nombrePagina);
      $('title').text($('#tituloPagina').text() + ' | Geommo');

    },
    error: function (error) {
      muestraMensajes(erroresPagina(error.status));
    }

  });
}




function cargarFormularioClases(modal,valores){

   /*  Clase para cargar los modales de forma asíncrona	 */

  $.ajax({
    url: 'form/'+modal,
    method: 'POST',
    data: {
      valores: valores,
      _token: $('meta[name="csrf-token"]').attr('content'),
     },

    success: function (data) {
      $('#contenedorFormularios').html(data);
    }
  });

}



function cargarClases(clase = null, camposExc = []) {
    /* Clase para cargar los formularios de forma asíncrona para su posterior procesamiento para envío */
    $('#btnEnviar').prop('disabled', true);

    var formularioCheck, formulario;

    // Comprobar si `clase` es null o undefined
    if (clase == null || clase === undefined) {

        formulario = $("form");
        formularioCheck = formulario.attr('id');
    } else {

        formulario = $("#" + clase);
        formularioCheck = formulario.attr('id');
    }




    var pagina = $('meta[name="pagina"]').attr('content');


    if (formulario.length) {
        var formData = new FormData(formulario[0]);

        $.ajax({
            url: 'func/' + formularioCheck,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    revertirFormulario();
                    $('#formulariomodal').modal('hide');

                    if (pagina.trim() !== '') {
                        cargarPagina(pagina);
                    }


                    muestraMensajes(response.mensaje);
                } else {
                    $('#btnEnviar').prop('disabled', false);
                    limpiarCampos(formularioCheck);
                    muestraMensajes(response.mensaje);

                    // Manejo de errores
                    const erroresForm = Object.keys(response.errores);
                    let totalErrores = 0;
                    erroresForm.forEach(key => {
                        totalErrores += response.errores[key].length;
                        $('#e_' + key).html(response.errores[key]);
                    });
                    console.log("Número de errores en el arreglo de errores:", totalErrores);
                }
            },
            error: function(error) {
                $('#btnEnviar').prop('disabled', false);
                muestraMensajes(erroresPagina(error.status));
            }
        });
    } else {
        $('#btnEnviar').prop('disabled', false);
        alert('No se encontró el formulario.');
    }
}




function cerrarSesion() {
  /* La funcion muestra una alerta a traves de un toast de Bootstrap, posteriomente cerrando la sesión del usuario*/
  muestraMensajes('Se cerrará sesión');
  setInterval(function () {
    location.href = 'cerrarSesion';
  }, 1800);
}


//////////////////////////////////////////////////
//                                              //
//           Funciones complementarias          //
//                                              //
//////////////////////////////////////////////////

function verificarLlenos(formulario, camposOmitidos = [], funcion) {
  /* La función verifica que los campos de un formulario se encuentren llenos
  de lo contrario muestra un mensaje */

  const form = document.getElementById(formulario);
  const campos = form.querySelectorAll("input, select, textarea");

  let compruebaCamposLlenos = true;

  console.log(campos);


  campos.forEach((campo) => {
    // Eliminar campos omitidos
    if (camposOmitidos.includes(campo.name)) {

      //campo.parentNode.removeChild(campo);
      compruebaCamposLlenos = true;

      return; // Salir del forEach para evitar procesar campos eliminados
    }

    console.log('Nombre del campo:'+ campo.name + ', valor:'+ campo.value);

    // Verificar si el campo está vacío
    if (campo.value.trim() === "") {

      compruebaCamposLlenos = false;
    }
  });

  if (compruebaCamposLlenos) {
    funcion();
  } else {
    $('#btnEnviar').prop('disabled', false);
    muestraMensajes('Rellena los campos');
  }
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


/* La funcion muestra una alerta a traves de un toast de Bootstrap */
function muestraMensajes(alerta) {
  $("#mensaje").html(alerta);
  $('.toast').toast('show');
}



/* La funcion revierte el formulario como se encontró por defecto */
function revertirFormulario() {
  var spinner = '<div class="container text-center"><div class="spinner-border  text-center" role="status" data-bs-dismiss="modal" aria-label="Close"></div></div>';
  //var spinner = '<div class="text-center"><div role="status"> <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/> </svg><span class="sr-only">Loading...</span> </div></div>';
  $("#contenedorFormularios").html(spinner);
}


/*  window.setTimeout(function() {
                $(".alert").fadeTo(200, 0).slideUp(200, function(){
                    $(this).remove();
                });
            }, 2500); */

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

