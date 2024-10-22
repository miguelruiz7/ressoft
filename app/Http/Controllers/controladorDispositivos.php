<?php

namespace App\Http\Controllers;

use App\Models\disp_mst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

class controladorDispositivos extends Controller
{
    protected $ctrlPermisos;

    public function __construct()
    {
        // Inicializa la instancia del controlador de sesión
        $this->ctrlPermisos = new controladorSesion();
    }


    public function ver(){
        if ($this->ctrlPermisos->recuperarRoles('per_dis_lec') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
        }

        $dispositivos = disp_mst::orderBy('disp_nom', 'asc')->get();
        return view("dispositivos" , compact('dispositivos'));
    }

    public function agregarModal(){
        if ($this->ctrlPermisos->recuperarRoles('per_dis_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }

        return view("componentes/modales/agregarDispositivo");
    }


    public function agregar(Request $solicitud){
        $datos = $solicitud->all();

        $mensajes = [];
        $reglas = [
           'disp_nom' => 'required|string|min:4|max:80|unique:disp_msts,disp_nom',
           'disp_desc' => 'required|string|min:4|max:255',
           'disp_img' => 'required|mimes:jpg,jpeg,png,gif,max:1024',
           'disp_vis' => 'required|numeric|min:0|max:1'

        ];

        $mensajesAlternativos = [
            'required' => 'Campo requerido',
            'disp_vis.min' => 'Valor no válido',
            'disp_vis.max'=> 'Valor no válido',
            'disp_nom.unique' => 'Nombre en uso',
            'disp_img.mimes' => 'Formato de imagen no válido',
        ];

        $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

        $validarCampos = Validator::make($solicitud->all(), $reglas, $mensajesCombinados);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }


        if ($this->ctrlPermisos->recuperarRoles('per_dis_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }



        $uuid = uniqid();
        $archivo = $solicitud->file('disp_img');
        $extension = strtolower($archivo->getClientOriginalExtension());

        $nombreNuevo = $uuid . "." . $extension;



        $ctrlUtil = new controladorUtilerias();
        $fecha = $ctrlUtil->obtenerFecha();

        $dispositivo = new disp_mst();
        $dispositivo -> disp_uuid = $uuid;
        $dispositivo -> disp_nom = $datos['disp_nom'];
        $dispositivo -> disp_desc = $datos['disp_desc'];
        $dispositivo -> disp_img = $nombreNuevo;
        $dispositivo -> disp_vis = $datos['disp_vis'];
        $dispositivo -> disp_cre = $fecha;
        $dispositivo -> disp_act = $fecha;

        $dispositivo -> save();

        $archivo->move('img/disp', $nombreNuevo);

        return response()->json(['success' => true, 'mensaje' => 'Se agregó el dispositivo correctamente']);



    }

    public function eliminarModal(Request $peticion){
        /* Muestra un modal para eliminar el contenido red */
        if ($this->ctrlPermisos->recuperarRoles('per_dis_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }


        $id = $peticion->valores[0];
        $dispositivo = disp_mst::find($id);

        if ($dispositivo) {
            return view('componentes/modales/eliminarDispositivo', compact('id'));
        }else{
            $mensaje = 'No se puede eliminar el dispositivo';
            $solucion = 'Verifica la existencia del dispositivo';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
  }



  public function eliminar(Request $peticion){

    if ($this->ctrlPermisos->recuperarRoles('per_dis_esc') == false) {
        return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
    }


    $id = $peticion->disp_uuid;
    $dispositivo = disp_mst::find($id);
    if ($dispositivo) {

        $dispositivo->delete();
        $imagen = $dispositivo->disp_img;
        unlink(public_path("img/disp/$imagen"));
        return response()->json(['success' => true,'mensaje' => 'Dispositivo eliminado correctamente']);

    } else {
        return response()->json(['success' => false,'mensaje' => 'No se puede eliminar el dispositivo verifica la existencia']);
    }

}


public function actualizarModal(Request $request) {

    if ($this->ctrlPermisos->recuperarRoles('per_dis_esc') == false) {
        $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
        $solucion = 'Verifica con tu administrador su rol';
        return view('componentes/modales/error', compact('mensaje', 'solucion'));
    }


    /* Muestra un modal para actualizar el contenido  */
    $id = $request->valores[0];
    $dispositivo = disp_mst::find($id);

    if ($dispositivo) {
        return view('componentes/modales/actualizarDispositivo', compact('dispositivo'));
    } else {
        $mensaje = 'No se puede actualizar el dispositivo';
        $solucion = 'Verifica la existencia del dispositivo';
        return view('componentes/modales/error', compact('mensaje','solucion'));
    }

}

public function actualizar(Request $peticion) {
    $ctrlUtil = new controladorUtilerias();
        $fecha = $ctrlUtil->obtenerFecha();

    $datos = $peticion->all();

    $mensajes = [];
    $reglas = [
        'disp_nom' => 'required|string|min:4|max:80',
        'disp_desc' => 'required|string|min:4|max:255',
        'disp_img' => 'nullable|mimes:jpg,jpeg,png,gif|max:1024', // Corregido aquí
        'disp_vis' => 'required|numeric|min:0|max:1'
    ];

    $mensajesAlternativos = [
        'required' => 'Campo requerido',
        'disp_vis.min' => 'Valor no válido',
        'disp_vis.max'=> 'Valor no válido',
        'disp_nom.unique' => 'Nombre en uso',
        'disp_img.mimes' => 'Formato de imagen no válido',
    ];

    $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

    $validarCampos = Validator::make($peticion->all(), $reglas, $mensajesCombinados);

    if ($validarCampos->fails()) {
        return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
    }

    if ($this->ctrlPermisos->recuperarRoles('per_dis_esc') == false) {
        return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
    }

    $id = $datos['disp_uuid'];
    $dispositivo = disp_mst::find($id);

    if ($dispositivo) {
        if ($peticion->hasFile('disp_img')) {
            $imagen = $peticion->file('disp_img');
            $nombreImagen = uniqid(). '.' . $imagen->getClientOriginalExtension();

              $imagen->move('img/disp', $nombreImagen);


            if ($dispositivo->disp_img) {
                unlink(public_path("img/disp/$dispositivo->disp_img"));
            }

            $dispositivo->disp_img = $nombreImagen;
        }

        $dispositivo->disp_nom = $datos['disp_nom'];
        $dispositivo->disp_desc = $datos['disp_desc'];
        $dispositivo->disp_vis = $datos['disp_vis'];
        $dispositivo -> disp_act = $fecha;
        $dispositivo->save();

        return response()->json(['success' => true, 'mensaje' => 'Dispositivo actualizado correctamente']);
    } else {
        $mensaje = 'No se puede actualizar el dispositivo';
        $solucion = 'Verifica la existencia del dispositivo';
        return view('componentes/modales/error', compact('mensaje', 'solucion'));
    }
}


}
