<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 id="tituloPagina" class="h2">Variables de medición</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                data-bs-target="#formulariomodal" aria-expanded="true"
                onclick="cargarFormularioClases('variables')">Agregar</button>
        </div>

    </div>
</div>

<div class="table-responsive small" style="height: 80vh; width: 100%; overflow-y: scroll;">
    <table class="table table-striped table-sm">
        <thead>
            <tr>

                <th scope="col">Nombre de la variable</th>
                <th scope="col">Descripción de la variable</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>

            </tr>
        </thead>
        <tbody>


            @foreach ($variables as $valor)
                <tr>
                    <td>{{$valor->vmed_nom}} </td>
                    <td>{{$valor->vmed_desc}} </td>
                    <td><?php echo $valor->vmed_vis == 1 ? 'Activo' : 'Inactivo'; ?></td>
                    <td>
                        <div class="col text-center">

                            <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#formulariomodal" aria-expanded="true"
                                onclick="cargarFormularioClases('variablesElim', ['{{ $valor->vmed_uuid }}'])"><i
                                    class="fa-solid fa-trash"></i></button>

                                    <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#formulariomodal" aria-expanded="true"
                                    onclick="cargarFormularioClases('variablesAct', ['{{ $valor->vmed_uuid }}'])"><i
                                    class="fa-solid fa-pen-to-square"></i></button>



                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

