<?php

namespace App\Http\Controllers;

use App\Models\sen_mst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class controladorSensores extends Controller
{

    protected $ctrlPermisos;

    public function __construct()
    {
        // Inicializa la instancia del controlador de sesión
        $this->ctrlPermisos = new controladorSesion();
    }


    public function ver(){
        if ($this->ctrlPermisos->recuperarRoles('per_sen_lec') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
        }

        $sensores = sen_mst::orderBy('sen_nom', 'asc')->get();
        return view("sensores" , compact('sensores'));
    }


    public function agregarModal(){
        if ($this->ctrlPermisos->recuperarRoles('per_sen_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }

        return view("componentes/modales/agregarSensor");
    }


    public function agregar(Request $solicitud){
        $datos = $solicitud->all();

        $mensajes = [];
        $reglas = [
           'sen_nom' => 'required|string|min:4|max:80|unique:sen_msts,sen_nom',
           'sen_desc' => 'required|string|min:4|max:255',
           'sen_img' => 'required|mimes:jpg,jpeg,png,gif,max:1024',
           'sen_vis' => 'required|numeric|min:0|max:1'

        ];

        $mensajesAlternativos = [
            'required' => 'Campo requerido',
            'sen_vis.min' => 'Valor no válido',
            'sen_vis.max'=> 'Valor no válido',
            'sen_nom.unique' => 'Nombre en uso',
            'sen_img.mimes' => 'Formato de imagen no válido',
        ];

        $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

        $validarCampos = Validator::make($solicitud->all(), $reglas, $mensajesCombinados);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }


        if ($this->ctrlPermisos->recuperarRoles('per_sen_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }



        $uuid = uniqid();
        $archivo = $solicitud->file('sen_img');
        $extension = strtolower($archivo->getClientOriginalExtension());

        $nombreNuevo = $uuid . "." . $extension;



        $ctrlUtil = new controladorUtilerias();
        $fecha = $ctrlUtil->obtenerFecha();

        $sensor = new sen_mst();
        $sensor -> sen_uuid = $uuid;
        $sensor -> sen_nom = $datos['sen_nom'];
        $sensor -> sen_desc = $datos['sen_desc'];
        $sensor -> sen_img = $nombreNuevo;
        $sensor -> sen_vis = $datos['sen_vis'];
        $sensor -> sen_cre = $fecha;
        $sensor -> sen_act = $fecha;

        $sensor -> save();

        $archivo->move('img/sen', $nombreNuevo);

        return response()->json(['success' => true, 'mensaje' => 'Se agregó el sensor correctamente']);



    }

    public function eliminarModal(Request $peticion){
        /* Muestra un modal para eliminar el contenido red */
        if ($this->ctrlPermisos->recuperarRoles('per_sen_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }


        $id = $peticion->valores[0];
        $sensor = sen_mst::find($id);

        if ($sensor) {
            return view('componentes/modales/eliminarSensor', compact('id'));
        }else{
            $mensaje = 'No se puede eliminar el sensor';
            $solucion = 'Verifica la existencia del sensor';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
  }



  public function eliminar(Request $peticion){

    if ($this->ctrlPermisos->recuperarRoles('per_sen_esc') == false) {
        return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
    }


    $id = $peticion->sen_uuid;
    $sensor = sen_mst::find($id);
    if ($sensor) {

        $sensor->delete();
        $imagen = $sensor->sen_img;
        unlink(public_path("img/sen/$imagen"));
        return response()->json(['success' => true,'mensaje' => 'Sensor eliminado correctamente']);

    } else {
        return response()->json(['success' => false,'mensaje' => 'No se puede eliminar el sensor verifica la existencia']);
    }

}


public function actualizarModal(Request $request) {

    if ($this->ctrlPermisos->recuperarRoles('per_sen_esc') == false) {
        $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
        $solucion = 'Verifica con tu administrador su rol';
        return view('componentes/modales/error', compact('mensaje', 'solucion'));
    }


    /* Muestra un modal para actualizar el contenido  */
    $id = $request->valores[0];
    $sensor = sen_mst::find($id);

    if ($sensor) {
        return view('componentes/modales/actualizarSensor', compact('sensor'));
    } else {
        $mensaje = 'No se puede actualizar el sensor';
        $solucion = 'Verifica la existencia del sensor';
        return view('componentes/modales/error', compact('mensaje','solucion'));
    }

}

public function actualizar(Request $peticion) {
    $ctrlUtil = new controladorUtilerias();
        $fecha = $ctrlUtil->obtenerFecha();

    $datos = $peticion->all();

    $mensajes = [];
    $reglas = [
        'sen_nom' => 'required|string|min:4|max:80',
        'sen_desc' => 'required|string|min:4|max:255',
        'sen_img' => 'nullable|mimes:jpg,jpeg,png,gif|max:1024', // Corregido aquí
        'sen_vis' => 'required|numeric|min:0|max:1'
    ];

    $mensajesAlternativos = [
        'required' => 'Campo requerido',
        'sen_vis.min' => 'Valor no válido',
        'sen_vis.max'=> 'Valor no válido',
        'sen_nom.unique' => 'Nombre en uso',
        'sen_img.mimes' => 'Formato de imagen no válido',
    ];

    $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

    $validarCampos = Validator::make($peticion->all(), $reglas, $mensajesCombinados);

    if ($validarCampos->fails()) {
        return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
    }

    if ($this->ctrlPermisos->recuperarRoles('per_sen_esc') == false) {
        return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
    }

    $id = $datos['sen_uuid'];
    $sensor = sen_mst::find($id);

    if ($sensor) {
        if ($peticion->hasFile('sen_img')) {
            $imagen = $peticion->file('sen_img');
            $nombreImagen = uniqid(). '.' . $imagen->getClientOriginalExtension();

              $imagen->move('img/sen', $nombreImagen);


            if ($sensor->sen_img) {
                unlink(public_path("img/sen/$sensor->sen_img"));
            }

            $sensor->sen_img = $nombreImagen;
        }

        $sensor->sen_nom = $datos['sen_nom'];
        $sensor->sen_desc = $datos['sen_desc'];
        $sensor->sen_vis = $datos['sen_vis'];
        $sensor -> sen_act = $fecha;
        $sensor->save();

        return response()->json(['success' => true, 'mensaje' => 'Sensor actualizado correctamente']);
    } else {
        $mensaje = 'No se puede actualizar el Sensor';
        $solucion = 'Verifica la existencia del Sensor';
        return view('componentes/modales/error', compact('mensaje', 'solucion'));
    }
}


public function verConfiguraciones(){
    if ($this->ctrlPermisos->recuperarRoles('per_sen_lec') == false) {
        $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
        $solucion = 'Verifica con tu administrador su rol';
        return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
    }

    $sensores = sen_mst::orderBy('sen_nom', 'asc')->get();
    return view("sensores" , compact('sensores'));
}



}
