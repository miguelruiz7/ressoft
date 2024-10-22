<?php

namespace App\Http\Controllers;

use App\Models\rol_det;
use App\Models\usr_mst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class controladorSesion extends Controller
{
    public function acceso(Request $peticion)
    {
        $txtTipo = $peticion->input('txtTipo');
        $txtUsuario = $peticion->input('txtUsuario');
        $txtContrasena = $peticion->input('txtContrasena');

        $mensajes = [];

        $reglas = [
            'txtTipo' => 'numeric|required',
            'txtUsuario' => 'required',
            'txtContrasena' => [
                'required'
            ]
        ];

        $mensajesAlternativos = [
            'required' => 'Campo requerido.',
            'numeric' => 'Debe ser un número',
        ];

        $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

        $validarCampos = Validator::make($peticion->all(), $reglas, $mensajesCombinados);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }

        switch ($txtTipo) {

            case 1:
                $usuario = usr_mst::where('usr_usu', $txtUsuario)->first();

                if ($usuario && password_verify($txtContrasena, $usuario->usr_con)) {
                    if ($usuario->usr_vis == 0) {
                        return response()->json(['success' => false, 'mensaje' => 'Cuenta no habilitada. Comuniquese con su administrador.']);
                    } else {
                        session(['usr_gbl' => $usuario->usr_uuid]);
                        return response()->json(['success' => true, 'mensaje' => 'Inicio de sesión correcto']);
                    }
                } else {
                    return response()->json(['success' => false, 'mensaje' => 'Credenciales inválidas']);
                }

            case 2:


                $txtUsuario = $peticion->input('txtUsuario');
                $txtContrasena = $peticion->input('txtContrasena');

                    # Inicio de sesión de administrador (Superusuario)

                        # Credenciales previamente guardados en el .env
                        $envUsuario = env('ADM_USER');
                        $envContrasena = env('ADM_PASSWORD');
                        

                        if ($txtUsuario === $envUsuario &&  password_verify($txtContrasena, $envContrasena)) {

                            # Se crea la sesión mediante el método de sesiones
                            session(['admin_gbl' => $txtUsuario]);

                            return response()->json(['success' => true, 'mensaje' => 'Inicio de sesión correcto']);
                        } else {
                            return response()->json(['success' => false, 'mensaje' => 'Credenciales inválidas']);
                        }



            default:
                return response()->json(['success' => false, 'mensaje' => 'Método no permitido']);
        }
    }

    public function recuperarRoles($clave){

            if(session()->has('admin_gbl')){
            return true;

            }else{

                $usuario = usr_mst::where('usr_uuid', '=', session('usr_gbl')) -> first();
        if($usuario) {
            $rol = $usuario->usr_rol_uuid;

                $permisosActuales = rol_det::join('per_msts', 'rol_dets.rol_per_uuid', '=', 'per_msts.per_uuid')
                    ->where('rol_dets.rol_rol_uuid', $rol)
                    ->pluck('per_msts.per_sgl')
                    ->toArray();

               /*  echo 'permisos actuales: '.implode(',',$permisosActuales).'<br>'; */

            if (in_array($clave, $permisosActuales)) {
             /*    echo 'Verdadero'; */
                return true;

            }
        }
      /*   echo 'Falso'; */
        return false;
            }

    }


    public function cerrarSesion()
    {
        session()->forget('admin_gbl');
        session()->forget('usr_gbl');
        return redirect('acceso');
    }

}
