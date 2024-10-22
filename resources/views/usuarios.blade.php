<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 id="tituloPagina" class="h2">Usuarios</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                data-bs-target="#formulariomodal" aria-expanded="true"
                onclick="cargarFormularioClases('usuarios')">Agregar</button>
        </div>

    </div>
</div>

<div class="table-responsive small" style="height: 80vh; width: 100%; overflow-y: scroll;">
    <table class="table table-striped table-sm">
        <thead>
            <tr>

                <th scope="col">Nombre del usuario</th>
                <th scope="col">Rol</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>

            </tr>
        </thead>
        <tbody>


            @foreach ($usuarios as $valor)
                <tr>
                    <td>{{$valor->usr_nom}} </td>
                    <td>{{$valor->rol_nom}}</td>
                    <td><?php echo $valor->usr_vis == 1 ? 'Activo' : 'Inactivo'; ?></td>
                    <td>
                        <div class="col text-center">

                            <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#formulariomodal" aria-expanded="true"
                                onclick="cargarFormularioClases('usuariosElim', ['{{ $valor->usr_uuid }}'])"><i
                                    class="fa-solid fa-trash"></i></button>


                            <button class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#formulariomodal" aria-expanded="true"
                            onclick="cargarFormularioClases('usuariosAct', ['{{ $valor->usr_uuid }}'])"><i
                            class="fa-solid fa-pen-to-square"></i></button>



                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

