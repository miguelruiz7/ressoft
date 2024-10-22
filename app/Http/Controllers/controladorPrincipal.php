<?php

namespace App\Http\Controllers;

use App\Models\usr_mst;
use Illuminate\Http\Request;

class controladorPrincipal extends Controller
{
    public function inicio()
    {

            if(session()->has('admin_gbl')) {

                $usuario = [
                    'usr_nom' => 'Sistemas',
                    'rol_nom' => 'Administrador de sistemas'
                ];

            }else{
                $sesion = session('usr_gbl');

                if (is_string($sesion)) {
                    $sesion = explode(',', $sesion);
                }

                $sesion = is_array($sesion) ? $sesion : [];

                $usuario = usr_mst::join('rol_msts', 'usr_msts.usr_rol_uuid', '=', 'rol_msts.rol_uuid')
                ->select('rol_msts.*', 'usr_msts.*')
                ->where('usr_msts.usr_uuid', $sesion)
                ->first();
            }





            return view('inicio', compact('usuario'));

    }
}
