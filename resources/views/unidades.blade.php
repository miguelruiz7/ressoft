<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 id="tituloPagina" class="h2">Unidades</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                data-bs-target="#formulariomodal" aria-expanded="true"
                onclick="cargarFormularioClases('unidades')">Agregar</button>
        </div>

    </div>
</div>

<div class="table-responsive small" style="height: 80vh; width: 100%; overflow-y: scroll;">
    <table class="table table-striped table-sm">
        <thead>
            <tr>

                <th scope="col">Descripción del unidad</th>
                <th scope="col">Siglas del unidad</th>
                <th scope="col">Acciones</th>

            </tr>
        </thead>
        <tbody>


            @foreach ($unidades as $valor)
                <tr>
                    <td>{{$valor->un_nom}} </td>
                    <td>{{$valor->un_sgl}} </td>
                    <td>
                        <div class="col text-center">

                            <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#formulariomodal" aria-expanded="true"
                                onclick="cargarFormularioClases('unidadesElim', ['{{ $valor->un_uuid }}'])"><i
                                    class="fa-solid fa-trash"></i></button>



                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

