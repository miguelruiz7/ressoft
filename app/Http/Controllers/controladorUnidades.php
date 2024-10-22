<?php

namespace App\Http\Controllers;

use App\Models\un_mst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class controladorUnidades extends Controller
{
    protected $ctrlPermisos;

    public function __construct()
    {
        // Inicializa la instancia del controlador de sesión
        $this->ctrlPermisos = new controladorSesion();
    }

    public function ver()
    {
        if ($this->ctrlPermisos->recuperarRoles('per_uni_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
        }

            $unidades = un_mst::orderBy('un_nom', 'asc')->get();
            return view("unidades", compact('unidades'));

    }

    public function agregarModal()
    {

        if ($this->ctrlPermisos->recuperarRoles('per_uni_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
            return view("componentes/modales/agregarUnidad");

    }

    public function agregar(Request $solicitud)
    {

        $datos = $solicitud->all();

        $reglas = [
            'un_nom' => 'required|string|min:4|max:80',
            'un_sgl' => 'required|string',
            'un_tpo' => 'required|numeric|min:0|max:1',
        ];

        $mensajesAlternativos = [
            'required' => 'Campo requerido',
            'un_tpo.min' => 'Valor no válido',
            'un_tpo.max'=> 'Valor no válido'
        ];

        $validarCampos = Validator::make($solicitud->all(), $reglas, $mensajesAlternativos);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }


        if ($this->ctrlPermisos->recuperarRoles('per_uni_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }


        $uuid = uniqid();

        $unidad = new un_mst();
        $unidad->un_uuid = $uuid;
        $unidad->un_nom = $solicitud['un_nom'];
        $unidad->un_sgl = $solicitud['un_sgl'];
        $unidad->un_tpo = $solicitud['un_tpo'];
        $unidad->save();

        return response()->json(['success' => true, 'mensaje' => 'Se agregó la unidad correctamente']);



    }

    public function eliminarModal(Request $peticion)
    {
        if ($this->ctrlPermisos->recuperarRoles('per_uni_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }

        $id = $peticion->valores[0];
        $unidad = un_mst::find($id);

        if ($unidad) {
            return view('componentes/modales/eliminarUnidad', compact('id'));
        } else {
            $mensaje = 'No se puede eliminar el permiso';
            $solucion = 'Verifica la existencia del permiso';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
    }

    public function eliminar(Request $peticion)
    {
        if ($this->ctrlPermisos->recuperarRoles('per_uni_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }

        $id = $peticion->per_uuid;
        $unidad = un_mst::find($id);

        if ($unidad) {
            $unidad->delete();
            return response()->json(['success' => true, 'mensaje' => 'Unidad eliminado correctamente']);
        } else {
            $mensaje = 'No se puede eliminar la unidad';
            $solucion = 'Verifica la existencia de la unidad';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
    }
}
