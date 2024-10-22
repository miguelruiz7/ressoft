<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Validator;

class controladorCorreo extends Controller {
    protected $ctrlPermisos;
    protected $mailer;

    public function __construct()
    {
        // Inicializa la instancia del controlador de sesión
        $this->ctrlPermisos = new controladorSesion();
    }

    public function actualizarModal(Request $request)
    {
        if ($this->ctrlPermisos->recuperarRoles('per_cor_esc') == false) {
            $mensaje = 'No tienes suficientes privilegios para entrar a este módulo';
            $solucion = 'Verifica con tu administrador su rol';
            return view('componentes/modales/error', compact('mensaje', 'solucion'));
        }

        $envUsuario = env('PHP_MAILER_USERNAME');
        $envContrasena = env('PHP_MAILER_PASSWORD');

        $correo = [
            'cor_usr' => $envUsuario,
            'cor_con' => $envContrasena,
        ];

        return view('componentes/modales/actualizarCorreo', compact('correo'));
    }

    public function actualizar(Request $solicitud)
    {
        $datos = $solicitud->all();

        $mensajes = [];
        $reglas = [
            'cor_usr' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (!str_ends_with($value, '@gmail.com')) {
                        $fail('El correo debe pertenecer al dominio gmail.com.');
                    }
                },
            ],
            'cor_con' => [
                'required',
                'string',
            ]
        ];

        $mensajesAlternativos = [
            'required' => ' Campo requerido',
            'email'=> ' El campo no es un correo',
        ];

        $mensajesCombinados = array_merge($mensajes, $mensajesAlternativos);

        $validarCampos = Validator::make($solicitud->all(), $reglas, $mensajesCombinados);

        if ($validarCampos->fails()) {
            return response()->json(['success' => false, 'mensaje' => 'Verifica el error', 'errores' => $validarCampos->errors()]);
        }

        if ($this->ctrlPermisos->recuperarRoles('per_cor_esc') == false) {
            return response()->json(['success'=> false, 'mensaje' => 'No tienes suficientes privilegios para realizar esta acción']);
        }


        try {
            $this->mailer = new PHPMailer(true);
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.gmail.com';
            $this->mailer->Port = 587;
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username =  $datos['cor_usr'];
            $this->mailer->Password =  $datos['cor_con'];
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                $this->mailer->smtpConnect();
                $this->mailer->smtpClose();


                $ctrlEntorno = new controladorEntorno();
                $camposBase = array(
                    'PHP_MAILER_USERNAME' => '"'.$datos['cor_usr'].'"',
                    'PHP_MAILER_PASSWORD' => '"'. $datos['cor_con'].'"'
                );

                foreach ($camposBase as $clave => $valor) {
                    $ctrlEntorno->establecerVariables($clave, $valor);
                }

                return response()->json(['success' => true, 'mensaje' => 'Conexión al servidor de correo exitosa, se guardaron las credenciales']);


        } catch (Exception $e) {

              switch($e->getCode()){
                case 0;
                $mensaje = "La credenciales son incorrectas por lo cual no se pudo autenticar, verifique";
              }


            return response()->json(['success' => false, 'mensaje' => $mensaje]);
        }

/*
        $ctrlEntorno = new controladorEntorno();
        $camposBase = array(
            'ADM_USER' => $datos['admin_usr'],
            'ADM_PASSWORD' => password_hash($datos['admin_con'], PASSWORD_DEFAULT),
        );

        foreach ($camposBase as $clave => $valor) {
            $ctrlEntorno->establecerVariables($clave, $valor);
        }

        return response()->json(['success' => true, 'mensaje' => 'Se modificaron correctamente, la proxima vez que inicies sesion serán con las nuevas credenciales']); */
    }

    public function email()
    {
        return $this->enviarCorreo('gomi_guel_@hotmail.com', 'Prueba', 'Esto es una prueba de correo');
    }

    public function enviarCorreo($to, $subject, $body)
    {
        if (env('PHP_MAILER_USERNAME') == '' || env('PHP_MAILER_PASSWORD') == '') {
            return response()->json(['success' => false, 'mensaje' => 'Las credenciales de correo no están configuradas en el servidor']);
        }

        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->Port = 587;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = env('PHP_MAILER_USERNAME');
        $this->mailer->Password = env('PHP_MAILER_PASSWORD');
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->setFrom(env('PHP_MAILER_USERNAME'), 'EBEPH Web');

        try {
            $this->mailer->addAddress($to);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;

            $this->mailer->send();
            return response()->json(['success' => true, 'mensaje' => 'Correo enviado exitosamente']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'mensaje' => 'Correo no enviado: ' . $e->getMessage()]);
        }
    }


}
