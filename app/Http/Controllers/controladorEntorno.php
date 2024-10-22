<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class controladorEntorno extends Controller
{
    public function leerVariable($clave){
        $entorno = $this->leerVariables();

        if (isset($entorno[$clave])) {
            return response()->json([$clave => $entorno[$clave]]);
        }

        return response()->json(['message' => 'Variable no encontrada'], 404);
  }
    /**
     * Modifica las variables de entorno del sistema.
     *
     * @param  string  $clave
     * @param  string  $valor
     * @var string
     */

     public function establecerVariables($clave, $valor)
     {
         $dirEntorno = base_path('.env');
         $entContenido = File::get($dirEntorno);
         $patronEntorno = "/^{$clave}=.*$/m";

         // Escapar los caracteres `$` en el valor para que no sean interpretados como variables
         $valorEscapado = addcslashes($valor, '$');

         if (preg_match($patronEntorno, $entContenido)) {
             $entContenido = preg_replace($patronEntorno, "{$clave}={$valorEscapado}", $entContenido);
         } else {
             $entContenido .= "{$clave}={$valorEscapado}" . PHP_EOL;
         }

         File::put($dirEntorno, $entContenido);
     }



      /**
     * Método privado para leer todas las variables de entorno.
     *
     * Este método carga el contenido del archivo .env, lo procesa línea por línea y construye un array
     * con las claves y valores de cada variable.
     *
     * @return array
     */
    private function leerVariables()
    {
        $dirEntorno = base_path('.env');
        $entContenido = File::get($dirEntorno);

        $lineas = explode(PHP_EOL, $entContenido);
        $variables = [];

        foreach ($lineas as $linea) {
            if (!empty($linea) && strpos($linea, '=') !== false) {
                list($clave, $valor) = explode('=', $linea, 2);
                $variables[$clave] = $valor;
            }
        }

        return $variables;
    }


}
