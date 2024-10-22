<?php

namespace App\Http\Controllers;

use App\Models\per_mst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class controladorPermisos extends Controller
{
    protected $ctrlPermisos;

    public function __construct()
    {
        // Inicializa la instancia del controlador de sesión
        $this->ctrlPermisos = new controladorSesion();
    }

    public function ver()
    {
        if ($this->ctrlPermisos->recuperarRoles('per_per_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
        }

            $permisos = per_mst::orderBy('per_sgl', 'asc')->get();
            return view("permisos", compact('permisos'));

    }

    public function agregarModal()
    {

        if ($this->ctrlPermisos->recuperarRoles('per_per_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
            return view("componentes/modales/agregarPermiso");

    }

    public function agregar(Request $solicitud)
    {

        $datos = $solicitud->all();

        $reglas = [
            'per_nom' => 'required|string|min:4|max:80|regex:/^[\pL\s]+$/u',
            'per_sigl' => 'required|string|min:3|max:80',
           /*  'per_per' => 'required|numeric|min:1|max:2', */
        ];

        $mensajesAlternativos = [
            'required' => 'Campo requerido',
            'per_sigl.min' => 'Debe contener al menos :min',
            'per_sigl.max'=> 'Debe contener como máximo :max',
           /*  'per_per.min' => 'Valor no válido',
            'per_per.max'=> 'Valor no válido', */
            'per_nom.regex'=> 'Solo admite caracteres de tipo letra',
        ];

        $validarCampos = Validator::make($solicitud->all(), $reglas, $mensajesAlternativos);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }


        if ($this->ctrlPermisos->recuperarRoles('per_per_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }

        $permisos = [
            ['nombre' => 'Lectura en ', 'codigo' => 'lec'],
            ['nombre' => 'Escritura en ', 'codigo' => 'esc']
        ];

        foreach($permisos as $permiso){
            $uuid = uniqid();

            $acceso_cod = $permiso['codigo'];
            $acceso_desc = $permiso['nombre'];

            $siglas = 'per_'.$datos['per_sigl'].'_'.$acceso_cod;

            $permiso = new per_mst();
            $permiso->per_uuid = $uuid;
            $permiso->per_desc = $acceso_desc.' '.strtolower($datos['per_nom']);
            $permiso->per_sgl = $siglas;
            $permiso->save();

        }



       /* $uuid = uniqid();
        $acceso = $datos['per_per'] == 1 ? 'lec' : 'esc';
        $acceso_desc = $datos['per_per'] == 1 ? 'Lectura en' : 'Escritura en';
        $siglas = 'per_'.strtolower(substr($datos['per_nom'], 0, 3)).'_'.$acceso;
        $permiso = new per_mst();
        $permiso->per_uuid = $uuid;
        $permiso->per_desc = $acceso_desc.' '.strtolower($datos['per_nom']);
        $permiso->per_sgl = $siglas;
        $permiso->save(); */

        return response()->json(['success' => true, 'mensaje' => 'Se agregó el permiso correctamente']);



    }

    public function eliminarModal(Request $peticion)
    {
        if ($this->ctrlPermisos->recuperarRoles('per_per_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }

        $id = $peticion->valores[0];
        $permiso = per_mst::find($id);

        if ($permiso) {
            return view('componentes/modales/eliminarPermiso', compact('id'));
        } else {
            $mensaje = 'No se puede eliminar el permiso';
            $solucion = 'Verifica la existencia del permiso';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
    }

    public function eliminar(Request $peticion)
    {
        if ($this->ctrlPermisos->recuperarRoles('per_per_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }

        $id = $peticion->per_uuid;
        $permiso = per_mst::find($id);

        if ($permiso) {
            $permiso->delete();
            return response()->json(['success' => true, 'mensaje' => 'Permiso eliminado correctamente']);
        } else {
            $mensaje = 'No se puede eliminar el permiso';
            $solucion = 'Verifica la existencia del permiso';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
    }
}
