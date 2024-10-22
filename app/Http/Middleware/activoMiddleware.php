<?php

namespace App\Http\Middleware;

use App\Models\usr_mst;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class activoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!session()->has('admin_gbl')){
            $usuario = usr_mst::where('usr_uuid', '=', session('usr_gbl')) -> first();

            if($usuario){

                $estado = $usuario->usr_vis;
                            if ($estado == 0) {
                                // return redirect('admin/acceso');
                                ?>
                                <script>window.location.href = "cerrarSesion";</script>
                                <?php
                            }

            }else{
                 // return redirect('admin/acceso');
                 ?>
                 <script>window.location.href = "cerrarSesion";</script>
                 <?php
            }

        }

        return $next($request);
    }
}
