<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class sesionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Obtener la ruta actual
        $ruta = basename($request->path());

        if ($ruta === 'acceso') {

            if ($request->session()->has('admin_gbl') || $request->session()->has('usr_gbl')) {
                return redirect('/');
            }
        } else {

            if (!$request->session()->has('admin_gbl') && !$request->session()->has('usr_gbl')) {
               // return redirect('admin/acceso');
               ?>
               <script>window.location.href = "acceso";</script>
               <?php
            }
        }
        return $next($request);
    }
}
