<?php

namespace App\Http\Controllers;

use App\Models\rol_mst;
use App\Models\usr_mst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class controladorUsuarios extends Controller
{

    protected $ctrlPermisos;

    public function __construct()
    {
        // Inicializa la instancia del controlador de sesión
        $this->ctrlPermisos = new controladorSesion();
    }


    public function ver()
    {


        if ($this->ctrlPermisos->recuperarRoles('per_usu_lec') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/errores/privilegios', compact('mensaje', 'solucion'));
        }


            $sesion = session('usr_gbl');

            if (is_string($sesion)) {
                $sesion = explode(',', $sesion);
            }

            $sesion = is_array($sesion) ? $sesion : [];
            $usuarios = usr_mst::orderBy('usr_nom', 'asc')
                ->join('rol_msts', 'usr_msts.usr_rol_uuid', '=', 'rol_msts.rol_uuid')
                ->select('rol_msts.*', 'usr_msts.*')
                ->whereNotIn('usr_msts.usr_uuid', $sesion)
                ->get();

        return view("usuarios", compact('usuarios'));
    }

    public function agregarModal()
    {
        if ($this->ctrlPermisos->recuperarRoles('per_usu_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
        $roles = rol_mst::where('rol_vis', '=', 1)->orderBy('rol_nom', 'asc')->get();
        return view("componentes/modales/agregarUsuario", compact('roles'));
    }

    public function agregar(Request $solicitud)
    {
        $datos = $solicitud->all();

        $mensajes = [];
        $reglas = [
            'usr_nom' => 'required|string|min:4|max:80|regex:/^[\pL\s]+$/u',
            'usr_cor' => 'required|email|unique:usr_msts,usr_cor',
            'usr_usu' => 'required|string|min:4|max:80|regex:/^[\pL\s]+$/u|unique:usr_msts,usr_usu',
            'usr_con' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).+$/',
            ],
            'usr_con_' => [
                'required',
                'string',
                'min:8',
                'same:usr_con',
            ],
            'usr_rol_uuid' => 'required|string',
            'usr_vis' => 'required|numeric|min:0|max:1'
        ];

        $mensajesAlternativos = [
            'required' => ' Campo requerido',
            'same' => ' Las contraseñas no coinciden.',
            'usr_usu.regex' => ' Solo debe contener letras',
            'usr_con.regex' => ' La contraseña debe contener al menos una mayúscula, un número, y símbolo',
            'usr_con.min' => ' La contraseña debe contener al menos con :min caracteres',
            'usr_con_.min' => ' La contraseña debe contener al menos con :min caracteres',
            'usr_vis.min' => ' Opción inválida',
            'usr_vis.max' => ' Opción inválida',
            'usr_usu.unique' => ' El nombre de usuario ya está en uso',
            'usr_cor.unique' => 'El correo electrónico ya está en uso'
        ];

        $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

        $validarCampos = Validator::make($solicitud->all(), $reglas, $mensajesCombinados);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }

        if ($this->ctrlPermisos->recuperarRoles('per_usu_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }

        $uuid = uniqid();

        $usuario = new usr_mst();
        $usuario->usr_uuid = $uuid;
        $usuario->usr_nom = $datos['usr_nom'];
        $usuario->usr_cor = $datos['usr_cor'];
        $usuario->usr_usu = $datos['usr_usu'];
        $usuario->usr_con = password_hash($datos['usr_con'], PASSWORD_DEFAULT);
        $usuario->usr_rol_uuid = $datos['usr_rol_uuid'];
        $usuario->usr_vis = $datos['usr_vis'];
        $usuario->save();

        return response()->json(['success' => true, 'mensaje' => 'Se agregó el usuario correctamente']);
    }


    public function eliminarModal(Request $peticion){
        if ($this->ctrlPermisos->recuperarRoles('per_usu_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
        /* Muestra un modal para eliminar el contenido red */
        $id = $peticion->valores[0];
        $usuario = usr_mst::find($id);

        if ($usuario) {
            return view('componentes/modales/eliminarUsuario', compact('id'));
        }else{
            $mensaje = 'No se puede eliminar el usuario';
            $solucion = 'Verifica la existencia del usuario';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }
  }

  public function eliminar(Request $peticion){

    if ($this->ctrlPermisos->recuperarRoles('per_usu_esc') == false) {
        return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
    }

    $id = $peticion->usr_uuid;
    $usuario = usr_mst::find($id);
    if ($usuario) {

        $usuario->delete();
        return response()->json(['success' => true,'mensaje' => 'Usuario eliminado correctamente']);

    } else {
        $mensaje = 'No se puede eliminar el usuario';
        $solucion = 'Verifica la existencia del usuario';
        return view('componentes/modales/error', compact('mensaje', 'solucion'));
    }

}


public function actualizarModal(Request $request) {

    if ($this->ctrlPermisos->recuperarRoles('per_usu_esc') == false) {
        $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
        $solucion = 'Verifica con tu administrador su rol';
        return view('componentes/modales/error', compact('mensaje', 'solucion'));
    }

    /* Muestra un modal para actualizar el contenido  */
    $id = $request->valores[0];
    $usuario = usr_mst::find($id);
    $roles = rol_mst::where('rol_vis', '=', 1)->orderBy('rol_nom', 'asc')->get();

    if ($usuario) {
        return view('componentes/modales/actualizarUsuario', compact('usuario','roles'));
    } else {
        $mensaje = 'No se puede actualizar el usuario';
        $solucion = 'Verifica la existencia del usuario';
        return view('componentes/modales/error', compact('mensaje','solucion'));
    }

}

public function actualizar(Request $peticion) {

    $datos = $peticion->all();

    $mensajes = [];
    $reglas = [
        'usr_nom' => 'required|string|min:4|max:80|regex:/^[\pL\s]+$/u',
       /*  'usr_usu' => 'required|string|min:4|max:80|regex:/^[\pL\s]+$/u', */


        'usr_con' => [
            'nullable',
            'string',
            'min:8',
            'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).+$/',
        ],
        'usr_con_' => [
            'nullable',
            'string',
            'min:8',
            'same:usr_con',
        ],
        'usr_rol_uuid' => 'required|string',
        'usr_vis' => 'required|numeric|min:0|max:1'

    ];

    $mensajesAlternativos = [
        'required' => ' Campo requerido',
        'same' => ' Las contraseñas no coinciden.',
        'usr_usu.regex' => ' Solo debe contener letras',
        'usr_con.regex' => ' La contraseña debe contener al menos una mayúscula, un número, y símbolo',
        'usr_con.min' => ' La contraseña debe contener al menos con :min caracteres',
        'usr_con_.min' => ' La contraseña debe contener al menos con :min caracteres',
        'usr_vis.min' => ' Opción inválida',
        'usr_vis.max' => ' Opción inválida'

    ];



    $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

    $validarCampos = Validator::make($peticion->all(), $reglas, $mensajesCombinados);

    if ($validarCampos->fails()) {
        return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
    }

    if ($this->ctrlPermisos->recuperarRoles('per_usu_esc') == false) {
        return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
    }


    /* Actualiza el contenido en la base de datos */
    $datos = $peticion->all();
    $id = $datos['usr_uuid'];

    $usuario = usr_mst::find($id);

    if ($usuario) {
        $usuario->usr_nom = $datos['usr_nom'];
      if($datos['usr_con'] != '') {
        $usuario->usr_con = password_hash($datos['usr_con'], PASSWORD_DEFAULT);
      }
        $usuario->usr_rol_uuid = $datos['usr_rol_uuid'];
        $usuario->usr_vis = $datos['usr_vis'];
        $usuario->save();
        return response()->json(['success' => true,'mensaje' => 'Usuario actualizado correctamente']);
    } else {
        $mensaje = 'No se puede actualizar el usuario';
        $solucion = 'Verifica la existencia del usuario';
        return view('componentes/modales/error', compact('mensaje','solucion'));
    }
}

}
