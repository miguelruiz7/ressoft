<?php

namespace App\Helpers;

use App\Http\Controllers\controladorSesion;

class PermisoHelper
{
    protected static $controladorSesion;

    public static function getControladorSesion()
    {
        if (self::$controladorSesion === null) {
            self::$controladorSesion = new controladorSesion();
        }
        return self::$controladorSesion;
    }

    public static function tienePermiso($permiso)
    {
        return self::getControladorSesion()->recuperarRoles($permiso);
    }

    public static function permisosPermitidos(array $permisos)
    {
        foreach ($permisos as $permiso) {
            if (self::tienePermiso($permiso)) {
                return true;
            }
        }
        return false;
    }
}
