<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controladorUtilerias extends Controller
{
    public function obtenerFecha(){

        date_default_timezone_set('America/Mexico_City');
          $horarioVerano = date('I');
          if ($horarioVerano) {
              $fecha = date('Y-m-d H:i:s', strtotime('-1 hour'));
          }else{
              $fecha = date('Y-m-d H:i:s', time());
          }

          return $fecha;


        /*

         Funcion viejita

          date_default_timezone_set('America/Mexico_City');
          $fecha_actual = new DateTime();


          $nuevointervalo = 'PT'.$fixhoras.'H';

          $intervalo = new DateInterval($nuevointervalo);
          $fecha_actual->sub($intervalo);


          $fecha_cap = $fecha_actual->format('Y-m-d H:i:s');

          return $fecha_cap;

        */

}

}
