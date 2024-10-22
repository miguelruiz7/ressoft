<?php

namespace App\Http\Controllers;

use App\Models\per_mst;
use App\Models\rol_det;
use App\Models\rol_mst;
use App\Models\usr_mst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class controladorRoles extends Controller
{
    protected $ctrlPermisos;

    public function __construct()
    {
        // Inicializa la instancia del controlador de sesión
        $this->ctrlPermisos = new controladorSesion();
    }


    public function ver()
    {

        if (!$this->ctrlPermisos->recuperarRoles('per_rol_lec')) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
        }


        $sesion = session('usr_gbl');
        if (is_string($sesion)) {
            $sesion = explode(',', $sesion);
        } elseif (!is_array($sesion)) {
            $sesion = [];
        }

        if(session() -> has('admin_gbl')) {
            $roles = rol_mst::orderBy('rol_nom', 'asc') ->get();
        } else {

        $usuario = usr_mst::where('usr_uuid', $sesion)->first();
        $rol = $usuario->usr_rol_uuid;
        $roles = rol_mst::orderBy('rol_nom', 'asc') ->select('*')->whereNotIn('rol_uuid', [$rol])->get();
        }

        return view('roles', compact('roles'));
    }

    public function verAsignaciones(){

        if ($this->ctrlPermisos->recuperarRoles('per_rol_lec') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
        }


        $sesion = session('usr_gbl');
        if (is_string($sesion)) {
            $sesion = explode(',', $sesion);
        } elseif (!is_array($sesion)) {
            $sesion = [];
        }

        if(session() -> has('admin_gbl')) {
            $roles = rol_mst::orderBy('rol_nom', 'asc') ->get();
        } else {

        $usuario = usr_mst::where('usr_uuid', $sesion)->first();
        $rol = $usuario->usr_rol_uuid;
        $roles = rol_mst::orderBy('rol_nom', 'asc') ->select('*')->whereNotIn('rol_uuid', [$rol])->get();
        }

         $permisos = per_mst::orderBy('per_sgl', 'asc')->get();

        return view("rolesAsignacion", compact('roles', 'permisos'));
    }

    public function rolesPermisos(Request $solicitud){

        if ($this->ctrlPermisos->recuperarRoles('per_rol_lec') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
        }

        $datos = $solicitud->all();

        switch ($datos['txtMetodo']){
            case 'disponibles':
                $permisosDisponibles = per_mst::whereNotIn('per_uuid', function($query) use ($datos) {
                    $query->select('rol_per_uuid')
                        ->from('rol_dets')
                        ->where('rol_rol_uuid', $datos['txtRol']);
                })->get();

                return view("componentes/opciones/permisosDisponibles", compact('permisosDisponibles'));

            case 'seleccionados':
                $permisosSeleccionados = rol_det::where('rol_rol_uuid', $datos['txtRol'])
                ->join('per_msts', 'rol_dets.rol_per_uuid', '=', 'per_msts.per_uuid')
                ->select('rol_dets.*', 'per_msts.per_desc', 'per_msts.per_sgl')
                ->get();

                return view("componentes/opciones/permisosSeleccionados", compact('permisosSeleccionados'));

            default:

        }




    }

    public function rolesPermisosGenerar(Request $solicitud){
        $datos = $solicitud->all();

        $mensajes = [];
        $reglas = [
           'rol_uuid' => 'required',

        ];

        $mensajesAlternativos = [
            'required' => 'Selecciona el rol',
            'uuid' => 'Formato del identificador incorrecto',
        ];

        $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

        $validarCampos = Validator::make($solicitud->all(), $reglas, $mensajesCombinados);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }


        if ($this->ctrlPermisos->recuperarRoles('per_rol_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }



        $permisosNuevos = explode(',', $datos['rol_per_uuid']);



        $permisosActuales = rol_det::where('rol_rol_uuid', $datos['rol_uuid'])
                                   ->pluck('rol_per_uuid')
                                   ->toArray();


        $permisosAEliminar = array_diff($permisosActuales, $permisosNuevos);


        $permisosAAgregar = array_diff($permisosNuevos, $permisosActuales);


        if(count($permisosNuevos) < count($permisosActuales)) {

        if (!empty($permisosAEliminar)) {

            rol_det::where('rol_rol_uuid', $datos['rol_uuid'])
                   ->whereIn('rol_per_uuid', $permisosAEliminar)
                   ->delete();
        }
      }



        if($datos['rol_per_uuid'] != ''  ){

        foreach ($permisosAAgregar as $permiso) {
            $uuid = uniqid();

            $permiso_rol = new rol_det();
            $permiso_rol->rol_uuid_ = $uuid;
            $permiso_rol->rol_per_uuid = $permiso;
            $permiso_rol->rol_rol_uuid = $datos['rol_uuid'];
            $permiso_rol->save();
        }
    }

        return response()->json(['success' => true, 'mensaje' => 'Se actualizaron los permisos correctamente']);
    }




    public function agregarModal(){
        if ($this->ctrlPermisos->recuperarRoles('per_rol_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }

        return view("componentes/modales/agregarRol");
    }


    public function agregar(Request $solicitud){
        $datos = $solicitud->all();

        $mensajes = [];
        $reglas = [
           'rol_nom' => 'required|string|min:4|max:80|regex:/^[\pL\s]+$/u',
           'rol_desc' => 'required|string|min:4|max:255',
           'rol_vis' => 'required|numeric|min:0|max:1'

        ];

        $mensajesAlternativos = [
            'required' => 'Campo requerido',
            'rol_vis.min' => 'Valor no válido',
            'rol_vis.max'=> 'Valor no válido',
            'rol_nom.regex'=> 'Solo admite caracteres de tipo letra',
        ];

        $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

        $validarCampos = Validator::make($solicitud->all(), $reglas, $mensajesCombinados);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }


        if ($this->ctrlPermisos->recuperarRoles('per_rol_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }



        $uuid = uniqid();




        $rol = new rol_mst();
        $rol -> rol_uuid = $uuid;
        $rol -> rol_nom = $datos['rol_nom'];
        $rol -> rol_desc = $datos['rol_desc'];
        $rol -> rol_vis = $datos['rol_vis'];
;
        $rol -> save();

        return response()->json(['success' => true, 'mensaje' => 'Se agregó el rol correctamente']);



    }

    public function eliminarModal(Request $peticion){
        /* Muestra un modal para eliminar el contenido red */
        if ($this->ctrlPermisos->recuperarRoles('per_rol_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }


        $id = $peticion->valores[0];
        $rol = rol_mst::find($id);

        if ($rol) {
            return view('componentes/modales/eliminarRol', compact('id'));
        }else{
            $mensaje = 'No se puede eliminar el rol';
            $solucion = 'Verifica la existencia del rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
  }


  public function eliminar(Request $peticion){

    if ($this->ctrlPermisos->recuperarRoles('per_rol_esc') == false) {
        return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
    }


    $id = $peticion->rol_uuid;
    $rol = rol_mst::find($id);
    if ($rol) {

        $rol->delete();
        return response()->json(['success' => true,'mensaje' => 'Rol eliminado correctamente']);

    } else {
        $mensaje = 'No se puede eliminar el rol';
        $solucion = 'Verifica la existencia del rol';
        return view('componentes/modales/error', compact('mensaje', 'solucion'));
    }

}

    public function actualizarModal(Request $request) {

        if ($this->ctrlPermisos->recuperarRoles('per_rol_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }


        /* Muestra un modal para actualizar el contenido  */
        $id = $request->valores[0];
        $rol = rol_mst::find($id);

        if ($rol) {
            return view('componentes/modales/actualizarRol', compact('rol'));
        } else {
            $mensaje = 'No se puede actualizar el rol';
            $solucion = 'Verifica la existencia del rol';
            return view('componentes/modales/error', compact('mensaje','solucion'));
        }

    }


    public function actualizar(Request $request) {

        if ($this->ctrlPermisos->recuperarRoles('per_rol_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }
        /* Actualiza el contenido en la base de datos */
        $datos = $request->all();
        $id = $datos['rol_uuid'];

        $rol = rol_mst::find($id);

        if ($rol) {
            $rol->rol_nom = $datos['rol_nom'];
            $rol->rol_desc = $datos['rol_desc'];
            $rol->rol_vis = $datos['rol_vis'];
            $rol->save();
            return response()->json(['success' => true,'mensaje' => 'Rol actualizado correctamente']);
        } else {
            $mensaje = 'No se puede actualizar el rol';
            $solucion = 'Verifica la existencia del rol';
            return view('componentes/modales/error', compact('mensaje','solucion'));
        }
    }



}
