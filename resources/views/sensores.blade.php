<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 id="tituloPagina" class="h2">Sensores</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                data-bs-target="#formulariomodal" aria-expanded="true"
                onclick="cargarFormularioClases('sensores')">Agregar</button>
        </div>

    </div>
</div>

<div class="table-responsive small" style="height: 80vh; width: 100%; overflow-y: scroll;">
    <table class="table table-striped table-sm">
        <thead>
            <tr>

                <th scope="col">Nombre del sensor</th>
                <th scope="col">Descripción del sensor</th>
                <th scope="col">Imagen</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>

            </tr>
        </thead>
        <tbody>


      @foreach ($sensores as $valor)
                <tr>
                    <td>{{$valor->sen_nom}} </td>
                    <td>{{$valor->sen_desc}} </td>
                    <td>
                        <img class="bd-placeholder-img" src="{{asset('img/sen/'.$valor->sen_img)}}" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect>
                     </td>
                    <td><?php echo $valor->sen_vis == 1 ? 'Activo' : 'Inactivo'; ?></td>
                    <td>
                        <div class="col text-center">

                            <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#formulariomodal" aria-expanded="true"
                                onclick="cargarFormularioClases('sensoresElim', ['{{ $valor->sen_uuid }}'])"><i
                                    class="fa-solid fa-trash"></i></button>

                                <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#formulariomodal" aria-expanded="true"
                                onclick="cargarFormularioClases('sensoresAct', ['{{ $valor->sen_uuid }}'])"><i
                                class="fa-solid fa-pen-to-square"></i></button>



                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

