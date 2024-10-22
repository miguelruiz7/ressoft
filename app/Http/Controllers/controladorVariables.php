<?php

namespace App\Http\Controllers;

use App\Models\un_mst;
use App\Models\vmed_mst;
use App\Models\vmed_det;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class controladorVariables extends Controller
{

    protected $ctrlPermisos;

    public function __construct()
    {
        // Inicializa la instancia del controlador de sesión
        $this->ctrlPermisos = new controladorSesion();
    }


    public function ver()
    {

        if (!$this->ctrlPermisos->recuperarRoles('per_var_lec')) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
        }





            $variables = vmed_mst::orderBy('vmed_nom', 'asc') ->get();


        return view('variables', compact('variables'));
    }

  public function verAsignaciones(){

        if ($this->ctrlPermisos->recuperarRoles('per_var_lec') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
        }

        $variables = vmed_mst::orderBy('vmed_nom', 'asc') ->get();

        return view("variablesAsignacion", compact('variables'));
    }



    public function variablesUnidades(Request $solicitud){

        if ($this->ctrlPermisos->recuperarRoles('per_var_lec') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
        }

        $datos = $solicitud->all();

        switch ($datos['txtMetodo']){
            case 'disponibles':
                $unidadesDisponibles = un_mst::whereNotIn('un_uuid', function($query) use ($datos) {
                    $query->select('vmed_un_uuid')
                        ->from('vmed_dets')
                        ->where('vmed_vmed_uuid', $datos['txtVar']);
                })->get();

                return view("componentes/opciones/unidadesDisponibles", compact('unidadesDisponibles'));

            case 'seleccionados':
                $unidadesSeleccionados = vmed_det::where('vmed_vmed_uuid', $datos['txtVar'])
                ->join('un_msts', 'vmed_dets.vmed_un_uuid', '=', 'un_msts.un_uuid')
                ->select('vmed_dets.*', 'un_msts.un_sgl', 'un_msts.un_nom', 'un_msts.un_uuid')
                ->get();

                return view("componentes/opciones/unidadesSeleccionados", compact('unidadesSeleccionados'));

            default:

        }




    }

    public function variablesUnidadesGenerar(Request $solicitud){
        $datos = $solicitud->all();

        $mensajes = [];
        $reglas = [
           'vmed_uuid' => 'required',

        ];

        $mensajesAlternativos = [
            'required' => 'Selecciona la variable',
            'uuid' => 'Formato del identificador incorrecto',
        ];

        $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

        $validarCampos = Validator::make($solicitud->all(), $reglas, $mensajesCombinados);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }


        if ($this->ctrlPermisos->recuperarRoles('per_var_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }



        $permisosNuevos = explode(',', $datos['vmed_un_uuid']);



        $permisosActuales = vmed_det::where('vmed_vmed_uuid', $datos['vmed_uuid'])
                                   ->pluck('vmed_un_uuid')
                                   ->toArray();


        $permisosAEliminar = array_diff($permisosActuales, $permisosNuevos);


        $permisosAAgregar = array_diff($permisosNuevos, $permisosActuales);


        if(count($permisosNuevos) < count($permisosActuales)) {

        if (!empty($permisosAEliminar)) {

            vmed_det::where('vmed_vmed_uuid', $datos['vmed_uuid'])
                   ->whereIn('vmed_un_uuid', $permisosAEliminar)
                   ->delete();
        }
      }



        if($datos['vmed_un_uuid'] != ''  ){

        foreach ($permisosAAgregar as $permiso) {
            $uuid = uniqid();

            $unidad_variable = new vmed_det();
            $unidad_variable->vmed_uuid_ = $uuid;
            $unidad_variable->vmed_un_uuid = $permiso;
            $unidad_variable->vmed_vmed_uuid = $datos['vmed_uuid'];
            $unidad_variable->save();
        }
    }

        return response()->json(['success' => true, 'mensaje' => 'Se actualizaron las variables correctamente']);
    }




    public function agregarModal(){
        if ($this->ctrlPermisos->recuperarRoles('per_var_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }

        return view("componentes/modales/agregarVariable");
    }


    public function agregar(Request $solicitud){
        $datos = $solicitud->all();

        $mensajes = [];
        $reglas = [
           'vmed_nom' => 'required|string|max:80|regex:/^[\pL\s]+$/u',
           'vmed_desc' => 'required|string|min:2|max:255',
           'vmed_vis' => 'required|numeric|min:0|max:1'

        ];

        $mensajesAlternativos = [
            'required' => 'Campo requerido',
            'vmed_vis.min' => 'Valor no válido',
            'max' => 'El campo require un maximo de :max caracteres',
            'min' => 'El campo requiere de mínimo de :min caracteres',
            'vmed_vis.max'=> 'Valor no válido',
            'vmed_nom.regex'=> 'Solo admite caracteres de tipo letra',
        ];

        $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

        $validarCampos = Validator::make($solicitud->all(), $reglas, $mensajesCombinados);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }


        if ($this->ctrlPermisos->recuperarRoles('per_var_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }



        $uuid = uniqid();




        $rol = new vmed_mst();
        $rol -> vmed_uuid = $uuid;
        $rol -> vmed_nom = $datos['vmed_nom'];
        $rol -> vmed_desc = $datos['vmed_desc'];
        $rol -> vmed_vis = $datos['vmed_vis'];
        $rol -> save();

        return response()->json(['success' => true, 'mensaje' => 'Se agregó la variable correctamente']);



    }

    public function eliminarModal(Request $peticion){
        /* Muestra un modal para eliminar el contenido red */
        if ($this->ctrlPermisos->recuperarRoles('per_var_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }


        $id = $peticion->valores[0];
        $rol = vmed_mst::find($id);

        if ($rol) {
            return view('componentes/modales/eliminarVariable', compact('id'));
        }else{
            $mensaje = 'No se puede eliminar el rol';
            $solucion = 'Verifica la existencia del rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
  }


  public function eliminar(Request $peticion){

    if ($this->ctrlPermisos->recuperarRoles('per_var_esc') == false) {
        return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
    }


    $id = $peticion->vmed_uuid;
    $variable = vmed_mst::find($id);
    if ($variable) {

        $variable->delete();
        return response()->json(['success' => true,'mensaje' => 'Variable eliminada correctamente']);

    } else {
        return response()->json(['success' => true,'mensaje' => 'No se puede eliminar la variable, verificar la existencia']);
    }

}

    public function actualizarModal(Request $request) {

        if ($this->ctrlPermisos->recuperarRoles('per_var_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }


        /* Muestra un modal para actualizar el contenido  */
        $id = $request->valores[0];
        $variable = vmed_mst::find($id);

        if ($variable) {
            return view('componentes/modales/actualizarVariable', compact('variable'));
        } else {
            $mensaje = 'No se puede actualizar la variable';
            $solucion = 'Verifica la existencia de la variable';
            return view('componentes/modales/error', compact('mensaje','solucion'));
        }

    }


    public function actualizar(Request $request) {

        if ($this->ctrlPermisos->recuperarRoles('per_var_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }
        /* Actualiza el contenido en la base de datos */
        $datos = $request->all();
        $id = $datos['vmed_uuid'];

        $variable = vmed_mst::find($id);

        if ($variable) {
            $variable->vmed_nom = $datos['vmed_nom'];
            $variable->vmed_desc = $datos['vmed_desc'];
            $variable->vmed_vis = $datos['vmed_vis'];
            $variable->save();
            return response()->json(['success' => true,'mensaje' => 'Variable actualizado correctamente']);
        } else {
            $mensaje = 'No se puede actualizar la variable';
            $solucion = 'Verifica la existencia de la variable';
            return view('componentes/modales/error', compact('mensaje','solucion'));
        }
    }


}


