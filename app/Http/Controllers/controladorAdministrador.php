<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class controladorAdministrador extends Controller
{


    protected $ctrlPermisos;

    public function __construct()
    {
        // Inicializa la instancia del controlador de sesión
        $this->ctrlPermisos = new controladorSesion();
    }



    public function actualizarModal(Request $request) {

        if ($this->ctrlPermisos->recuperarRoles('per_adm_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }

              # Credenciales previamente guardados en el .env
              $envUsuario = env('ADM_USER');
              $envContrasena = env('ADM_PASSWORD');


              $administrador = [
                'admin_usr' => $envUsuario,
            ];

            return view('componentes/modales/actualizarAdministrador', compact('administrador'));


    }

    public function agregar(Request $solicitud)
    {
        $datos = $solicitud->all();

        $mensajes = [];
        $reglas = [
            'admin_usr' => 'required|string|min:4|max:80|regex:/^[\pL\s]+$/u',
            'admin_con' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).+$/',
            ],
            'admin_con_' => [
                'required',
                'string',
                'min:8',
                'same:admin_con',
            ]
        ];

        $mensajesAlternativos = [
            'required' => ' Campo requerido',
            'same' => ' Las contraseñas no coinciden.',
            'admin_usr.regex' => ' Solo debe contener letras',
            'admin_con.regex' => ' La contraseña debe contener al menos una mayúscula, un número, y símbolo',
            'admin_con.min' => ' La contraseña debe contener al menos con :min caracteres',
            'admin_con_.min' => ' La contraseña debe contener al menos con :min caracteres',
        ];

        $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

        $validarCampos = Validator::make($solicitud->all(), $reglas, $mensajesCombinados);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }

        if ($this->ctrlPermisos->recuperarRoles('per_adm_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }


        $ctrlEntorno = new controladorEntorno();
        $camposBase = array(
            'ADM_USER' => $datos['admin_usr'],
            'ADM_PASSWORD' => password_hash($datos['admin_con'], PASSWORD_DEFAULT),
        );

        foreach ($camposBase as $clave => $valor) {
            $ctrlEntorno->establecerVariables($clave, $valor);
        }

        return response()->json(['success' => true, 'mensaje' => 'Se modificaron correctamente, la proxima vez que inicies sesion serán con las nuevas credenciales']);
    }
}
